@extends('layouts.app')
@section('title', __('messages.create').' '.__('messages.menu.admin'))

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.create').' '.__('messages.menu.admin') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admins" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('messages.name') }}" />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.email') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('messages.email') }}" />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.password') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="password" name="password" placeholder="{{ __('messages.password') }}" />
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.password_confirmation') }}</label>
                        <div class="col-9">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="{{ __('messages.password_confirmation') }}" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.permissions') }}</label>
                        <div class="col-9">
                            <table class="table table-striped m-table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>{{ __('messages.create') }}</td>
                                        <td>{{ __('messages.read') }}</td>
                                        <td>{{ __('messages.edit') }}</td>
                                        <td>{{ __('messages.delete') }}</td>
                                    </tr>
                                </thead>

                                <tbody>
    
                                    <tr>
                                        <td>{{ __('messages.menu.salons') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SALONS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALONS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SALONS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALONS" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.salonServices') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SALON_SERVICES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALON_SERVICES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SALON_SERVICES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALON_SERVICES" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.salonRates') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_SALON_RATES" /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALON_RATES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="UPDATE_SALON_RATES" /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALON_RATES" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.employee') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_EMPLOYEES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_EMPLOYEES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_EMPLOYEES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_EMPLOYEES" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.employeeRates') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_EMPLOYEE_RATES" /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_EMPLOYEE_RATES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="UPDATE_EMPLOYEE_RATES" /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_EMPLOYEE_RATES" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.reservations') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_RESERVATIONS" /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_RESERVATIONS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_RESERVATIONS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_RESERVATIONS" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.promocodes') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_PROMOCODES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_PROMOCODES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_PROMOCODES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_PROMOCODES" />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('messages.menu.offers') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_OFFERS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_OFFERS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_OFFERS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_OFFERS" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.admins') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_ADMINS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_ADMINS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_ADMINS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_ADMINS" />
                                        </td>
                                    </tr>

                                    @if(auth()->user()->type == 'ADMIN')
                                    <tr>
                                        <td>{{ __('messages.menu.services') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SERVICES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SERVICES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SERVICES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_SERVICES" /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.packages') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_PACKAGES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_PACKAGES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_PACKAGES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_PACKAGES" /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.countries') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_COUNTRIES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_COUNTRIES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_COUNTRIES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_COUNTRIES" /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.cities') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_CITIES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_CITIES" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_CITIES" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_CITIES" /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.users') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_USERS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_USERS" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_USERS" />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_USERS" /> -->
                                        </td>
                                    </tr>

                                    @endif
                                </tbody>
                            </table>
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