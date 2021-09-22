@extends('layouts.app')
@section('title', __('messages.show').' '.__('messages.menu.reservation').' '. $reservation->id)

@section('content')
<div class="row">
	<div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                    {{ __('messages.show').' '.__('messages.menu.reservation').' '. $reservation->id }}
                    </h3>
                </div>
                </div>
                <div class="m-portlet__head-tools">
                    @if(auth()->user()->can('UPDATE_RESERVATIONS'))
                    <!-- <a href="/salons/{{ request()->route('salon') }}/reservations/{{ $reservation->id }}/edit">
                        <button class="btn btn-primry">{{ __('messages.edit') }}</button>
                    </a> -->
                    @endif
                </div>
            </div>

            <div class="m-portlet__body row">

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.name') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->user->name }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.payment_type') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->paymentType->name }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.fixed_price') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->fixed_price }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.discount_amount') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->discount_amount }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.discounted_price') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->discounted_price }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.tax_amount') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->tax_amount }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.final_price') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->final_price }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.status') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->status }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.payment_status') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->payment_status }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.discount_owner') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->discount_owner ? $reservation->discount_owner : '-' }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.home_service_fees') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->home_service_fees }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.promocode') }}</label>
                    <div class="col-7">
                        <span>{{ $reservation->promocode ? $reservation->promocode->code : '-' }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.salon_profit_amount') }}</label>
                    <div class="col-7">
                        <span>{{ @$reservation->salon_profit_amount }}</span>
                    </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                    <label class="col-5 col-form-label">{{ __('messages.hermosa_profit_amount') }}</label>
                    <div class="col-7">
                        <span>{{ @$reservation->hermosa_profit_amount }}</span>
                    </div>
                    </div>
                </div>

                @if(auth()->user()->type == 'ADMIN')

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.hermosa_tax_amount') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->hermosa_tax_amount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.hermosa_profit_amount_after_tax') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->hermosa_profit_amount_after_tax }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.charity_amount') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->charity_amount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.zakat_amount') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->zakat_amount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.hermosa_final_profit_amount') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->hermosa_final_profit_amount }}</span>
                        </div>
                    </div>
                </div>

                @endif

                <div class="col-6">   
                    <div class="form-group row">
                        <label class="col-5 col-form-label">{{ __('messages.created_at') }}</label>
                        <div class="col-7">
                            <span>{{ @$reservation->created_at }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Portlet-->
	</div>
</div>

<div class="row">
	<div class="col-md-12">
        <div class="m-portlet m-portlet--full-height">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                    {{ __('messages.show').' '.__('messages.menu.services').' '. $reservation->id }}
                    </h3>
                </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body row">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-striped m-table">
                        <!--begin::Thead-->
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>{{ __('messages.menu.salonService') }}</td>
                                <td>{{ __('messages.menu.employee') }}</td>
                                <td>{{ __('messages.date') }}</td>
                                <td>{{ __('messages.time') }}</td>
                                <td>{{ __('messages.menu.promocode') }}</td>
                                <td>{{ __('messages.fixed_price') }}</td>
                                <td>{{ __('messages.discount_amount') }}</td>
                                <td>{{ __('messages.discounted_price') }}</td>
                                <td>{{ __('messages.home_service_fees') }}</td>
                                <td>{{ __('messages.tax_amount') }}</td>
                                <td>{{ __('messages.final_price') }}</td>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody>
                            @if(count($reservation->reservationServices) > 0)
                                @foreach($reservation->reservationServices as $reservationService)
                                <tr>
                                    <td>{{ $reservationService->id }}</td>
                                    <td>{{ $reservationService->salonService->name }}</td>
                                    <td>{{ $reservationService->employee->name }}</td>
                                    <td>{{ $reservationService->date }}</td>
                                    <td>{{ $reservationService->time }}</td>
                                    <td>{{ @$reservationService->promocode->code }}</td>
                                    <td>{{ $reservationService->fixed_price }}</td>
                                    <td>{{ $reservationService->discount_amount }}</td>
                                    <td>{{ $reservationService->discounted_price }}</td>
                                    <td>{{ $reservationService->home_service_fees }}</td>
                                    <td>{{ $reservationService->tax_amount }}</td>
                                    <td>{{ $reservationService->final_price }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                                </tr>
                            @endif

                        </tbody>
                        <!--end::Tbody-->  
                    </table>
                    <!--end::Table-->                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection