@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.user') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                        {{ __('messages.edit').' '.__('messages.menu.user') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/users/{{ request()->route('user') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.first_name') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="first_name" value="{{ $user->first_name }}" placeholder="{{ __('messages.first_name') }}" autocomplete="off" />
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.last_name') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="{{ __('messages.last_name') }}" autocomplete="off" />
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.email') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="email" value="{{ $user->email }}" placeholder="{{ __('messages.email') }}" autocomplete="off" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.phone') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="mobile" value="{{ $user->mobile }}" placeholder="{{ __('messages.phone') }}" autocomplete="off" />
                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.birthdate') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="date" name="birthdate" value="{{ $user->birthdate }}" placeholder="{{ __('messages.birthdate') }}" autocomplete="off" />
                            @if ($errors->has('birthdate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthdate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.country') }}</label>
                        <div class="col-9">

                        <select name="country_id" class="form-control" onChange="getCitiesByCountryId(this.value)">
                            <option value="">{{ __('messages.menu.country') }}</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $country->id == $user->city->country_id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @endforeach
                        </select>

                        @if ($errors->has('country_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.city') }}</label>
                        <div class="col-9">

                        <select name="city_id" id="city_id" class="form-control">
                            <option value="">{{ __('messages.menu.city') }}</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $city->id == $user->city_id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                            @endforeach
                        </select>

                        @if ($errors->has('city_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('city_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.block') }}</label>
                        <div class="col-9">
                            <select name="is_blocked" class="form-control">
                              <option value="">{{ __('messages.status') }}</option>
                              <option value="1" {{ $user->is_blocked === 1 ? 'selected' : '' }}>{{ __('messages.block') }}</option>
                              <option value="0" {{ $user->is_blocked === 0 ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                            </select>
                            @if ($errors->has('is_blocked'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_blocked') }}</strong>
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
function getCitiesByCountryId(countryId) {
    $.ajax({
        url: "/countries/"+countryId+"/cities/json", 
        success: function(cities) {
            $("#city_id").html("");
            $("#city_id").append('<option value="">{{ __("messages.menu.city") }}</option>');
            cities.forEach(city => {
                $("#city_id").append('<option value="'+city.id+'">'+city.name+'</option>');
            });
        }
    });
}
</script>
@endsection