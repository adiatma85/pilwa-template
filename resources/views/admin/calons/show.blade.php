@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.calon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.calons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.id') }}
                        </th>
                        <td>
                            {{ $calon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.name') }}
                        </th>
                        <td>
                            {{ $calon->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.visi') }}
                        </th>
                        <td>
                            {{ $calon->visi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.misi') }}
                        </th>
                        <td>
                            {!! $calon->misi !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.image') }}
                        </th>
                        <td>
                            @if($calon->image)
                                <a href="{{ $calon->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $calon->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.calon.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Calon::TYPE_SELECT[$calon->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.calons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection