@extends('layouts.app')
@section('title', __('messages.show').' '.__('messages.menu.employee').' '. $employee->name)

@section('content')
<div class="row">
	<div class="col-md-12">
		<!--begin::Portlet-->
    <div class="m-portlet m-portlet--full-height">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ __('messages.show').' '.__('messages.menu.employee').' '. $employee->name }}
            </h3>
          </div>
        </div>
        <div class="m-portlet__head-tools">
            @if(auth()->user()->can('UPDATE_ADMINS'))
            <a href="/salons/{{ request()->route('salon') }}/employees/{{ $employee->id }}/edit">
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
            <span>{{ $employee->name_ar }}</span>
          </div>
        </div>
      </div>

      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.name_en') }} *</label>
          <div class="col-7">
            <span>{{ $employee->name_en }}</span>
          </div>
        </div>
      </div>

      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.salary') }}</label>
          <div class="col-7">
            <span>{{ $employee->salary }}</span>
          </div>
        </div>
      </div>

      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.insurance') }}</label>
          <div class="col-7">
            <span>{{ $employee->insurance }}</span>
          </div>
        </div>
      </div>

      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.gender') }}</label>
          <div class="col-7">
            <span>{{ $employee->gender == "M" ? "Male" : "Female" }}</span>
          </div>
        </div>
      </div>


      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.photo') }}</label>
          <div class="col-7">
            <img src="{{ $employee->photo ? asset('storage/employees/'.$employee->photo) : '/images/logo.png' }}" width="50px" height="50px" style="border-radius: 50%" />
          </div>
        </div>
      </div>

      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.services') }}</label>
          <div class="col-7">
            @foreach($employee->employeeSalonServices as $employeeSalonService)
            {{ $employeeSalonService->salonService->name }},
            @endforeach
          </div>
        </div>
      </div>


      <div class="col-6">   
        <div class="form-group row">
          <label class="col-5 col-form-label">{{ __('messages.menu.employeeRates') }}</label>
          <div class="col-7">
          <a href="/salons/{{ $employee->salon_id }}/employees/{{ $employee->id }}/rates">{{ $employee->rates_count }}</a>
          </div>
        </div>
      </div>

            
      </div>
    </div>
    <!--end::Portlet-->
	</div>
</div>
@endsection