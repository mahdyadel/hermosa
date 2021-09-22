@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.admin'))

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.admin') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/admins/{{ request()->route('admin') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.name') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="name" value="{{ $user->name }}" placeholder="{{ __('messages.name') }}" />
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
                            <input class="form-control" name="email" value="{{ $user->email }}" placeholder="{{ __('messages.email') }}" />
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
                            <input class="form-control" name="password" placeholder="{{ __('messages.password') }}" />
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
                            <input class="form-control" name="password_confirmation" placeholder="{{ __('messages.password_confirmation') }}" />
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
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SALONS" {{ in_array('CREATE_SALONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALONS" {{ in_array('READ_SALONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SALONS" {{ in_array('UPDATE_SALONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALONS" {{ in_array('DELETE_SALONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.salonServices') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SALON_SERVICES" {{ in_array('CREATE_SALON_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALON_SERVICES" {{ in_array('READ_SALON_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SALON_SERVICES" {{ in_array('UPDATE_SALON_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALON_SERVICES" {{ in_array('DELETE_SALON_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.salonRates') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_SALON_RATES" {{ in_array('CREATE_SALON_RATES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SALON_RATES" {{ in_array('READ_SALON_RATES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="UPDATE_SALON_RATES" {{ in_array('UPDATE_SALON_RATES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_SALON_RATES" {{ in_array('DELETE_SALON_RATES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.employee') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_EMPLOYEES" {{ in_array('CREATE_EMPLOYEES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_EMPLOYEES" {{ in_array('READ_EMPLOYEES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_EMPLOYEES" {{ in_array('UPDATE_EMPLOYEES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_EMPLOYEES" {{ in_array('DELETE_EMPLOYEES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.employeeRates') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_EMPLOYEE_RATES" {{ in_array('CREATE_EMPLOYEE_RATES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_EMPLOYEE_RATES" {{ in_array('READ_EMPLOYEE_RATES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="UPDATE_EMPLOYEE_RATES" {{ in_array('UPDATE_EMPLOYEE_RATES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_EMPLOYEE_RATES" {{ in_array('DELETE_EMPLOYEE_RATES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.reservations') }}</td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="CREATE_RESERVATIONS" {{ in_array('CREATE_RESERVATIONS', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_RESERVATIONS" {{ in_array('READ_RESERVATIONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_RESERVATIONS" {{ in_array('UPDATE_RESERVATIONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_RESERVATIONS" {{ in_array('DELETE_RESERVATIONS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.promocodes') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_PROMOCODES" {{ in_array('CREATE_PROMOCODES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_PROMOCODES" {{ in_array('READ_PROMOCODES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_PROMOCODES" {{ in_array('UPDATE_PROMOCODES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_PROMOCODES" {{ in_array('DELETE_PROMOCODES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('messages.menu.offers') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_OFFERS" {{ in_array('CREATE_OFFERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_OFFERS" {{ in_array('READ_OFFERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_OFFERS" {{ in_array('UPDATE_OFFERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_OFFERS" {{ in_array('DELETE_OFFERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.admins') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_ADMINS" {{ in_array('CREATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_ADMINS" {{ in_array('READ_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_ADMINS" {{ in_array('UPDATE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="DELETE_ADMINS" {{ in_array('DELETE_ADMINS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                    </tr>

                                    @if(auth()->user()->type == 'ADMIN')
                                    <tr>
                                        <td>{{ __('messages.menu.services') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_SERVICES" {{ in_array('CREATE_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_SERVICES" {{ in_array('READ_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_SERVICES" {{ in_array('UPDATE_SERVICES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_SERVICES" {{ in_array('DELETE_SERVICES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.packages') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_PACKAGES" {{ in_array('CREATE_PACKAGES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_PACKAGES" {{ in_array('READ_PACKAGES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_PACKAGES" {{ in_array('UPDATE_PACKAGES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_PACKAGES" {{ in_array('DELETE_PACKAGES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.countries') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_COUNTRIES" {{ in_array('CREATE_COUNTRIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_COUNTRIES" {{ in_array('READ_COUNTRIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_COUNTRIES" {{ in_array('UPDATE_COUNTRIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_COUNTRIES" {{ in_array('DELETE_COUNTRIES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.cities') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_CITIES" {{ in_array('CREATE_CITIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_CITIES" {{ in_array('READ_CITIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_CITIES" {{ in_array('UPDATE_CITIES', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_CITIES" {{ in_array('DELETE_CITIES', $user->user_permissions) ? 'checked' : '' }} /> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('messages.menu.users') }}</td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="CREATE_USERS" {{ in_array('CREATE_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="READ_USERS" {{ in_array('READ_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="user_permissions[]" value="UPDATE_USERS" {{ in_array('UPDATE_USERS', $user->user_permissions) ? 'checked' : '' }} />
                                        </td>
                                        <td>
                                            <!-- <input type="checkbox" name="user_permissions[]" value="DELETE_USERS" {{ in_array('DELETE_USERS', $user->user_permissions) ? 'checked' : '' }} /> -->
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