@extends('layouts.app')
@section('title', __('messages.create').' '.__('messages.menu.weekday') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.create').' '.__('messages.menu.weekday') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/working-days" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.workingDay') }}</label>
                        <div class="col-9">
                            <select name="working_day_id" class="form-control">
                                <option value="">{{ __('messages.menu.workingDay') }}</option>
                                @foreach($workingDays as $workingDay)
                                <option value="{{ $workingDay->id }}" {{ $workingDay->id == old('working_day_id') ? 'selected' : '' }}>{{ $workingDay->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('working_day_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('working_day_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.time_from') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="time_from" value="{{ old('time_from') }}" placeholder="{{ __('messages.time_from') }}" autocomplete="off" />
                            @if ($errors->has('time_from'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('time_from') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.time_to') }}</label>
                        <div class="col-9">
                            <input class="form-control" name="time_to" value="{{ old('time_to') }}" placeholder="{{ __('messages.time_to') }}" autocomplete="off" />
                            @if ($errors->has('time_to'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('time_to') }}</strong>
                                </span>
                            @endif
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