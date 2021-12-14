<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventOrganizer;
use App\Models\Transportation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['transportation', 'organizer', 'members', 'media'])->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportations = Transportation::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizers = EventOrganizer::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('name', 'id');

        return view('admin.events.create', compact('members', 'organizers', 'transportations'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->members()->sync($request->input('members', []));
        if ($request->input('event_img', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_img'))))->toMediaCollection('event_img');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transportations = Transportation::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizers = EventOrganizer::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('name', 'id');

        $event->load('transportation', 'organizer', 'members');

        return view('admin.events.edit', compact('event', 'members', 'organizers', 'transportations'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->members()->sync($request->input('members', []));
        if ($request->input('event_img', false)) {
            if (!$event->event_img || $request->input('event_img') !== $event->event_img->file_name) {
                if ($event->event_img) {
                    $event->event_img->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_img'))))->toMediaCollection('event_img');
            }
        } elseif ($event->event_img) {
            $event->event_img->delete();
        }

        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('transportation', 'organizer', 'members', 'eventResults');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
