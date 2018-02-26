@extends('layouts.admin')

@section('title', 'Add Bin')

@section('styles')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Bin</h4>
                <h6 class="card-subtitle"></a></h6>
                     @if (session('status'))
                            <div class="alert alert-success">
                                
                                {{ session('status') }}
                           </div>
                     @endif
                    <form method="post" action="{{ url('bins') }}">
                         @csrf
                            <div class="form-group ">
                                <label for="type">Bin type<span class="text-danger">*</span></label>
                                 <div class="input-group col-md-3">
                                <input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" value="{{ old('type') }}" placeholder="240" required aria-label="240" aria-describedby="bintype">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="bintype">litre</span>
                                </div>
                                 </div>

                            </div>
                            <div class="form-group col-md-5">
                                <label for="desc">Description</label>
                                
                                <textarea type="text" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" id="desc" name="desc" rows="5" placeholder="Description">{{ old('desc') }}</textarea>
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
<script src="{{ asset('dist/js/pages/mask.js') }}"></script>
<script src="{{ asset('dist/js/pages/validation.js') }}"></script>
<script>
! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}(window, document, jQuery);
</script>

@endsection