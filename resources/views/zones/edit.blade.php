@extends('layouts.admin')

@section('title', 'Edit Zones')

@section('styles')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Zones</h4>
                <h6 class="card-subtitle"></a></h6>
                        @if (session('status'))
                        <div class="alert alert-success">
                            
                            {{ session('status') }}
                            </div>
                         @endif     
                    <form method="post" action="{{action('ZoneController@update', $zone->id)}}">
                        @method('PATCH')
                         @csrf
                            <div class="form-group">
                                <label for="name">Zone Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ $zone->name }}" placeholder="Enter Zone Name" required data-validation-required-message ="Please Enter the Zone Name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                
                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="4" placeholder="description" >{{ $zone->desc }}</textarea>
                            </div>
                        
                            @if ($errors->any())
                             <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('dist/js/pages/validation.js') }}"></script>
<script>
! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery);
</script>

@endsection