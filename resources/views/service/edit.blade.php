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
                <form action="/services/{{ request()->route('service') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">


                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_ar') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name_ar" value="{{ $service->name_ar }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
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
                            <input class="form-control" name="name_en" value="{{ $service->name_en }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
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
                            <textarea class="form-control" name="description_ar" rows="5" placeholder="{{ __('messages.description_ar') }}">{{ $service->description_ar }}</textarea>
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
                            <textarea class="form-control" name="description_en" rows="5" placeholder="{{ __('messages.description_en') }}">{{ $service->description_en }}</textarea>
                            @if ($errors->has('description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.photo') }}</label>
                        <div class="col-9">
                            <input type="file" class="form-control" name="image" />
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.icon') }}</label>
                        <div class="col-9">
                            <input type="file" class="form-control" name="icon" />
                            @if ($errors->has('icon'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('icon') }}</strong>
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