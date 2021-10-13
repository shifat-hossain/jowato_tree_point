@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{translate('Code')}}</th>
                                <th  data-breakpoints="lg">{{translate('Customer Name')}}</th>
                                <th>{{translate('Latitude')}}</th>
                                <th data-breakpoints="lg">{{translate('Longitude')}}</th>
                                <th data-breakpoints="lg">{{translate('Planted At')}}</th>
                                <th class="text-right" width="10%">{{translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trees as $key => $tree)
                                <tr>
                                    <td>{{ ($key+1) + ($club_points->currentPage() - 1)*$club_points->perPage() }}</td>
                                    <td>
                                        @if ($club_point->order != null)
                                            {{ $club_point->order->code }}
                                        @else
                                            {{ translate('Order not found') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($club_point->user != null)
                                            {{ $club_point->user->name }}
                                        @else
                                            {{ translate('User not found') }}
                                        @endif
                                    </td>
                                    <td>{{ $club_point->points }}</td>
                                    <td>
                                        @if ($club_point->convert_status == 1)
                                          <span class="badge badge-inline badge-success">{{translate('Converted')}}</span>
                                        @else
                                          <span class="badge badge-inline badge-info">{{translate('Pending')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $club_point->created_at }}</td>
                                    <td class="text-right">
                                        @if ($club_point->points >= get_setting('club_point_convert_rate'))
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('set-tree', encrypt($club_point->id))}}" title="{{ translate('Set Tree') }}">
                                                <i class="las la-tree"></i>
                                            </a>
                                        @endif
        								<a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('club_point.details', encrypt($club_point->id))}}" title="{{ translate('View') }}">
        									<i class="las la-eye"></i>
        								</a>
  				                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $trees->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection