@extends('layouts.admin')

@section('title', 'Add Customer')

@section('styles')
<link href="{{ asset('node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<!-- start of customer form -->
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-b-0 text-black">Add Customer</h4>
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
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('customers') }}">
                            @csrf
                        <div class="form-body">
                            <h3 class="card-title">Customer Info</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Enter name" required>
                                        <small class="form-control-feedback">Name</small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="abc@email.com">
                                        <small class="form-control-feedback">Email</small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone 1</label>
                                            <input type="tel" id="phone1" name="phone1" class="form-control {{ $errors->has('phone1') ? ' is-invalid' : '' }}" value="{{ old('phone1') }}" placeholder="+233 2415783">
                                            <small class="form-control-feedback">Phone 1</small> </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone 2</label>
                                                <input type="tel" id="phone2" name="phone2" class="form-control {{ $errors->has('phone2') ? ' is-invalid' : '' }}" value="{{ old('phone2') }}" placeholder="+233 2415783">
                                                <small class="form-control-feedback">Phone 2</small> </div>
                                        </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"><Address></Address></label>
                                                <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" placeholder="street Address">
                                                <small class="form-control-feedback">Street Address</small> </div>
                                        </div>
                            </div>
                            <!--/row-->
                            <h3 class="box-title m-t-40">Customer Service Location</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Zone<span class="text-danger">*</span></label>
                                        <select name="zone" class="form-control custom-select {{ $errors->has('zone') ? ' is-invalid' : '' }}" required>
                                            @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback"> Select Zone </small> </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Service Zone<span class="text-danger">*</span></label>
                                            <select name="service_zone" class="form-control custom-select {{ $errors->has('service_zone') ? ' is-invalid' : '' }}" required>
                                                    @foreach($service_zones as $service_zone)
                                                    <option value="{{ $service_zone->id }}">{{ $service_zone->name }}</option>
                                                    @endforeach
                                            </select>
                                            <small class="form-control-feedback"> Select Zone </small> </div>
                                    </div>
                                <!--/span-->
                                
    
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                               
    
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Ghana Post GPS-Address</label>
                                        <input name="ghana_gps" type="text" id="ghana_gps" class="form-control {{ $errors->has('ghana_gps') ? ' is-invalid' : '' }}" value="{{ old('ghana_gps') }}" placeholder="Ghana Post Address">
                                        <small class="form-control-feedback"> GPS Address. </small> </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                        <div class="form-group">
                                           <h4 class="control-label"> Select Bins</h4>
                                             <select name="bins[]" class="select2 select2-multiple js-states js-example-events"  style="width: 100%" multiple="multiple" data-placeholder="Choose bin type">
                                                 @foreach($bins as $bin)
                                                <option value="{{ $bin->id or '' }}">{{ $bin->type or '' }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-control-feedback text-danger"> If customer has three 240 ltr bins select 240 three times</small>
                                        </div>
                                </div>
                            </div>
                            <!--/row-->
    
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h3 class="box-title m-t-40">Service Terms</h3>
                            <hr>
                            <!--/row-->
                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('classification') ? ' is-invalid' : '' }}">
                                            <label class="control-label">Service Classification<span class="text-danger">*</span></label>
                                                <select name="classification" class="form-control custom-select" data-placeholder="Choose a classification" tabindex="1" required>
                                                        @foreach($classifications as $classification)
                                                        <option  value="{{$classification->id or ''}}">{{$classification->class or ''}}</option>
                                                        @endforeach
                                                   
                                             </select>
                                            <small class="form-control-feedback"> Service Classification </small> </div>
                                    </div>
                                    
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Frequency of collection<span class="text-danger">*</span></label>
                                            <select name="frequency" class="form-control custom-select" data-placeholder="Frequency of collection" style="width: 100%" tabindex="1" required>
                                               <option value="1">Once per week</option>
                                               <option value="2">Twice per week</option>
                                               <option value="3">thrice per week</option>
                                               <option value="4">Four times per week</option>
                                               <option value="5">Five times per week</option>
                                               <option value="6">Six Times per week</option>
                                               <option value="7">Seven Times per week</option>
                                         </select>
                                        <small class="form-control-feedback"> Collection Frequency </small> </div>
                                </div>
                                <!--/span-->
                                 
                                <!--/span-->
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add Customer</button>
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of customer form -->

@endsection


@section('scripts')
<script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"  type="text/javascript"> </script>
<script src="{{ asset('dist/js/pages/validation.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2().val();
            var $eventLog = $(".js-event-log");
            var $eventSelect = $(".js-example-events");

            $.fn.select2.defaults.set("width", "100%");

            $eventSelect.on("select2:open", function (e) { log("select2:open", e); });
            $eventSelect.on("select2:close", function (e) { log("select2:close", e); });
            $eventSelect.on("change", function (e) { log("change"); });

            $eventSelect.on("select2:select", function (e) { 
                log("select2:select", e);
            $eventSelect.append('<option value="'+e.params.data.id+'">' +e.params.data.text + '</option>');
            });
            $eventSelect.on("select2:unselect", function (e) { 
                log("select2:unselect", e); 
                e.params.data.element.remove();
            });

            function log (name, evt) {
            if (!evt) {
                var args = "{}";
            } else {
                var args = JSON.stringify(evt.params, function (key, value) {
                if (value && value.nodeName) return "[DOM node]";
                if (value instanceof $.Event) return "[$.Event]";
                return value;
                });
            }
            var $e = $("<li>" + name + " -> " + args + "</li>");
            $eventLog.append($e);
            $e.animate({ opacity: 1 }, 50000, 'linear', function () {
                $e.animate({ opacity: 0 }, 2000, 'linear', function () {
                $e.remove();
                });
            });
            }

            function formatResultData (data) {
            if (!data.id) return data.text;
            if (data.element.selected) return
            return data.text;
            };

            $eventSelect.select2({
            templateResult: formatResultData,
            tags: true}
            );
       
 });

        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
        </script>

@endsection