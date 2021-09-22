@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.service') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.service') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/services/{{ request()->route('service') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.service') }}</label>
                        <div class="col-9">
                            <select name="service_id" class="form-control">
                                <option value="">{{ __('messages.menu.service') }}</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id === $salonService->service_id ? 'selected' : '' }}>{{ $service->name }}</option>
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
                            <input class="form-control" name="name_ar" value="{{ $salonService->name_ar }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
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
                            <input class="form-control" name="name_en" value="{{ $salonService->name_en }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
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
                            <textarea class="form-control" name="description_ar" rows="5" placeholder="{{ __('messages.description_ar') }}">{{ $salonService->description_ar }}</textarea>
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
                            <textarea class="form-control" name="description_en" rows="5" placeholder="{{ __('messages.description_en') }}">{{ $salonService->description_en }}</textarea>
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
                            <input class="form-control" name="price" value="{{ $salonService->price }}" placeholder="{{ __('messages.price') }}" autocomplete="off" />
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
                            <input class="form-control" name="minutes" value="{{ $salonService->minutes }}" placeholder="{{ __('messages.minutes') }}" autocomplete="off" />
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
                                <option value="{{ $employee->id }}" {{ in_array($employee->id, $salonService->employeesIds) ? 'selected' : '' }}>{{ $employee->name }}</option>
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
                                <option value="{{ $package->id }}" {{ in_array($package->id, $salonService->packagesIds) ? 'selected' : '' }}>{{ $package->name }}</option>
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
                        <label class="col-3 col-form-label">{{ __('messages.status') }}</label>
                        <div class="col-9">
                            <select name="is_active" class="form-control">
                              <option value="">{{ __('messages.status') }}</option>
                              <option value="1" {{ $salonService->is_active === 1 ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                              <option value="0" {{ $salonService->is_active === 0 ? 'selected' : '' }}>{{ __('messages.inactive') }}</option>
                            </select>
                            @if ($errors->has('is_active'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_active') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.home_service') }}</label>
                        <div class="col-9">
                            <input type="checkbox" name="home_service" value="1" {{ $salonService->home_service == 1 ? 'checked' : '' }} />
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
                            <input class="form-control" name="home_service_fees" value="{{ $salonService->home_service_fees }}" placeholder="{{ __('messages.home_service_fees') }}" autocomplete="off" />
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
                            <input type="submit" class="btn btn-primry" value="{{ __('messages.edit') }}" />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <!--end::Portlet-->
	</div>


</div>
@endsection