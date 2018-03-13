@extends('driver.layout.collection')

@section('title', 'Start Collections')

@section('style')

@endsection

@section('content')

<div class="card-body">
        <h4 class="card-title">{{ $collection->name}}</h4>
        <h6 class="card-subtitle">{{ $collection->class->name}}</h6>
        @if (session('status'))
        <div class="alert alert-success">
            
            {{ session('status') }}
       </div>
 @endif
           
        <form>
                <div class="form-group form-control-success col-md-12 p-t-40 p-b-40  ">
                  <label>Customer Code</label>
                      <input type="text" class="form-control text-center"  placeholder="Enter Customer Code" id="txt1" onkeyup="showHint(this.value)"> 
                      {{--  <p>Suggestions: <span id="txtHint"></span></p>   --}}


                

                      <span class="help-block text-muted primary">
                          <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                      </span> 
              </div>
              </form>
 </div>

@endsection

@section('script')

{{--  <script>
        function showHint(str) {
          var xhttp;
          if (str.length == 0) { 
            document.getElementById("txtHint").innerHTML = "";
            return;
          }
          xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
              document.getElementById("txtHint").innerHTML = data.data.name;
            }
          };
          xhttp.open("GET", "https://dixpose.dev/api/v1/collections/"+str, true);
          xhttp.send();   
        }
        </script>  --}}

@endsection