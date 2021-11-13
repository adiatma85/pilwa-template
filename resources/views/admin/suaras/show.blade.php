@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.suara.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suaras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.suara.fields.id') }}
                        </th>
                        <td>
                            {{ $suara->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suara.fields.calon') }}
                        </th>
                        <td>
                            {{ $suara->calon->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suara.fields.peserta') }}
                        </th>
                        <td>
                            {{ $suara->peserta->nim ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.suara.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Suara::TYPE_SELECT[$suara->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suaras.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection