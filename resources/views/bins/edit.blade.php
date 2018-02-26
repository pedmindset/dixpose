@extends('layouts.admin')

@section('title', 'Edit Bin')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Bin</h4>
                <h6 class="card-subtitle"></a></h6>
                     @if (session('status'))
                            <div class="alert alert-success">
                                
                                {{ session('status') }}
                           </div>
                     @endif
                    <form method="post" action="{{ action('BinController@update', $bin->id) }}">
                         @csrf
                         @method('PUT')
                            <div class="form-group">
                                <label for="type">Bin type<span class="text-danger">*</span></label>
                                <input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" value="{{ $bin->type }}" placeholder="240 litre" required data-validation-required-message ="Please Enter the Zone Name">
                            </div>
                            <div class="form-group">
                                <label for="description">Price per pick-up</label>
                                
                                <input type="text"  class=" orm-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" id="desc" value="{{ $bin->desc }}" name="desc" placeholder="Description">
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
<script src="dist/js/pages/mask.js"></script>
<script src="{{ asset('dist/js/pages/validation.js') }}"></script>
<script>
! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery);
</script>

@endsection