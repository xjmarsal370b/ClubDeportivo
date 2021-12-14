@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.event.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.events.index') }}">
                                Volver a Eventos
                            </a>
                        </div>
                        <div
                            class="p-5 text-center bg-image rounded-3"
                            style="
                                    @if($event->event_img)
                                        background-image: url('{{$event->event_img->getUrl()}}');
                                    @endif
                                    height: 400px;
                                    background-size: cover;
                                    box-shadow: inset 0 0 5px 5px #ffffff;
                                  "
                        >
                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);
                                                     padding: 1rem;
                                                     border-radius: 10px;">
                                <div class=item-align-left>
                                    <div class="text-white">
                                        <h1 class="text-left">{{ $event->event_name }}</h1>
                                        <p class="text-left mb-2"><small class="mb-3 text-left">{{ trans('cruds.event.fields.date_event') }} {{ $event->date_event }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h3>{{ trans('cruds.event.fields.desc_event') }}</h3>
                                <div class="alert alert-secondary" role="alert">
                                    {{ $event->desc_event }}
                                </div>
                        </div>
                        <div class="mt-2">
                            <h3>{{ trans('cruds.event.fields.transportation') }}</h3>
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            Empresa ocupada del transporte
                                        </th>
                                        <th>
                                            Vehículo
                                        </th>
                                        <th>
                                            Lugar de salida
                                        </th>
                                        <th>
                                            Fecha y hora de salida
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $event->transportation->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->transportation->transportation_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->transportation->dep_place ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->transportation->dep_date ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Participantes</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    @foreach($event->members as $key => $member)
                                        @if($member->id === Auth::user()->id)
                                            <tr><td class="text-success">{{ $member->name }}</td></tr>
                                        @else
                                       <tr><td>{{ $member->name }}</td></tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <a class="btn btn-default" href="{{ route('frontend.events.index') }}">
                                Volver a Eventos
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Evento organizado por {{ $event->organizer->description ?? '' }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
