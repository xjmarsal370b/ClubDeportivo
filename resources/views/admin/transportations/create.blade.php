@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transportation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transportations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.transportation.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transportation.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.transportation.fields.transportation_type') }}</label>
                <select class="form-control {{ $errors->has('transportation_type') ? 'is-invalid' : '' }}" name="transportation_type" id="transportation_type" required>
                    <option value disabled {{ old('transportation_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Transportation::TRANSPORTATION_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('transportation_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('transportation_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transportation_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transportation.fields.transportation_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dep_place">{{ trans('cruds.transportation.fields.dep_place') }}</label>
                <input class="form-control {{ $errors->has('dep_place') ? 'is-invalid' : '' }}" type="text" name="dep_place" id="dep_place" value="{{ old('dep_place', '') }}" required>
                @if($errors->has('dep_place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dep_place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transportation.fields.dep_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dep_date">{{ trans('cruds.transportation.fields.dep_date') }}</label>
                <input class="form-control datetime {{ $errors->has('dep_date') ? 'is-invalid' : '' }}" type="text" name="dep_date" id="dep_date" value="{{ old('dep_date') }}" required>
                @if($errors->has('dep_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dep_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transportation.fields.dep_date_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection