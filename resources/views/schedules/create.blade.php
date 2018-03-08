@extends('layouts.admin')

@section('title', 'Add Schedule')

@section('styles')
<link href="{{ asset('node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Schedules</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Admin</li>
            </ol>
            <a href="/schedules"><button type="button" class="btn btn-info d-none d-lg-block m-l-15"> View schedules</button></>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Schedule</h4>
                <h6 class="card-subtitle"></a></h6>
                     @if (session('status'))
                            <div class="alert alert-success">
                                
                                {{ session('status') }}
                           </div>
                     @endif
                     @if ($errors->any())
                     <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ url('schedules') }}">
                         @csrf
                            <!-- Text input-->
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label" for="Supervisor">Supervisor</label>  
                                        
                                        <select name="supervisor" class="form-control  {{ $errors->has('supervisor') ? ' is-invalid' : '' }}" required>
                                                @foreach($supervisors as $supervisor)
                                                <option name="supervisor" value="{{ $supervisor->id or ''}}">{{ $supervisor->name or ''}}</option>
                                                @endforeach
                                        </select>
                                        <span class="help-block">Select Supervisor's Name</span>  
                                    </div>
                                </div>
                            
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label" for="Driver">Driver</label>  
                                    
                                            <select name="driver" class="form-control  {{ $errors->has('driver') ? ' is-invalid' : '' }}" required>
                                                @foreach($drivers as $driver)
                                                  <option name="driver" value="{{ $driver->id or ''}}">{{ $driver->name or ''}}</option>
                                                @endforeach
                                             </select>                                    
                                        <span class="help-block">Select Driver's Name</span>  
                                     </div>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-5">
                                    <div class="form-group">
                                            <label class="col-md-5 control-label" for="Truck">Truck</label>  
                                            
                                             <select name="truck" class="form-control  {{ $errors->has('truck') ? ' is-invalid' : '' }}" required>
                                                @foreach($trucks as $truck)
                                                   <option name="truck" value="{{ $truck->id or ''}}">{{ $truck->truck_number or ''}}</option>
                                                @endforeach
                                              </select>
                                            <span class="help-block">Select Truck</span>  
                                        </div>
                                    </div>
                             
                                <div class="col-md-5">
                                     <div class="form-group">
                                        <div class="form-group {{ $errors->has('sector') ? ' is-invalid' : '' }}">
                                            <label class="col-md-5 control-label" for="sector">Sector</label>  
                                            
                                                <select name="sector" class="form-control custom-select {{ $errors->has('sector') ? ' is-invalid' : '' }}" required>
                                                        @foreach($service_zones as $service_zone)
                                                          <option name="sector" value="{{ $service_zone->id or ''}}">{{ $service_zone->name or ''}}</option>
                                                        @endforeach
                                                </select>
                                            <span class="help-block">Select Sector's Name</span>   
                                    </div>
                                </div>
                            </div>
                                 <!-- Text input-->
                        </div>
                            <div class="row">   
                                 <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-md-5">Pick up date</label>
                                            <input  type="text" id="date-format" name="pick_up_date" class="form-control  {{ $errors->has('pick_up_date') ? ' is-invalid' : '' }}" value="{{ old('pick_up_date') }}" placeholder="Saturday 24 June 2017 - 21:44">
                                             <span class="help-block">Select Pick up date</span>  
                                        </div>
                                </div>
                            <div class="col-md-5">
                                    <div class="form-group ">
                                                <label class="col-md-5 control-label" for="status">Status</label>  
                                                 <select id="status" name="status" class="form-control  {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                       <option value="Created">Created</option>
                                                       <option value="Started">Started</option>
                                                       <option value="Completed">Completed</option>
                                                  </select>
                                                <span class="help-block">Set Schedule Status</span>  
                                        </div>
                                   </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-5">
                                            <div class="form-group ">
                                                <label for="desc">Remarks</label>
                                                    <textarea type="text" class="form-control {{ $errors->has('remarks') ? ' is-invalid' : '' }}" id="remarks" name="remarks" rows="3" placeholder="Remarks">{{ old('remarks') }}</textarea>
                                                </div>
                                        </div>   
                              </div>
                               <!-- Button (Double) -->
                               <div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <button type="submit" class="btn btn-inverse waves-effect waves-light btn btn-danger">Cancel</button>
                                </div>
                         </div>    
                        
                         
                               
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/pages/mask.js') }}"></script>
<script src="{{ asset('dist/js/pages/validation.js') }}"></script>
<script src="{{ asset('node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script>
! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery);

// MAterial Date picker    
$('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
$('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
$('#date-format').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:MM:SS' });

$('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
// Clock pickers
$('#single-input').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});

</script>


@endsection







