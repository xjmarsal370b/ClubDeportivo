<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyResultRequest;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Models\Event;
use App\Models\Result;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ResultController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $results = Result::with(['event', 'member', 'media'])->get();

        return view('admin.results.index', compact('results'));
    }

    public function create()
    {
        abort_if(Gate::denies('result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('event_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.results.create', compact('events', 'members'));
    }

    public function store(StoreResultRequest $request)
    {
        $result = Result::create($request->all());

        if ($request->input('event_report', false)) {
            $result->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_report'))))->toMediaCollection('event_report');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $result->id]);
        }

        return redirect()->route('admin.results.index');
    }

    public function edit(Result $result)
    {
        abort_if(Gate::denies('result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('event_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $result->load('event', 'member');

        return view('admin.results.edit', compact('events', 'members', 'result'));
    }

    public function update(UpdateResultRequest $request, Result $result)
    {
        $result->update($request->all());

        if ($request->input('event_report', false)) {
            if (!$result->event_report || $request->input('event_report') !== $result->event_report->file_name) {
                if ($result->event_report) {
                    $result->event_report->delete();
                }
                $result->addMedia(storage_path('tmp/uploads/' . basename($request->input('event_report'))))->toMediaCollection('event_report');
            }
        } elseif ($result->event_report) {
            $result->event_report->delete();
        }

        return redirect()->route('admin.results.index');
    }

    public function show(Result $result)
    {
        abort_if(Gate::denies('result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $result->load('event', 'member');

        return view('admin.results.show', compact('result'));
    }

    public function destroy(Result $result)
    {
        abort_if(Gate::denies('result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $result->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultRequest $request)
    {
        Result::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('result_create') && Gate::denies('result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Result();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
