@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.calon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.calons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.calon.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calon.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visi">{{ trans('cruds.calon.fields.visi') }}</label>
                <input class="form-control {{ $errors->has('visi') ? 'is-invalid' : '' }}" type="text" name="visi" id="visi" value="{{ old('visi', '') }}">
                @if($errors->has('visi'))
                    <span class="text-danger">{{ $errors->first('visi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calon.fields.visi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misi">{{ trans('cruds.calon.fields.misi') }}</label>
                <input class="form-control {{ $errors->has('misi') ? 'is-invalid' : '' }}" type="text" name="misi" id="misi" value="{{ old('misi', '') }}">
                @if($errors->has('misi'))
                    <span class="text-danger">{{ $errors->first('misi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calon.fields.misi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.calon.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calon.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.calon.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Calon::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.calon.fields.type_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.calons.storeMedia') }}',
    maxFilesize: 3, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 3,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($calon) && $calon->image)
      var file = {!! json_encode($calon->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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