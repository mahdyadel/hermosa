@extends('layouts.app')
@section('title', __('messages.menu.users'))

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
            <form method="get" action="/users" style="width:100%;">
                <div class="row">

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="{{ __('messages.search') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" name="is_blocked">
                            <option value="">{{ __('messages.block') }}</option>
                            <option value="true" {{ isset($_GET['is_blocked']) && $_GET['is_blocked'] == "true" ? 'selected' : '' }}>{{ __('messages.yes') }}</option>
                            <option value="false" {{ isset($_GET['is_blocked']) && $_GET['is_blocked'] == "false" ? 'selected' : '' }}>{{ __('messages.no') }}</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success">{{ __('messages.filter') }}</button>
                    </div>

                </div>
            </form>
        </div>
        
		<div class="m-portlet__head-tools">
            @if(auth()->user()->can('CREATE_USERS'))
            <!-- <a href="/users/create"><button class="btn btn-primry">{{ __('messages.create') }}</button></a> -->
            @endif
        </div>
    </div>

    <div class="m-portlet__body">
        <div class="tab-content">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-striped m-table table">
                    <!--begin::Thead-->
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>{{ __('messages.name') }}</td>
                            <td>{{ __('messages.email') }}</td>
                            <td>{{ __('messages.mobile') }}</td>
                            <td>{{ __('messages.menu.city') }}</td>
                            @if(auth()->user()->can('UPDATE_USERS'))
                            <td>{{ __('messages.block') }}</td>
                            <td>{{ __('messages.edit') }}</td>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ @$user->city->name }}</td>
                                @if(auth()->user()->can('UPDATE_USERS'))
                                <td>
                                    <form action="/users/{{ $user->id }}/block" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @if($user->is_blocked == 1)  
                                        <button class="btn btn-sm btn-danger">{{ __('messages.unblock') }}</button>
                                        <input type="hidden" name="status" value="0" />
                                    @else 
                                        <button class="btn btn-sm">{{ __('messages.block') }}</button> 
                                        <input type="hidden" name="status" value="1" />
                                    @endif
                                    </form>
                                </td>
                                <td>
                                    <a href="/users/{{ $user->id }}/edit">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="flaticon-edit-1"></i>
                                        </button>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="text-align:center">{{ __('messages.no_resutls') }}</td>
                            </tr>
                        @endif

                    </tbody>
                    <!--end::Tbody-->  

                </table>
                <!--end::Table-->                        
            </div>

            <div class="m--align-center">
                {{ $users->appends($_GET)->links() }}
            </div>
        </div>
    </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection