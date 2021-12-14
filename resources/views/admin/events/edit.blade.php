@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="event_name">{{ trans('cruds.event.fields.event_name') }}</label>
                <input class="form-control {{ $errors->has('event_name') ? 'is-invalid' : '' }}" type="text" name="event_name" id="event_name" value="{{ old('event_name', $event->event_name) }}" required>
                @if($errors->has('event_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_event">{{ trans('cruds.event.fields.date_event') }}</label>
                <input class="form-control datetime {{ $errors->has('date_event') ? 'is-invalid' : '' }}" type="text" name="date_event" id="date_event" value="{{ old('date_event', $event->date_event) }}" required>
                @if($errors->has('date_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.date_event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="desc_event">{{ trans('cruds.event.fields.desc_event') }}</label>
                <input class="form-control {{ $errors->has('desc_event') ? 'is-invalid' : '' }}" type="text" name="desc_event" id="desc_event" value="{{ old('desc_event', $event->desc_event) }}" required>
                @if($errors->has('desc_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.desc_event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transportation_id">{{ trans('cruds.event.fields.transportation') }}</label>
                <select class="form-control select2 {{ $errors->has('transportation') ? 'is-invalid' : '' }}" name="transportation_id" id="transportation_id" required>
                    @foreach($transportations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('transportation_id') ? old('transportation_id') : $event->transportation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('transportation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transportation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.transportation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="organizer_id">{{ trans('cruds.event.fields.organizer') }}</label>
                <select class="form-control select2 {{ $errors->has('organizer') ? 'is-invalid' : '' }}" name="organizer_id" id="organizer_id" required>
                    @foreach($organizers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('organizer_id') ? old('organizer_id') : $event->organizer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('organizer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.organizer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="members">{{ trans('cruds.event.fields.member') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('members') ? 'is-invalid' : '' }}" name="members[]" id="members" multiple required>
                    @foreach($members as $id => $member)
                        <option value="{{ $id }}" {{ (in_array($id, old('members', [])) || $event->members->contains($id)) ? 'selected' : '' }}>{{ $member }}</option>
                    @endforeach
                </select>
                @if($errors->has('members'))
                    <div class="invalid-feedback">
                        {{ $errors->first('members') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.member_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_img">{{ trans('cruds.event.fields.event_img') }}</label>
                <div class="needsclick dropzone {{ $errors->has('event_img') ? 'is-invalid' : '' }}" id="event_img-dropzone">
                </div>
                @if($errors->has('event_img'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_img') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_img_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.eventImgDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').find('input[name="event_img"]').remove()
      $('form').append('<input type="hidden" name="event_img" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="event_img"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($event) && $event->event_img)
      var file = {!! json_encode($event->event_img) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="event_img" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection