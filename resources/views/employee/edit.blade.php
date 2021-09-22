@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.employee') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.employee') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/employees/{{ request()->route('employee') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_ar') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name_ar" value="{{ $employee->name_ar }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
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
                            <input class="form-control" name="name_en" value="{{ $employee->name_en }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
                            @if ($errors->has('name_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.photo') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="photo" type="file" />
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.salary') }}</label>
                      <div class="col-9">
                        <input class="form-control" name="salary" value="{{ $employee->salary }}" placeholder="{{ __('messages.salary') }}" autocomplete="off" />
                        @if ($errors->has('salary'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('salary') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.insurance') }}</label>
                      <div class="col-9">
                        <input class="form-control" name="insurance" value="{{ $employee->insurance }}" placeholder="{{ __('messages.insurance') }}" autocomplete="off" />
                        @if ($errors->has('insurance'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('insurance') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.gender') }}</label>
                      <div class="col-9">
                        <select name="gender" id="gender" class="form-control">
                          <option value="">{{ __('messages.gender') }}</option>
                          <option value="F" {{ $employee->gender == "F" ? 'selected' : '' }}>
                            {{ __('messages.female') }}
                          </option>
                          <option value="M" {{ $employee->gender == "M" ? 'selected' : '' }}>
                            {{ __('messages.male') }}
                          </option>
                        </select>

                        @if ($errors->has('gender'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.services') }}</label>
                        <div class="col-9">
                            <select name="salon_services_ids[]" class="form-control" multiple>
                                @foreach($salonServices as $salonService)
                                <option value="{{ $salonService->id }}" {{ in_array($salonService->id, $employee->salonServicesIds) ? 'selected' : '' }}>{{ $salonService->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('salon_services_ids'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salon_services_ids') }}</strong>
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