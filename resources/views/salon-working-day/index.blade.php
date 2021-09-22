@extends('layouts.app')
@section('title', __('messages.menu.workingDays') )

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
        {{ __('messages.menu.workingDays') }}
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_ADMINS'))
            <a href="/salons/{{ request()->route('salon') }}/working-days/create">
                <button class="btn btn-primry">{{ __('messages.create') }}</button>
            </a>
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
                            <td>{{ __('messages.time_from') }}</td>
                            <td>{{ __('messages.time_to') }}</td>
                            @if(auth()->user()->can('UPDATE_ADMINS'))
                            <td>{{ __('messages.edit') }}</td>
                            @endif
                            @if(auth()->user()->can('DELETE_ADMINS'))
                            <td>{{ __('messages.delete') }}</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($salonWorkingDays) > 0)
                            @foreach($salonWorkingDays as $salonWorkingDay)
                            <tr>
                                <td>{{ $salonWorkingDay->id }}</td>
                                <td>{{ $salonWorkingDay->workingDay->name }}</td>
                                <td>{{ date('H:i', strtotime($salonWorkingDay->time_from)) }}</td>
                                <td>{{ date('H:i', strtotime($salonWorkingDay->time_to)) }}</td>
                                @if(auth()->user()->can('UPDATE_ADMINS'))
                                <td>
                                    <a href="/salons/{{ request()->route('salon') }}/working-days/{{ $salonWorkingDay->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit-1"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                                @if(auth()->user()->can('DELETE_ADMINS'))
                                <td>
                                    <form action="/salons/{{ request()->route('salon')}}/working-days/{{ $salonWorkingDay->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="6" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>

            <div class="m--align-center">
                {{ $salonWorkingDays->appends($_GET)->links() }}
            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection