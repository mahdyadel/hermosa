@extends('layouts.app')
@section('title', __('messages.menu.salonServices') )

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
            <form method="get" action="/salons/{{ request()->route('salon') }}/services" style="width:100%;">
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
            @if(auth()->user()->can('CREATE_SALON_SERVICES'))
            <a href="/salons/{{ request()->route('salon') }}/services/create"><button class="btn btn-primry">{{ __('messages.create') }}</button></a>
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
                            <td>{{ __('messages.menu.service') }}</td>
                            <td>{{ __('messages.name') }}</td>
                            <td>{{ __('messages.price') }}</td>
                            <td>{{ __('messages.minutes') }}</td>
                            <td>{{ __('messages.status') }}</td>
                            @if(auth()->user()->can('UPDATE_SALON_SERVICES'))
                            <td>{{ __('messages.edit') }}</td>
                            @endif
                            @if(auth()->user()->can('DELETE_SALON_SERVICES') && in_array(auth()->user()->type, ['ADMIN']))
                            <td>{{ __('messages.delete') }}</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($services) > 0)
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->service->name }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->minutes }}</td>
                                <td>
                                    <form action="/salons/{{ request()->route('salon') }}/services/{{ $service->id }}/status" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @if($service->is_active == 1)  
                                            <button class="btn btn-sm btn-primary">{{ __('messages.active') }}</button>
                                            <input type="hidden" name="status" value="0" />
                                        @else 
                                            <button class="btn btn-sm btn-danger">{{ __('messages.inactive') }}</button> 
                                            <input type="hidden" name="status" value="1" />
                                        @endif
                                    </form>
                                </td>
                                @if(auth()->user()->can('UPDATE_SALON_SERVICES'))
                                <td>
                                    <a href="/salons/{{ request()->route('salon') }}/services/{{ $service->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit-1"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                                @if(auth()->user()->can('DELETE_SALON_SERVICES') && in_array(auth()->user()->type, ['ADMIN']))
                                <td>
                                    <form action="/salons/{{ request()->route('salon') }}/services/{{ $service->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                                <td colspan="8" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>

            <div class="m--align-center">
                {{ $services->appends($_GET)->links() }}
            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection