@extends('frontend.layouts.app')

@section('meta_title'){{ $tree->name }}@stop

@section('meta_description'){{ $tree->name }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $tree->name }}">
    <meta itemprop="description" content="{{ $tree->name }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('default_certificate_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="certificate">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $tree->name }}">
    <meta name="twitter:description" content="{{ $tree->name }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('default_certificate_image')) }}">
    <meta name="twitter:data1" content="{{ $tree->user->name }}">
    <meta name="twitter:label1" content="Tree Owner">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $tree->name }}" />
    <meta property="og:type" content="og:certificate" />
    <meta property="og:url" content="{{ route('user.trees.certificate-view', $tree->id) }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('default_certificate_image')) }}" />
    <meta property="og:description" content="{{ $tree->name }}" />
    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('content')
    <style>
        .header-left{
			float: left;
            width: 15%;
            border-right: 10px solid black;
            border-bottom: 10px solid black;
            height: 135px;
		}

		.header-right{
			float: left;
            width: 84.5%;
            border-bottom: 10px solid black;
            height: 135px;
		}
    </style>

    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">

                <div class="aiz-user-panel">

                    <div class="card">
                        <div class="card-header row gutters-5">
                            <div class="col">
                                <h5 class="mb-md-0 h6">{{ translate('Tree Certificate') }}</h5>
                            </div>

                            <div class="aiz-share"></div>

                        </div>
                        <div class="card-body">
                            @php
                                $logo = get_setting('header_logo');
                            @endphp
                            <div class="header-left">
                                <div style="width: 100%;border-right: 8px solid #86C542;border-bottom: 8px solid #86C542;padding: 5px;">
                                    <img src="{{ static_asset('assets/img/tree.png') }}" style="height: 107px;">
                                </div>
                            </div>
                            <div class="header-right">
                                @if($logo != null)
                                    <img src="{{ uploaded_asset($logo) }}" height="60" style="display:inline-block;">
                                @else
                                    <img src="{{ static_asset('assets/img/logo.png') }}" height="60" style="display:inline-block;">
                                @endif
                            </div>
                            <div style="float: left;width: 15%;text-align: center;border-right: 10px solid black;height: 100%;display: flex;justify-content: center;align-items: center;">
                                <h1 style="word-break: break-all;line-height: 1.13;text-align: center;font-size: 40px;font-weight: bold;width: 24px;">
                                    Certificate
                                </h1>
                            </div>
                            <div style="float: left;width: 84.5%;height: 100%;">
                                <div style="width: 100%;border-left: 8px solid #86C542;border-top: 8px solid #86C542;height: 100%;">
                                    <div style="padding: 0px 80px 0px;">
                                        <h1 style="text-align: center;color: #878703;padding-top: 22px;">
                                            {{ translate("MOTHER EARTH SAY'S THANK YOU") }}
                                        </h1>
                                        <p style="font-size: 25px;margin-bottom: 10px !important;text-align: center;">
                                            {{ $tree->user->name }}
                                        </p>
                                        <p style="font-size: 20px;margin-top: -10px !important;border-top: 2px solid black">
                                            {{ translate("This certificate is awarded to highly respected persons like you, who are visionaries and keepers of tomorrow. 
                                            Your choice in shoppinf on Jowato.com is contributing to restoring our lost forest, planting fruit tress for food and sustaining endangered tree spicies") }}
                                        </p>
                                    </div>
                                    <div style="padding: 0px 10px">
                                        <p style="font-size: 20px;margin-bottom: 5px !important;color: #247836">
                                            {{ translate("Tree ID") }}: {{ $tree->code }}
                                        </p>
                                        <p style="font-size: 20px;margin-top: -10px !important;margin-bottom: 5px !important;color: #247836">
                                            {{ translate("Tree Location") }}: {{ $tree->location }}
                                        </p>
                                        <p style="font-size: 20px;margin-top: -10px !important;color: #247836">
                                            {{ translate("Care Taker") }}: {{ $tree->caretaker }}
                                        </p>
                                    </div>

                                    <div style="padding: 0px 10px;">
                                        <p style="font-size: 20px;color: #91911A">
                                            {{ translate("Supported By") }}
                                        </p>
                                        <p>
                                            @if (get_setting('supported_by_logos') != null)
                                                @foreach (json_decode( get_setting('supported_by_logos'), true) as $key => $value)
                                                    <img src="{{ uploaded_asset($value) }}" style="height: 100px;padding: 0px 10px;">
                                                @endforeach
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
