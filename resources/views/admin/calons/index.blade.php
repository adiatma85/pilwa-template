@extends('layouts.admin')
@section('content')
@can('calon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.calons.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.calon.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.calon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Calon">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.calon.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.calon.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.calon.fields.visi') }}
                        </th>
                        <th>
                            {{ trans('cruds.calon.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.calon.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calons as $key => $calon)
                        <tr data-entry-id="{{ $calon->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $calon->id ?? '' }}
                            </td>
                            <td>
                                {{ $calon->name ?? '' }}
                            </td>
                            <td>
                                {{ $calon->visi ?? '' }}
                            </td>
                            <td>
                                @if($calon->image)
                                    <a href="{{ $calon->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $calon->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\Calon::TYPE_SELECT[$calon->type] ?? '' }}
                            </td>
                            <td>
                                @can('calon_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.calons.show', $calon->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('calon_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.calons.edit', $calon->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('calon_delete')
                                    <form action="{{ route('admin.calons.destroy', $calon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('calon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.calons.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Calon:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection