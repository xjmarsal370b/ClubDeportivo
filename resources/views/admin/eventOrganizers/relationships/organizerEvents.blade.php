<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                <thead>
                <tr>
                    <th>
                        {{ trans('cruds.event.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.date_event') }}
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $key => $event)
                    <tr data-entry-id="{{ $event->id }}">
                        <td>
                            {{ $event->id ?? '' }}
                        </td>
                        <td>
                            {{ $event->event_name ?? '' }}
                        </td>
                        <td>
                            {{ $event->date_event ?? '' }}
                        </td>
                        <td>
                            @can('event_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-organizerEvents:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
