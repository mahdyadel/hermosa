@extends('layouts.app')
@section('title', __('messages.edit').' '.__('messages.menu.workingDay') )

@section('content')
<div class="row">

	<div class="col-md-12">
		<!--begin::Portlet-->
        <div class="m-portlet m-portlet--full-height">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('messages.edit').' '.__('messages.menu.workingDay') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                </div>
            </div>

            <div class="m-portlet__body">
                <form action="/salons/{{ request()->route('salon') }}/working-days/{{ request()->route('working_day') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('messages.menu.workingDay') }}</label>
                        <div class="col-9">
                            <select name="working_day_id" class="form-control">
                                <option value="{{ $salonWorkingDay->workingDay->id }}" selected>{{ $salonWorkingDay->workingDay->name }}</option>
                                @foreach($workingDays as $workingDay)
                                <option value="{{ $workingDay->id }}">{{ $workingDay->name }}</option>
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
                            <input class="form-control" name="time_from" value="{{ date('H:i', strtotime($salonWorkingDay->time_from)) }}" placeholder="{{ __('messages.time_from') }}" autocomplete="off" />
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
                            <input class="form-control" name="time_to" value="{{ date('H:i', strtotime($salonWorkingDay->time_to)) }}" placeholder="{{ __('messages.time_to') }}" autocomplete="off" />
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