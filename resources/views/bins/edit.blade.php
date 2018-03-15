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
                    <form method="post" action="{{ action('BinController@update', $bin->id or '') }}">
                         @csrf
                         @method('PUT')



                         <div class="form-group col-md-5  ">
                                <label for="type">Bin type<span class="text-danger">*</span></label>
                                 <div class="input-group ">
                                    <input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" id="type" name="type" value="{{ $bin->type or '' }}" placeholder="240" required aria-label="240" aria-describedby="bintype">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="bintype">litre</span>
                                </div>
                            </div>

                        </div>
                    <div class="form-group col-md-6  {{ $errors->has('price') ? 'has-error' : ''}}">
                            <label for="price" class="control-label">Price</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input class="form-control input-group-prepend" name="price" type="number" id="price" value="{{ $bin->price or '' }}" required  aria-describedby="price" >
                                <span class="input-group-text" id="price">GHS</span>
                         </div>
                                {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('classification_id') ? 'has-error' : ''}}">
                            <label for="classification" class="col-md-4 control-label">Classification</label>
                            <div class="col-md-5">
                                <select name="bin" class="form-control custom-select {{ $errors->has('bin') ? ' is-invalid' : '' }}" required data-validation-required-message ="Please select the Bin Type">
                                        @foreach($classifications as $classification)
                                        <option value="{{$classification->id or ''}}">{{$classification->class or ''}}</option>
                                        @endforeach
                                    </select>
                                <small class="form-control-feedback text-danger"> Select Bin Type </small> 
                                {!! $errors->first('classification_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                            <div class="form-group col-md-5">
                                <label for="desc">Description</label>
                                
                                <textarea type="text" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" id="desc" name="desc" rows="5" placeholder="Description">{{ $bin->desc or '' }}</textarea>
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