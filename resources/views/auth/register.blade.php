<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        
		<title>Register</title>
        <meta name="description" content="Latest updates and statistic charts"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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

		<!--begin::Base Styles -->
		@if(app()->isLocale('en'))
		<link href="/assets/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		@else
		<link href="/assets/css/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
		<link href="/css/font-ar.css" rel="stylesheet" type="text/css" />
		@endif
		<!--end::Base Styles -->

		<!--begin Styles -->
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
    	<!--end::Styles -->

	    <link rel="shortcut icon" href="/images/icon.png" /> 
    </head>
    <!-- end::Head -->

    
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        
        <div class="container">

            <div class="register-logo">
                <img src="/images/logo.png" width="150px">
                <!-- <h3>{{ __('messages.hermosa') }}</h3> -->
            </div>

            <div class="register-form-container">
                <form class="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="row justify-content-center">
                            <h3>Salon</h3>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.menu.country') }} *</label>
                                <div class="col-9">

                                <select name="country_id" class="form-control" onChange="getCitiesByCountryId(this.value)">
                                    <option value="">{{ __('messages.menu.country') }}</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == old('country_id') ? 'selected' : '' }}>
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

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.menu.city') }} *</label>
                                <div class="col-9">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">{{ __('messages.menu.city') }}</option>
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.name_ar') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.name_ar') }} *" name="name_ar" value="{{ old('name_ar') }}" autocomplete="off" required autofocus>
                                    @if ($errors->has('name_ar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_ar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.name_en') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.name_en') }} *" name="name_en" value="{{ old('name_en') }}" autocomplete="off">
                                    @if ($errors->has('name_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.photo') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" name="photo" type="file">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.logo') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" name="logo" type="file">
                                    @if ($errors->has('logo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.phone') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.phone') }} *" name="phone" value="{{ old('phone') }}" autocomplete="off" required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.phone_2') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.phone_2') }}" name="phone_2" value="{{ old('phone_2') }}" autocomplete="off">
                                    @if ($errors->has('phone_2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_name') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.bank_name') }} *" name="bank_name" value="{{ old('bank_name') }}" autocomplete="off" required>
                                    @if ($errors->has('bank_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_account_number') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.bank_account_number') }} *" name="bank_account_number" value="{{ old('bank_account_number') }}" autocomplete="off" required>
                                    @if ($errors->has('bank_account_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_account_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_account_number') }} PDF</label>
                                <div class="col-9">
                                    <input class="form-control m-input" name="bank_account_number_pdf" type="file">
                                    @if ($errors->has('bank_account_number_pdf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_account_number_pdf') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_name_2') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.bank_name_2') }}" name="bank_name_2" value="{{ old('bank_name_2') }}" autocomplete="off">
                                    @if ($errors->has('bank_name_2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_name_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_account_number_2') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.bank_account_number_2') }}" name="bank_account_number_2" value="{{ old('bank_account_number_2') }}" autocomplete="off">
                                    @if ($errors->has('bank_account_number_2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_account_number_2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.bank_account_number_2') }} PDF</label>
                                <div class="col-9">
                                    <input class="form-control m-input" name="bank_account_number_2_pdf" type="file">
                                    @if ($errors->has('bank_account_number_2_pdf'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bank_account_number_2_pdf') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.tax_number') }}</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.tax_number') }}" name="tax_number" value="{{ old('tax_number') }}" autocomplete="off">
                                    @if ($errors->has('tax_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tax_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
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

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.commercial_register') }}</label>
                                <div class="col-9">
                                <input class="form-control m-input" type="text" placeholder="{{ __('messages.commercial_register') }}" name="commercial_register" value="{{ old('commercial_register') }}" autocomplete="off">
                                    @if ($errors->has('commercial_register'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('commercial_register') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
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

                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <h3>Owner</h3>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.name') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.name') }} *" name="owner_name" value="{{ old('owner_name') }}" autocomplete="off" required>
                                    @if ($errors->has('owner_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('owner_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.email') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="email" placeholder="{{ __('messages.email') }} *" name="owner_email" value="{{ old('owner_email') }}" autocomplete="off" required>
                                    @if ($errors->has('owner_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('owner_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.mobile') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="text" placeholder="{{ __('messages.mobile') }} *" name="owner_phone" value="{{ old('owner_phone') }}" autocomplete="off" required>
                                    @if ($errors->has('owner_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('owner_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-3 col-form-label">{{ __('messages.password') }} *</label>
                                <div class="col-9">
                                    <input class="form-control m-input" type="password" placeholder="{{ __('messages.password') }} *" name="owner_password" value="{{ old('owner_password') }}" autocomplete="off" required>
                                    @if ($errors->has('owner_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('owner_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="container">
                        <div class="row justify-content-center">
                            <button style="width: 30%; margin: 10px 0; border-radius: 4px;" type="submit" class="btn btn-brand">{{ __('messages.register') }}</button>
                        </div>
                    </div>

                </form>
            </div>
            
        </div>
                
    </body>
</html>