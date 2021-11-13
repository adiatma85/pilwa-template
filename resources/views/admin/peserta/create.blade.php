@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pesertum.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.peserta.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nim">{{ trans('cruds.pesertum.fields.nim') }}</label>
                <input class="form-control {{ $errors->has('nim') ? 'is-invalid' : '' }}" type="text" name="nim" id="nim" value="{{ old('nim', '') }}">
                @if($errors->has('nim'))
                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pesertum.fields.nim_helper') }}</span>
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