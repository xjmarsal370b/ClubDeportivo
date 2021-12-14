@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.update", [$post->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="post_title">{{ trans('cruds.post.fields.post_title') }}</label>
                <input class="form-control {{ $errors->has('post_title') ? 'is-invalid' : '' }}" type="text" name="post_title" id="post_title" value="{{ old('post_title', $post->post_title) }}" required>
                @if($errors->has('post_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_header">{{ trans('cruds.post.fields.post_header') }}</label>
                <input class="form-control {{ $errors->has('post_header') ? 'is-invalid' : '' }}" type="text" name="post_header" id="post_header" value="{{ old('post_header', $post->post_header) }}" required>
                @if($errors->has('post_header'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_header') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_header_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.post.fields.post_status') }}</label>
                @foreach(App\Models\Post::POST_STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('post_status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="post_status_{{ $key }}" name="post_status" value="{{ $key }}" {{ old('post_status', $post->post_status) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="post_status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('post_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.post.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $post->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.post.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $post->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_img">{{ trans('cruds.post.fields.post_img') }}</label>
                <div class="needsclick dropzone {{ $errors->has('post_img') ? 'is-invalid' : '' }}" id="post_img-dropzone">
                </div>
                @if($errors->has('post_img'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_img') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.post.fields.post_img_helper') }}</span>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#post_header' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script>
    Dropzone.options.postImgDropzone = {
    url: '{{ route('admin.posts.storeMedia') }}',
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
      $('form').find('input[name="post_img"]').remove()
      $('form').append('<input type="hidden" name="post_img" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="post_img"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($post) && $post->post_img)
      var file = {!! json_encode($post->post_img) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="post_img" value="' + file.file_name + '">')
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
