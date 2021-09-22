@extends('layouts.app')
@section('title', __('messages.menu.salonRates') )

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
            <form method="get" action="/salons/{{ request()->route('salon') }}/employees/{{ request()->route('employee') }}/rates" style="width:100%;">
                <div class="row">

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="{{ __('messages.search') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success">{{ __('messages.filter') }}</button>
                    </div>

                </div>
            </form>
        </div>
        
		<div class="m-portlet__head-tools">
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
                            <td>{{ __('messages.rate') }}</td>
                            <td>{{ __('messages.comment') }}</td>
                            @if(auth()->user()->can('DELETE_SALON_RATES') && in_array(auth()->user()->type, ['ADMIN']))
                            <td>{{ __('messages.delete') }}</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($salonRates) > 0)
                            @foreach($salonRates as $salonRate)
                            <tr>
                                <td>{{ $salonRate->id }}</td>
                                <td>{{ $salonRate->user->name }}</td>
                                <td>{{ $salonRate->rate }}</td>
                                <td>{{ $salonRate->comment }}</td>
                                @if(auth()->user()->can('DELETE_SALON_RATES') && in_array(auth()->user()->type, ['ADMIN']))
                                <td>
                                    <form action="/salons/{{ request()->route('salon')}}/rates/{{ $salonRate->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="5" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>

            <div class="m--align-center">
                {{ $salonRates->appends($_GET)->links() }}
            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection