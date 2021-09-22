@extends('layouts.app')
@section('title', __('messages.menu.reservations') )

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show m-alert m-alert--square m-alert--air" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    {{ $message }}			  	
</div>
@endif

<!--begin:: Widgets/Application Sales-->
<div class="m-portlet m-portlet--full-height  m-portlet--unair">
    
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption"  style="width:70%;">                
            <form method="get" action="/salons/{{ request()->route('salon') }}/reservations" style="width:100%;">
                <div class="row">

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="{{ __('messages.search') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-4">
                        <select class="form-control" name="active">
                            <option selected value="">{{  __('messages.status') }}</option>
                            <option {{ isset($_GET['active']) && $_GET['active'] == "true" ? 'selected' : '' }} value="true">{{  __('messages.active') }}</option>
                            <option {{ isset($_GET['active']) && $_GET['active'] == "false" ? 'selected' : '' }} value="false">{{  __('messages.inactive') }}</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-success">{{ __('messages.filter') }}</button>
                    </div>

                </div>
            </form>
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('READ_RESERVATIONS'))
            <a href="/salons/{{ request()->route('salon') }}/reservations/export">
                <button class="btn btn-info">{{ __('messages.export') }}</button>
            </a>

            &nbsp;
            &nbsp;
            <!-- <a href="/salons/{{ request()->route('salon') }}/reservations/create"><button class="btn btn-primry">{{ __('messages.create') }}</button></a> -->
            @endif
        </div>
    </div>

    <div class="m-portlet__body">
        <div class="tab-content">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-striped m-table">
                    <!--begin::Thead-->
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>{{ __('messages.name') }}</td>
                            <td>{{ __('messages.service_type') }}</td>
                            <td>{{ __('messages.payment_type') }}</td>
                            <td>{{ __('messages.fixed_price') }}</td>
                            <td>{{ __('messages.discounted_price') }}</td>
                            <td>{{ __('messages.tax_amount') }}</td>
                            <td>{{ __('messages.home_service_fees') }}</td>
                            <td>{{ __('messages.final_price') }}</td>
                            <td>{{ __('messages.payment_type') }}</td>
                            <td>{{ __('messages.receipt') }}</td>
                            <td>{{ __('messages.status') }}</td>
                            <td>{{ __('messages.show') }}</td>
                            @if(auth()->user()->can('DELETE_RESERVATIONS') && in_array(auth()->user()->type, ['ADMIN']))
                            <td>{{ __('messages.delete') }}</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($reservations) > 0)
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->service_type === 'HOME_SERVICE' ? __('messages.home_service') : __('messages.salon_service') }}</td>
                                <td>{{ $reservation->paymentType->name }}</td>
                                <td>{{ $reservation->fixed_price }}</td>
                                <td>{{ $reservation->discounted_price }}</td>
                                <td>{{ $reservation->tax_amount }}</td>
                                <td>{{ $reservation->home_service_fees }}</td>
                                <td>{{ $reservation->final_price }}</td>
                                <td>{{ $reservation->paymentType->name }}</td>
                                <td>
                                    <a href="/salons/{{ request()->route('salon') }}/reservations/{{ $reservation->id }}/bill">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-interface"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="/salons/{{ request()->route('salon') }}/reservations/{{ $reservation->id }}/status" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @if($reservation->status == "PENDING")  
                                            <button class="btn btn-sm btn-primary">{{ __('messages.active') }}</button>
                                            <input type="hidden" name="status" value="0" />
                                        @else 
                                            <button class="btn btn-sm btn-danger">{{ __('messages.inactive') }}</button> 
                                            <input type="hidden" name="status" value="1" />
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <a href="/salons/{{ request()->route('salon') }}/reservations/{{ $reservation->id }}">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-eye"></i>
                                        </button>
                                    </a>
                                </td>
                                @if(auth()->user()->can('DELETE_RESERVATIONS') && in_array(auth()->user()->type, ['ADMIN']))
                                <td>
                                    <form action="/salons/{{ request()->route('salon')}}/reservations/{{ $reservation->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="flaticon-delete-2"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td>{{ $sum->sum('fixed_price') }}</td>
                            <td>{{ $sum->sum('discounted_price') }}</td>
                            <td>{{ $sum->sum('tax_amount') }}</td>
                            <td>{{ $sum->sum('home_service_fees') }}</td>
                            <td>{{ $sum->sum('final_price') }}</td>
                        </tr>
                    </tfoot>

                </table>
                <!--end::Table-->                        
            </div>

            <div class="m--align-center">
                {{ $reservations->appends($_GET)->links() }}
            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection