@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{translate('Update Tree')}}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">
                        {{translate('Update Tree Info')}}
                    </h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('trees.update', $tree->id)}}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Tree Name')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name" placeholder="{{translate('Tree name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Latitude')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="latitude" placeholder="{{translate('Latitude')}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{translate('Longitude')}}</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="longitude" placeholder="{{translate('Longitude')}}" required>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                {{ translate('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
