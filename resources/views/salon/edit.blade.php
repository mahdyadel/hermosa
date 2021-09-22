@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.salon') )

@section('content')
<div class="row">
	<div class="col-md-12">
		<!--begin::Portlet-->
    <div class="m-portlet m-portlet--full-height">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ __('messages.edit').' '.__('messages.menu.salon') }}
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
        </div>
      </div>

      <div class="m-portlet__body">
        <form action="/salons/{{ request()->route('salon') }}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">
          
          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.name_ar') }} *</label>
            <div class="col-9">
              <input class="form-control" name="name_ar" value="{{ $salon->name_ar }}" placeholder="{{ __('messages.name_ar') }}" autocomplete="off" />
              @if ($errors->has('name_ar'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name_ar') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.name_en') }} *</label>
            <div class="col-9">
              <input class="form-control" name="name_en" value="{{ $salon->name_en }}" placeholder="{{ __('messages.name_en') }}" autocomplete="off" />
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
            <label class="col-3 col-form-label">{{ __('messages.logo') }}</label>
            <div class="col-9">
              <input class="form-control" type="file" name="logo" />
              @if ($errors->has('logo'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('logo') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.phone') }} *</label>
            <div class="col-9">
              <input class="form-control" name="phone" value="{{ $salon->phone }}" placeholder="{{ __('messages.phone') }}" autocomplete="off" />
              @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('phone') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.phone_2') }}</label>
            <div class="col-9">
              <input class="form-control" name="phone_2" value="{{ $salon->phone_2 }}" placeholder="{{ __('messages.phone_2') }}" autocomplete="off" />
              @if ($errors->has('phone_2'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('phone_2') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_name') }} *</label>
            <div class="col-9">
              <input class="form-control" name="bank_name" value="{{ $salon->bank_name }}" placeholder="{{ __('messages.bank_name') }}" autocomplete="off" />
              @if ($errors->has('bank_name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_account_number') }} *</label>
            <div class="col-9">
              <input class="form-control" name="bank_account_number" value="{{ $salon->bank_account_number }}" placeholder="{{ __('messages.bank_account_number') }}" autocomplete="off" />
              @if ($errors->has('bank_account_number'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_account_number') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_account_number') }} PDF</label>
            <div class="col-9">
              <input class="form-control" type="file" name="bank_account_number_pdf" />
              @if ($errors->has('bank_account_number_pdf'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_account_number_pdf') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_name_2') }}</label>
            <div class="col-9">
              <input class="form-control" name="bank_name_2" value="{{ $salon->bank_name_2 }}" placeholder="{{ __('messages.bank_name_2') }}" autocomplete="off" />
              @if ($errors->has('bank_name_2'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_name_2') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_account_number_2') }}</label>
            <div class="col-9">
              <input class="form-control" name="bank_account_number_2" value="{{ $salon->bank_account_number_2 }}" placeholder="{{ __('messages.bank_account_number_2') }}" autocomplete="off" />
              @if ($errors->has('bank_account_number_2'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_account_number_2') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.bank_account_number_2') }} PDF</label>
            <div class="col-9">
              <input class="form-control" type="file" name="bank_account_number_2_pdf" />
              @if ($errors->has('bank_account_number_2_pdf'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('bank_account_number_2_pdf') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.tax_number') }}</label>
            <div class="col-9">
              <input class="form-control" name="tax_number" value="{{ $salon->tax_number }}" placeholder="{{ __('messages.tax_number') }}" autocomplete="off" />
              @if ($errors->has('tax_number'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('tax_number') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.tax_number') }} PDF</label>
            <div class="col-9">
              <input class="form-control" type="file" name="tax_number_pdf" />
              @if ($errors->has('tax_number_pdf'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('tax_number_pdf') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.commercial_register') }}</label>
            <div class="col-9">
              <input class="form-control" name="commercial_register" value="{{ $salon->commercial_register }}" placeholder="{{ __('messages.commercial_register') }}" autocomplete="off" />
              @if ($errors->has('commercial_register'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('commercial_register') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.commercial_register') }} PDF</label>
            <div class="col-9">
              <input class="form-control" type="file" name="commercial_register_pdf" />
              @if ($errors->has('commercial_register_pdf'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('commercial_register_pdf') }}</strong>
                </span>
              @endif
            </div>
          </div>

          @if(auth()->user()->type === 'ADMIN')
          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.percentage') }} *</label>
            <div class="col-9">
              <input class="form-control" name="percentage" value="{{ $salon->percentage }}" placeholder="{{ __('messages.percentage') }}" autocomplete="off" />
              @if ($errors->has('percentage'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('percentage') }}</strong>
                </span>
              @endif
            </div>
          </div>
          @endif

          <div class="form-group row">
            <label class="col-3 col-form-label">{{ __('messages.deposit_percentage') }} *</label>
            <div class="col-9">
              <input class="form-control" name="deposit_percentage" value="{{ $salon->deposit_percentage }}" placeholder="{{ __('messages.deposit_percentage') }}" autocomplete="off" />
              @if ($errors->has('deposit_percentage'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('deposit_percentage') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
              <label class="col-3 col-form-label">{{ __('messages.menu.country') }} *</label>
              <div class="col-9">

              <select name="country_id" class="form-control" onChange="getCitiesByCountryId(this.value)">
                  <option value="">{{ __('messages.menu.country') }}</option>
                  @foreach($countries as $country)
                  <option value="{{ $country->id }}" {{ $country->id == $salon->country_id ? 'selected' : '' }}>
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
              <label class="col-3 col-form-label">{{ __('messages.menu.city') }} *</label>
              <div class="col-9">

              <select name="city_id" id="city_id" class="form-control">
                  <option value="">{{ __('messages.menu.city') }}</option>
                  @foreach($cities as $city)
                  <option value="{{ $city->id }}" {{ $city->id == $salon->city_id ? 'selected' : '' }}>
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