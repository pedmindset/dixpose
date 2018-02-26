@extends('layouts.admin')

@section('title', 'Edit Supervisor')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Supervisor</h4>
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
                    <form method="post" action="{{ action('SupervisorController@update', $supervisor->id) }}">
                         @csrf
                         @method('PUT')
                            <!-- Text input-->
                            <div class="form-group {{ $errors->has('drivers') ? ' is-invalid' : '' }}">
                                    <label class="col-md-4 control-label" for="Driver">Driver</label>  
                                    <div class="col-md-4">
                                    <input id="Driver" name="name" type="text" placeholder="Eyram Dixpose" class="form-control input-md" value="{{ $supervisor->name or ''}}" required="">
                                    <span class="help-block">Enter Supervisor's Name</span>  
                                    </div>
                                </div>
                                
                                <!-- Text input-->
                                <div class="form-group {{ $errors->has('phone1') ? ' is-invalid' : '' }}">
                                    <label class="col-md-4 control-label" for="Phone1">Phone 1</label>  
                                    <div class="col-md-4">
                                    <input id="Phone1" name="phone1" type="text" placeholder="2332415827" value="{{ $supervisor->phone1 or ''}}" class="form-control input-md">
                                    <span class="help-block">Enter Supervisor's phone</span>  
                                    </div>
                                </div>

                                 <!-- Text input-->
                                 <div class="form-group {{ $errors->has('phone2') ? ' is-invalid' : '' }}">
                                        <label class="col-md-4 control-label" for="phone2">Phone 2</label>  
                                        <div class="col-md-4">
                                        <input id="phone2" name="phone2" type="text" placeholder="233414563" value="{{ $supervisor->phone2 or ''}}" class="form-control input-md">
                                        <span class="help-block">Enter Supervisor's Phone</span>  
                                        </div>
                                    </div>
                                
                                <!-- Text input-->
                                <div class="form-group {{ $errors->has('address') ? ' is-invalid' : '' }}">
                                    <label class="col-md-4 control-label" for="address">Address</label>  
                                    <div class="col-md-4">
                                    <input id="address" name="address" type="text" placeholder="Osu oxford street Line 5" value="{{ $supervisor->address or ''}}" class="form-control input-md">
                                    <span class="help-block">Enter Supervisor's Address</span>  
                                    </div>
                                </div>
                                
                               
                                
                                <!-- Button (Double) -->
                            
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/pages/mask.js') }}"></script>
<script src="{{ asset('dist/js/pages/validation.js') }}"></script>
<script>
! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery);
</script>

@endsection