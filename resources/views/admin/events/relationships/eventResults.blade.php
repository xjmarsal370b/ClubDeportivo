<div class="card">
    <div class="card-header">
        {{ trans('cruds.result.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventResults">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.result.fields.member') }}
                        </th>
                        <th>
                            {{ trans('cruds.result.fields.score') }}
                        </th>
                        <th>
                            {{ trans('cruds.result.fields.event_report') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $key => $result)
                        <tr data-entry-id="{{ $result->id }}">
                            <td>
                                {{ $result->member->name ?? '' }}
                            </td>
                            <td>
                                {{ $result->score ?? '' }}
                            </td>
                            <td>
                                @if($result->event_report)
                                    <a href="{{ $result->event_report->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
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


</script>
@endsection
