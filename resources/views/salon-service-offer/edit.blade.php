@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.offer') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.offer') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/offers/{{ request()->route('offer') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.salonService') }}</label>
                        <div class="col-9">
                            <select name="salon_service_id" class="form-control">
                                <option value="">{{ __('messages.menu.salonService') }}</option>
                                @foreach($salonServices as $salonService)
                                <option value="{{ $salonService->id }}" {{ $salonService->id === $salonServiceOffer->salon_service_id ? 'selected' : '' }}>{{ $salonService->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('salon_service_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('salon_service_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.new_price') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="number" name="new_price" value="{{ $salonServiceOffer->new_price }}" placeholder="{{ __('messages.new_price') }}" autocomplete="off" />
                            @if ($errors->has('new_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.hours') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="number" name="hours" value="{{ $salonServiceOffer->hours }}" placeholder="{{ __('messages.hours') }}" autocomplete="off" />
                            @if ($errors->has('hours'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('hours') }}</strong>
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