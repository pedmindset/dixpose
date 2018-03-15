@extends('layouts.admin')

@section('title', 'Edit Truck')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Truck</h4>
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
                    <form method="post" action="{{ action('TruckController@update', $truck->id) }}">
                         @csrf
                         @method('PUT')
                            <!-- Text input-->
                                <div class="form-group {{ $errors->has('number') ? ' is-invalid' : '' }}">
                                    <label class="col-md-4 control-label" for="Phone1">Number</label>  
                                    <div class="col-md-4">
                                    <input id="number" name="number" type="text" placeholder="GT876GR" value="{{ $truck->truck_number or ''  }}" class="form-control input-md">
                                    <span class="help-block">Enter Truck's number</span>  
                                    </div>
                                </div>

                                 <!-- Text input-->
                                 <div class="form-group {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                        <label class="col-md-4 control-label" for="phone2">Type</label>  
                                        <div class="col-md-4">
                                        <input id="type" name="type" type="text" placeholder="Roll-off" value="{{ $truck->type or ''  }}" class="form-control input-md">
                                        <span class="help-block">Enter Truck type</span>  
                                        </div>
                                    </div>
                                
                                <!-- Text input-->
                                <div class="form-group {{ $errors->has('remarks') ? ' is-invalid' : '' }}">
                                    <label class="col-md-4 control-label" for="address">Remarks</label>  
                                    <div class="col-md-4">
                                    <input id="address" name="address" type="text" placeholder="In Good state" value="{{ $truck->remarks or ''  }}" class="form-control input-md">
                                    <span class="help-block">Enter Truck's remarks</span>  
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







