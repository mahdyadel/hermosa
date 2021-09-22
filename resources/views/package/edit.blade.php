@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.package') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.package') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/packages/{{ request()->route('package') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_ar') }} *</label>
                        <div class="col-9">
                            <input class="form-control" name="name_ar" value="{{ $package->name_ar }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
                            @if ($errors->has('name_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name_ar') }} *</label>
                        <div class="col-9">
                            <input class="form-control" name="name_en" value="{{ $package->name_en }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
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
                            <input class="form-control" name="image" type="file" />
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.description_ar') }}</label>
                        <div class="col-9">
                            <textarea class="form-control" name="description_ar" placeholder="{{ __('messages.description_ar') }}">{{ $package->description_ar }}</textarea>
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
                            <textarea class="form-control" name="description_en" placeholder="{{ __('messages.description_en') }}">{{ $package->description_en }}</textarea>
                            @if ($errors->has('description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.color') }} *</label>
                        <div class="col-9">
                            <input class="form-control" type="color" name="color" value="{{ $package->color }}" placeholder="{{ __('messages.color') }}" autocomplete="off" />
                            @if ($errors->has('color'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.amount') }} *</label>
                      <div class="col-9">
                        <input class="form-control" type="number" name="amount" value="{{ $package->amount }}" placeholder="{{ __('messages.amount') }}" autocomplete="off" />
                        @if ($errors->has('amount'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('amount') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.duration') }} *</label>
                      <div class="col-9">
                        <input class="form-control" type="number" name="duration" value="{{ $package->duration }}" placeholder="{{ __('messages.duration') }}" autocomplete="off" />
                        @if ($errors->has('duration'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('duration') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-3 col-form-label">{{ __('messages.discount_percentage') }} *</label>
                      <div class="col-9">
                        <input class="form-control" type="number" name="discount_percentage" value="{{ $package->discount_percentage }}" placeholder="{{ __('messages.discount_percentage') }}" autocomplete="off" />
                        @if ($errors->has('discount_percentage'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('discount_percentage') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>

                    
                    <!-- <div class="form-group row">
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
                    </div> -->

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
