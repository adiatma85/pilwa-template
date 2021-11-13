@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paslon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.paslons.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="visi">{{ trans('cruds.paslon.fields.visi') }}</label>
                <input class="form-control {{ $errors->has('visi') ? 'is-invalid' : '' }}" type="text" name="visi" id="visi" value="{{ old('visi', '') }}">
                @if($errors->has('visi'))
                    <span class="text-danger">{{ $errors->first('visi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.paslon.fields.visi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="misi">{{ trans('cruds.paslon.fields.misi') }}</label>
                <input class="form-control {{ $errors->has('misi') ? 'is-invalid' : '' }}" type="text" name="misi" id="misi" value="{{ old('misi', '') }}">
                @if($errors->has('misi'))
                    <span class="text-danger">{{ $errors->first('misi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.paslon.fields.misi_helper') }}</span>
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