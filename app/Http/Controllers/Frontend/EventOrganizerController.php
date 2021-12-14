<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventOrganizerRequest;
use App\Http\Requests\StoreEventOrganizerRequest;
use App\Http\Requests\UpdateEventOrganizerRequest;
use App\Models\EventOrganizer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventOrganizerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_organizer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventOrganizers = EventOrganizer::all();

        return view('frontend.eventOrganizers.index', compact('eventOrganizers'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_organizer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.eventOrganizers.create');
    }

    public function store(StoreEventOrganizerRequest $request)
    {
        $eventOrganizer = EventOrganizer::create($request->all());

        return redirect()->route('frontend.event-organizers.index');
    }

    public function edit(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.eventOrganizers.edit', compact('eventOrganizer'));
    }

    public function update(UpdateEventOrganizerRequest $request, EventOrganizer $eventOrganizer)
    {
        $eventOrganizer->update($request->all());

        return redirect()->route('frontend.event-organizers.index');
    }

    public function show(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventOrganizer->load('organizerEvents');

        return view('frontend.eventOrganizers.show', compact('eventOrganizer'));
    }

    public function destroy(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventOrganizer->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventOrganizerRequest $request)
    {
        EventOrganizer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
