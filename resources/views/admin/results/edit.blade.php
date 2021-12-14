@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.result.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.results.update", [$result->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.result.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $result->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="member_id">{{ trans('cruds.result.fields.member') }}</label>
                <select class="form-control select2 {{ $errors->has('member') ? 'is-invalid' : '' }}" name="member_id" id="member_id" required>
                    @foreach($members as $id => $entry)
                        <option value="{{ $id }}" {{ (old('member_id') ? old('member_id') : $result->member->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.member_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="score">{{ trans('cruds.result.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="text" name="score" id="score" value="{{ old('score', $result->score) }}" required>
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.score_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="event_report">{{ trans('cruds.result.fields.event_report') }}</label>
                <div class="needsclick dropzone {{ $errors->has('event_report') ? 'is-invalid' : '' }}" id="event_report-dropzone">
                </div>
                @if($errors->has('event_report'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_report') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.event_report_helper') }}</span>
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
    Dropzone.options.eventReportDropzone = {
    url: '{{ route('admin.results.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="event_report"]').remove()
      $('form').append('<input type="hidden" name="event_report" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="event_report"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($result) && $result->event_report)
      var file = {!! json_encode($result->event_report) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="event_report" value="' + file.file_name + '">')
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