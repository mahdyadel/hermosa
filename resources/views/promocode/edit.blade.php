@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.promocode') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.promocode') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/promocodes/{{ request()->route('promocode') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.code') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="code" value="{{ $promocode->code }}" placeholder="{{ __('messages.code') }}" autocomplete="off" />
                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.percentage') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="number" name="percentage" value="{{ $promocode->percentage }}" placeholder="{{ __('messages.percentage') }}" autocomplete="off" />
                            @if ($errors->has('percentage'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('percentage') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.max_amount') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="number" name="max_amount" value="{{ $promocode->max_amount }}" placeholder="{{ __('messages.max_amount') }}" autocomplete="off" />
                            @if ($errors->has('max_amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('max_amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.max_use') }}</label>
                      <div class="col-9">
                        <input class="form-control" type="number" name="max_use" value="{{ $promocode->max_use }}" placeholder="{{ __('messages.max_use') }}" autocomplete="off" />
                        @if ($errors->has('max_use'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('max_use') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.expired_at') }}</label>
                      <div class="col-9">
                        <input class="form-control" type="date" name="expired_at" value="{{ $promocode->expired_at }}" placeholder="{{ __('messages.expired_at') }}" autocomplete="off" />
                        @if ($errors->has('expired_at'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('expired_at') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.services') }}</label>
                        <div class="col-9">
                            <select name="services_ids[]" class="form-control" multiple onChange="serviceChanged(this)">
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id === old('services_ids') ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('services_ids'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('services_ids') }}</strong>
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

@section('scripts')
<script>
function serviceChanged(item) {
    console.log($(item).val());
}
</script>
@endsection
