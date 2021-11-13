@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.suara.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.suaras.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="calon_id">{{ trans('cruds.suara.fields.calon') }}</label>
                <select class="form-control select2 {{ $errors->has('calon') ? 'is-invalid' : '' }}" name="calon_id" id="calon_id">
                    @foreach($calons as $id => $entry)
                        <option value="{{ $id }}" {{ old('calon_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('calon'))
                    <span class="text-danger">{{ $errors->first('calon') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suara.fields.calon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="peserta_id">{{ trans('cruds.suara.fields.peserta') }}</label>
                <select class="form-control select2 {{ $errors->has('peserta') ? 'is-invalid' : '' }}" name="peserta_id" id="peserta_id">
                    @foreach($pesertas as $id => $entry)
                        <option value="{{ $id }}" {{ old('peserta_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peserta'))
                    <span class="text-danger">{{ $errors->first('peserta') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suara.fields.peserta_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.suara.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Suara::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suara.fields.type_helper') }}</span>
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