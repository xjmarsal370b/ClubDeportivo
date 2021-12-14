@extends('layouts.admin')
@section('content')
@can('transportation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transportations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transportation.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transportation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transportation">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transportation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transportation.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.transportation.fields.dep_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transportations as $key => $transportation)
                        <tr data-entry-id="{{ $transportation->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transportation->id ?? '' }}
                            </td>
                            <td>
                                {{ $transportation->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $transportation->dep_date ?? '' }}
                            </td>
                            <td>
                                @can('transportation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transportations.show', $transportation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('transportation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transportations.edit', $transportation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('transportation_delete')
                                    <form action="{{ route('admin.transportations.destroy', $transportation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('transportation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transportations.massDestroy') }}",
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
  let table = $('.datatable-Transportation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
