@can('post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.posts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.post.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.post.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userPosts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.post.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.post_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.post_header') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.post_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.post.fields.post_img') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $key => $post)
                        <tr data-entry-id="{{ $post->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $post->id ?? '' }}
                            </td>
                            <td>
                                {{ $post->post_title ?? '' }}
                            </td>
                            <td>
                                {{ $post->post_header ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Post::POST_STATUS_RADIO[$post->post_status] ?? '' }}
                            </td>
                            <td>
                                {{ $post->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $post->category->cat_name ?? '' }}
                            </td>
                            <td>
                                @if($post->post_img)
                                    <a href="{{ $post->post_img->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $post->post_img->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('post_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.posts.show', $post->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('post_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.posts.edit', $post->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('post_delete')
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('post_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.posts.massDestroy') }}",
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
  let table = $('.datatable-userPosts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection