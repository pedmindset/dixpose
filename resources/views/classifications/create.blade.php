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
                        <div class="form-group {{ $errors->has('classification') ? 'has-error' : ''}}">
                                <label for="classification" class="col-md-4 control-label">Class</label>
                                <div class="col-md-5">
                                    <input class="form-control" name="classification" type="text" id="classification" value="{{ old('classification') }}" placeholder="First Class" required>
                                    {!! $errors->first('classification', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                            <div class="form-group col-md-5">
                                <label for="description">Description</label>
                                
                                <textarea type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="5" placeholder="Description">{{ old('description') }}</textarea>
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