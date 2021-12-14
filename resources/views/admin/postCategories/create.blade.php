@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.postCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cat_name">{{ trans('cruds.postCategory.fields.cat_name') }}</label>
                <input class="form-control {{ $errors->has('cat_name') ? 'is-invalid' : '' }}" type="text" name="cat_name" id="cat_name" value="{{ old('cat_name', '') }}" required>
                @if($errors->has('cat_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cat_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postCategory.fields.cat_name_helper') }}</span>
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