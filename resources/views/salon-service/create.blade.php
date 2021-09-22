@extends('layouts.app')
@section('title', __('messages.create').' '.__('messages.menu.salonService') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.create').' '.__('messages.menu.salonService') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/services" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.service') }}</label>
                        <div class="col-9">
                            <select name="service_id" class="form-control">
                                <option value="">{{ __('messages.menu.service') }}</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id === old('service_id') ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('service_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('service_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_ar') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name_ar" value="{{ old('name_ar') }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
                            @if ($errors->has('name_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_en') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name_en" value="{{ old('name_en') }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
                            @if ($errors->has('name_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.description_ar') }}</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description_ar" rows="5" placeholder="{{ __('messages.description_ar') }}">{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.description_en') }}</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description_en" rows="5" placeholder="{{ __('messages.description_en') }}">{{ old('description_en') }}</textarea>
                            @if ($errors->has('description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.price') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="price" value="{{ old('price') }}" placeholder="{{ __('messages.price') }}" autocomplete="off" />
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.minutes') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="minutes" value="{{ old('minutes') }}" placeholder="{{ __('messages.minutes') }}" autocomplete="off" />
                            @if ($errors->has('minutes'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('minutes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.employees') }}</label>
                        <div class="col-9">
                            <select name="employees_ids[]" class="form-control" multiple>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('employees_ids'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employees_ids') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.packages') }}</label>
                        <div class="col-9">
                            <select name="packages_ids[]" class="form-control" multiple>
                                @foreach($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('packages_ids'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('packages_ids') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.home_service') }}</label>
                        <div class="col-9">
                            <input type="checkbox" name="home_service" value="1" {{ old('home_service') == 1 ? 'checked' : '' }} />
                            @if ($errors->has('home_service'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_service') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.home_service_fees') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="number" name="home_service_fees" value="{{ old('home_service_fees') }}" placeholder="{{ __('messages.home_service_fees') }}" autocomplete="off" />
                            @if ($errors->has('home_service_fees'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('home_service_fees') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label"></label>
                        <div class="col-9">
                            <input type="submit" class="btn btn-primry" value="{{ __('messages.create') }}" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <!--end::Portlet-->
	</div>


</div>
@endsection