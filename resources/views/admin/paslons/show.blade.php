@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paslon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.paslons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paslon.fields.id') }}
                        </th>
                        <td>
                            {{ $paslon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paslon.fields.visi') }}
                        </th>
                        <td>
                            {{ $paslon->visi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paslon.fields.misi') }}
                        </th>
                        <td>
                            {!! $paslon->misi !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.paslons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection