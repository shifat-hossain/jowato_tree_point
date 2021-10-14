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
                                <th data-breakpoints="lg">{{translate('Customer Name')}}</th>
                                <th>{{translate('Latitude')}}</th>
                                <th>{{translate('Longitude')}}</th>
                                <th data-breakpoints="lg">{{translate('Planted At')}}</th>
                                <th class="text-right" width="10%">{{translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trees as $key => $tree)
                                <tr>
                                    <td>{{ ($key+1) + ($trees->currentPage() - 1)*$trees->perPage() }}</td>
                                    <td>
                                        {{ $tree->code }}
                                    </td>
                                    <td>
                                        @if ($tree->user != null)
                                            {{ $tree->user->name }}
                                        @else
                                            {{ translate('User not found') }}
                                        @endif
                                    </td>
                                    <td>{{ $tree->latitude }}</td>
                                    <td>{{ $tree->longitude }}</td>
                                    <td>{{ $tree->planted_at }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('trees.edit', encrypt($tree->id))}}" title="{{ translate('Set Tree') }}">
                                            <i class="las la-tree"></i>
                                        </a>
        								{{-- <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('club_point.details', encrypt($tree->id))}}" title="{{ translate('View') }}">
        									<i class="las la-eye"></i>
        								</a> --}}
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
