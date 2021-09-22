@extends('layouts.app')
@section('title', __('messages.create').' '.__('messages.menu.country') )

@section('content')
<div class="row">
	<div class="col-md-12">
		<!--begin::Portlet-->
    <div class="m-portlet m-portlet--full-height">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ __('messages.create').' '.__('messages.menu.country') }}
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
        </div>
      </div>

      <div class="m-portlet__body">
        <form action="/countries" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
            <label class="col-3 col-form-label">{{ __('messages.country_code') }}</label>
            <div class="col-9">
              <input class="form-control" name="country_code" value="{{ old('country_code') }}" placeholder="{{ __('messages.country_code') }}" autocomplete="off" />
              @if ($errors->has('country_code'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('country_code') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.mobile_length') }}</label>
            <div class="col-9">
              <input class="form-control" name="mobile_length" value="{{ old('mobile_length') }}" placeholder="{{ __('messages.mobile_length') }}" autocomplete="off" />
              @if ($errors->has('mobile_length'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('mobile_length') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.flag') }}</label>
            <div class="col-9">
              <input class="form-control" name="flag" type="file" />
              @if ($errors->has('flag'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('flag') }}</strong>
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