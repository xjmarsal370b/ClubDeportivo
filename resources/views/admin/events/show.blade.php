@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h3>Mostrando {{ trans('cruds.event.title') }}: {{ $event->event_name }}</h3>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_name') }}
                        </th>
                        <td>
                            {{ $event->event_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.date_event') }}
                        </th>
                        <td>
                            {{ $event->date_event }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.desc_event') }}
                        </th>
                        <td>
                            {{ $event->desc_event }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.transportation') }}
                        </th>
                        <td>
                            {{ $event->transportation->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.organizer') }}
                        </th>
                        <td>
                            {{ $event->organizer->description ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_img') }}
                        </th>
                        <td>
                            @if($event->event_img)
                                <a href="{{ $event->event_img->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->event_img->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-header">
                <h4>Participantes</h4>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Miembro
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($event->members as $key => $member)
                    <tr>
                        <td>
                            {{ $member->id }}
                        </td>
                        <td>
                            {{ $member->name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#event_results" role="tab" data-toggle="tab">
                {{ trans('cruds.result.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="event_results">
            @includeIf('admin.events.relationships.eventResults', ['results' => $event->eventResults])
        </div>
    </div>
</div>

@endsection
