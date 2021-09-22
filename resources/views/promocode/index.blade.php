@extends('layouts.app')
@section('title', __('messages.menu.promocodes'))

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  {{ $message }}
</div>
@endif

<!--begin:: Widgets/Application Sales-->
<div class="m-portlet m-portlet--full-height  m-portlet--unair">
    
  <div class="m-portlet__head">
    <div class="m-portlet__head-caption"  style="width:90%;">                
      <form method="get" action="/promocodes" style="width:100%;">
          <div class="row">

            <div class="col-md-4">
              <input type="text" class="form-control" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" placeholder="{{  __('messages.search') }}" />
            </div>

            <div class="col-md-3">
              <select class="form-control" name="active">
                <option disabled selected value="">{{  __('messages.status') }}</option>
                <option {{ isset($_GET['active']) && $_GET['active'] == "true" ? 'selected' : '' }} value="true">{{  __('messages.active') }}</option>
                <option {{ isset($_GET['active']) && $_GET['active'] == "false" ? 'selected' : '' }} value="false">{{  __('messages.inactive') }}</option>
              </select>
            </div>

            <div class="col-md-2">
              <button class="btn btn-success">{{  __('messages.filter') }}</button>
            </div>

          </div>
      </form>
    </div>
      
    <div class="m-portlet__head-tools">
      @if(auth()->user()->can('CREATE_PROMOCODES'))                                
        <a href="/promocodes/create">
          <button class="btn btn-primry">
            {{ __('messages.create') }}
          </button>
        </a>
      @endif
    </div>
  </div>

  <div class="m-portlet__body">
    <div class="tab-content">
      <!--begin::Widget 11--> 
      <div class="table-responsive">
        <!--begin::Table-->
        <table class="table table-striped m-table">
          <!--begin::Thead-->
          <thead>
            <tr>
              <td>#</td>
              <td>{{ __('messages.code') }}</td>
              <td>{{ __('messages.percentage') }}</td>
              <td>{{ __('messages.discount_owner') }}</td>
              <td>{{ __('messages.max_amount') }}</td>
              <td>{{ __('messages.max_use') }}</td>
              <td>{{ __('messages.expired_at') }}</td>
              <td>{{ __('messages.menu.salon') }}</td>
              <td>{{ __('messages.status') }}</td>
              @if(auth()->user()->can('UPDATE_PROMOCODES'))
              <td>{{ __('messages.edit') }}</td>
              @endif
              @if(auth()->user()->can('DELETE_PROMOCODES') && in_array(auth()->user()->type, ['ADMIN']))
              <td>{{ __('messages.delete') }}</td>
              @endif
            </tr>
          </thead>
          <!--end::Thead-->
          <!--begin::Tbody-->
          <tbody>
            @if(count($promocodes) > 0)
              @foreach($promocodes as $promocode)
                <tr>
                  <td>{{ $promocode->id }}</td>
                  <td>{{ $promocode->code }}</td>
                  <td>{{ $promocode->percentage }}</td>
                  <td>{{ $promocode->owner_type }}</td>
                  <td>{{ $promocode->max_amount }}</td>
                  <td>{{ $promocode->max_use }}</td>
                  <td>{{ $promocode->expired_at }}</td>
                  <td>{{ @$promocode->salon->name }}</td>
                  <td>
                    <form action="/promocodes/{{ $promocode->id }}/status" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure?')) { return true } else {return false };">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      @if($promocode->is_active == 1)  
                          <button class="btn btn-sm">{{ __('messages.active') }}</button>
                          <input type="hidden" name="status" value="0" />
                      @else 
                          <button class="btn btn-sm btn-danger">{{ __('messages.inactive') }}</button> 
                          <input type="hidden" name="status" value="1" />
                      @endif
                    </form>
                  </td>
                  @if(auth()->user()->can('UPDATE_PROMOCODES'))
                  <td>
                    <a href="/promocodes/{{ $promocode->id }}/edit">
                      <button type="submit" class="btn btn-sm btn-info">
                        <i class="flaticon-edit"></i>
                      </button>
                    </a>
                  </td>
                  @endif
                  @if(auth()->user()->can('DELETE_PROMOCODES') && in_array(auth()->user()->type, ['ADMIN']))
                  <td>
                      <form action="/promocodes/{{ $promocode->id }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
                <td colspan="10" style="text-align:center">{{ __('messages.no_resutls') }}</td>
              </tr>
            @endif
          </tbody>
          <!--end::Tbody-->  
        </table>
        <!--end::Table-->                        
      </div>
      <div class="m-widget11__action m--align-right">
      {{ $promocodes->appends($_GET)->links() }}
      </div>
      <!--end::Widget 11-->
    </div>
  </div>

</div>
<!--end:: Widgets/Application Sales-->  
@endsection