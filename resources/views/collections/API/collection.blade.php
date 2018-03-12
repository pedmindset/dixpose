@extends('driver.layout.collection')

@section('title', 'Start Collections')

@section('style')

@endsection

@section('content')

<div class="card-body">
        <h4 class="card-title">Welcome to todays Collections</h4>
        <h6 class="card-subtitle">Enter Customer code to update his Collection Status</h6>
           
        <form>
                <div class="form-group form-control-success col-md-12 p-t-40 p-b-40  ">
                  <label>Customer Code</label>
                      <input type="text" class="form-control text-center"  placeholder="Enter Customer Code" > 
                      <span class="help-block text-muted primary">
                          <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                      </span> 
              </div>
              </form>
 </div>

@endsection

@section('script')

@endsection