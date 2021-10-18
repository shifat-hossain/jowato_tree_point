<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{  translate('INVOICE') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        @page {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.875rem;
            font-family: 'Vollkorn SC', serif;
            font-weight: normal;
			padding:0;
			margin:0;
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}

		.header-left{
			float: left;
			width: 10%;
			border-right: 10px solid black;
			border-bottom: 10px solid black;
			height: 107px;
		}
		.header-right{
			float: left;
			width: 88.5%;
			border-bottom: 10px solid black;
			height: 107px;
		}
	</style>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Vollkorn+SC:wght@600&display=swap" rel="stylesheet">
</head>
<body>
	<div>

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
		<div style="float: left;width: 10%;text-align: center;border-right: 10px solid black;height: 100%;">
			<h1 font-size: 20px;>C</h1>
			<h1 font-size: 20px;>e</h1>
			<h1 font-size: 20px;>r</h1>
			<h1 font-size: 20px;>t</h1>
			<h1 font-size: 20px;>i</h1>
			<h1 font-size: 20px;>f</h1>
			<h1 font-size: 20px;>i</h1>
			<h1 font-size: 20px;>c</h1>
			<h1 font-size: 20px;>a</h1>
			<h1 font-size: 20px;>t</h1>
			<h1 font-size: 20px;>e</h1>
		</div>
		<div style="float: left;width: 88.5%;height: 100%;">
			<div style="width: 100%;border-left: 8px solid #86C542;border-top: 8px solid #86C542;height: 100%;">
				<div style="padding: 0px 50px 0px;">
					<h1 style="text-align: center;">MOTHER'S EARTH SAY'S THANK YOU</h1>
					<p style="font-size: 25px;margin-bottom: -10px !important;text-align: center;">
						{{ $tree->user->name }}
					</p>
					<p style="font-size: 20px;margin-top: -10px !important;border-top: 2px solid black">
						This certificate is awarded to highly respected persons like you, who are visionaries and keepers of tomorrow. 
						Your choice in shoppinf on Jowato.com is contributing to restoring our lost forest, planting fruit tress for food and sustaining endangered tree spicies
					</p>
				</div>
				<div style="padding: 0px 10px">
					<p style="font-size: 20px;color: #86C542">
						Tree ID: {{ $tree->code }}
					</p>
					
				</div>
				<div style="padding: 0px 10px">
					<p style="font-size: 20px;color: #86C542">
						Supported By
					</p>
					<p>
						@if (get_setting('supported_by_logos') != null)
							@foreach (json_decode( get_setting('supported_by_logos'), true) as $key => $value)
								<img src="{{ uploaded_asset($value) }}" style="height: 70px;">
							@endforeach
						@endif
					</p>
				</div>
			</div>
		</div>
		{{-- <div style="background: #eceff4;padding: 1rem;">
			<table>
				<tr>
					<td>
						@if($logo != null)
							<img src="{{ uploaded_asset($logo) }}" height="30" style="display:inline-block;">
						@else
							<img src="{{ static_asset('assets/img/logo.png') }}" height="30" style="display:inline-block;">
						@endif
					</td>
					<td style="font-size: 1.5rem;" class="text-right strong">{{  translate('INVOICE') }}</td>
				</tr>
			</table>

		</div> --}}

		

	</div>
</body>
</html>
