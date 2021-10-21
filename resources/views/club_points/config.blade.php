@extends('backend.layouts.app')
@section('content')

@php
    $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
    $donate_amount_convert_rate = \App\BusinessSetting::where('type', 'donate_amount_convert_rate')->first();
@endphp
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Convert Point To Tree')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('point_convert_rate_store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="club_point_convert_rate">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('Set Point For 1 Tree') }}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" min="0" step="0.01" class="form-control" name="value" @if ($club_point_convert_rate != null) value="{{ $club_point_convert_rate->value }}" @endif placeholder="100" required>
                            </div>
                            <div class="col-lg-2">
                                <label class="col-from-label">{{translate('Points')}}</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 text-right">
								<button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
						</div>
                    </form>
                    {{-- <i class="fs-12">
                        <b>
                            {{ translate('Note: You need to activate wallet option first before using club point addon.') }}
                        </b>
                    </i> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Convert Donate To Point')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('store-convert-donate-to-point') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="donate_amount_convert_rate">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="col-from-label">{{translate('Set Donate For 1 Tree Point') }}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" min="0" step="0.01" class="form-control" name="value" @if ($donate_amount_convert_rate != null) value="{{ $donate_amount_convert_rate->value }}" @endif placeholder="100" required>
                            </div>
                            <div class="col-lg-2">
                                <label class="col-from-label">{{translate('Donate Amount')}}</label>
                            </div>
                        </div>
                        <div class="form-group mb-3 text-right">
								<button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
						</div>
                    </form>
                    {{-- <i class="fs-12">
                        <b>
                            {{ translate('Note: You need to activate wallet option first before using club point addon.') }}
                        </b>
                    </i> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Certificate Image')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                        @csrf
						<input type="hidden" name="types[]" value="default_certificate_image">
						<div class="row gutters-5">
                            <label class="col-md-3 col-from-label">{{translate('Certificate Image')}}</label>
							<div class="col-md-9">
								<div class="input-group form-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="default_certificate_image" class="selected-files" value="{{ get_setting('default_certificate_image') }}">
                                </div>
                                <div class="file-preview"></div>
							</div>
						</div>
                        <div class="form-group mb-3 text-right">
							<button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
						</div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Supported By Logos In Certificate')}}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                        @csrf
                        <div class="header-nav-menu">
							<input type="hidden" name="types[]" value="supported_by_logos">
							@if (get_setting('supported_by_logos') != null)
								@foreach (json_decode( get_setting('supported_by_logos'), true) as $key => $value)
									<div class="row gutters-5">
                                        <label class="col-md-3 col-from-label">{{translate('Supported Logos')}}</label>
										<div class="col-md-8">
											<div class="input-group form-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="supported_by_logos[]" class="selected-files" value="{{ $value }}">
                                            </div>
                                            <div class="file-preview"></div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='<div class="row gutters-5">
                                        <label class="col-md-3 col-from-label">{{translate('Supported Logos')}}</label>
                                        <div class="col-md-8">
                                            <div class="input-group form-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="supported_by_logos[]" class="selected-files">
                                            </div>
                                            <div class="file-preview"></div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                            </button>
                                        </div>
							        </div>'
							data-target=".header-nav-menu">
							{{ translate('Add New') }}
						</button>
                        <div class="form-group mb-3 text-right">
							<button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
