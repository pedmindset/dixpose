@extends('layouts.admin')

@section('title', 'Add Classification')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Classification</h4>
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
                     <form method="post" action="{{ url('classifications') }}">
                            @csrf
                        <div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
                                <label for="class" class="col-md-4 control-label">{{ 'Class' }}</label>
                                <div class="col-md-5">
                                    <input class="form-control" name="class" type="text" id="class" value="{{ old('class') }}" required>
                                    {!! $errors->first('class', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
                                <div class="col-md-5 input-group mb-3">
                                  <div class="input-group-prepend">
                                    <input class="form-control input-group-prepend" name="price" type="number" id="price" value="{{ old('price') }}" required  aria-describedby="price" ">
                                    <span class="input-group-text" id="price">GHS</span>
                             </div>
                                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div><div class="form-group {{ $errors->has('bin_id') ? 'has-error' : ''}}">
                                <label for="bin_id" class="col-md-4 control-label">{{ 'Bin Type' }}</label>
                                <div class="col-md-5">
                                    <select name="bin" class="form-control custom-select {{ $errors->has('bin') ? ' is-invalid' : '' }}" required data-validation-required-message ="Please select the Bin Type">
                                            @foreach($bins as $bin)
                                            <option value="{{$bin->id or ''}}">{{$bin->type or ''}}</option>
                                            @endforeach
                                        </select>
                                    <small class="form-control-feedback text-danger"> Select Bin Type </small> 
                                    {!! $errors->first('bin_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                   
                           <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                           <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                       </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of customer form -->
        
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