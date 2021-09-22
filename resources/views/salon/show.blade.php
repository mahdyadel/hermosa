@extends('layouts.app')
@section('title', __('messages.show').' '.__('messages.menu.salon').' '. $salon->name)

@section('content')
<div class="row">
	<div class="col-md-12">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show m-alert m-alert--square m-alert--air" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
      {{ $message }}			  	
    </div>
    @endif

    <!--begin::Portlet-->
    <div class="m-portlet m-portlet--full-height">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ __('messages.show').' '.__('messages.menu.salon').' '. $salon->name }}
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
          @if(auth()->user()->can('UPDATE_ADMINS'))
            <a href="/salons/{{ $salon->id }}/edit">
                <button class="btn btn-primry">{{ __('messages.edit') }}</button>
            </a>
            @endif
        </div>
      </div>

      <div class="m-portlet__body row">

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.name_ar') }} *</label>
            <div class="col-7">
              <span>{{ $salon->name_ar }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.name_en') }} *</label>
            <div class="col-7">
              <span>{{ $salon->name_en }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.phone') }} *</label>
            <div class="col-7">
              <span>{{ $salon->phone }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.phone_2') }} *</label>
            <div class="col-7">
              <span>{{ $salon->phone_2 }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_name') }} *</label>
            <div class="col-7">
              <span>{{ $salon->bank_name }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_account_number') }} *</label>
            <div class="col-7">
              <span>{{ $salon->bank_account_number }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_name_2') }} *</label>
            <div class="col-7">
              <span>{{ $salon->bank_name_2 }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_account_number_2') }} *</label>
            <div class="col-7">
              <span>{{ $salon->bank_account_number_2 }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_account_number') }}</label>
            <div class="col-7">
              <a target="_blank" href="{{ asset('storage/salons/'.$salon->bank_account_number_pdf) }}">{{ __('messages.bank_account_number') }} PDF</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.bank_account_number_2') }}</label>
            <div class="col-7">
              <a target="_blank" href="{{ asset('storage/salons/'.$salon->bank_account_number_2_pdf) }}">{{ __('messages.bank_account_number_2') }} PDF</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.tax_number') }}</label>
            <div class="col-7">
              <span>{{ $salon->tax_number }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.tax_number') }}</label>
            <div class="col-7">
              <a target="_blank" href="{{ asset('storage/salons/'.$salon->tax_number_pdf) }}">{{ __('messages.tax_number') }} PDF</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.commercial_register') }}</label>
            <div class="col-7">
              <span>{{ $salon->commercial_register }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.commercial_register') }}</label>
            <div class="col-7">
              <a target="_blank" href="{{ asset('storage/salons/'.$salon->commercial_register_pdf) }}">{{ __('messages.commercial_register') }} PDF</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.photo') }}</label>
            <div class="col-7">
              <img src="{{ $salon->main_photo ? asset('storage/salons/'.$salon->main_photo) : '/images/logo.png' }}" width="50px" height="50px" style="border-radius: 50%" />
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.logo') }}</label>
            <div class="col-7">
              <img src="{{ $salon->logo ? asset('storage/salons/'.$salon->logo) : '/images/logo.png' }}" width="50px" height="50px" style="border-radius: 50%" />
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.percentage') }}</label>
            <div class="col-7">
              <span>{{ $salon->percentage }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.deposit_percentage') }}</label>
            <div class="col-7">
              <span>{{ $salon->deposit_percentage }}</span>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.services') }}</label>
            <div class="col-7">
              <a href="/salons/{{ $salon->id }}/services">{{ $salon->services_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.employees') }}</label>
            <div class="col-7">
              <a href="/salons/{{ $salon->id }}/employees">{{ $salon->employees_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.reservations') }}</label>
            <div class="col-7">
              <a href="/salons/{{ $salon->id }}/reservations">{{ $salon->reservations_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.menu.salonRates') }}</label>
            <div class="col-7">
              <a href="/salons/{{ $salon->id }}/rates">{{ $salon->rates_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.menu.offers') }}</label>
            <div class="col-7">
              <a href="/salons/{{ $salon->id }}/offers">{{ $salon->offers_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.menu.promocodes') }}</label>
            <div class="col-7">
              <a href="/promocodes?salonId={{ $salon->id }}">{{ $salon->promocodes_count }}</a>
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.menu.country') }}</label>
            <div class="col-7">
              {{ $salon->country->name }}
            </div>
          </div>
        </div>

        <div class="col-6">   
          <div class="form-group row">
            <label class="col-5 col-form-label">{{ __('messages.menu.city') }}</label>
            <div class="col-7">
              {{ $salon->city->name }}
            </div>
          </div>
        </div>
              
      </div> 
    </div>
    <!--end::Portlet-->
 
  </div>
</div>
@endsection