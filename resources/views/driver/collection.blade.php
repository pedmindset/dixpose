@extends('driver.layout.collection')

@section('title', 'Start Collections')

@section('style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@endsection

@section('content')

<div class="card-body">
        <h4 class="card-title">Welcome to todays Collections</h4>
        <h6 class="card-subtitle">Enter Customer code to update his Collection Status</h6>
        @if (session('status'))
        <div class="alert alert-warning">
            
            {{ session('status') }}
       </div>
 @endif
           
        <form>
                <div class="form-group form-control-success col-md-12 p-t-40 p-b-40  ">
                  <label>Customer Code</label>
                  <input type="text" class="form-control form-control-danger text-center "  placeholder="Enter Customer Code" id="customer"> 
                  {{--  <input type="hidden" name="name" id="name">
                  <input type="hidden" name="status" id="status">
                  <input type="hidden" name="collection" id="collection">  --}}
                  <div class="col-md-12" id="getResult">
                          {{--  Customer: <span id="txtHint"></span>  --}}
                        <div class="col-md-6" id='CustomerName'></div>
                        <div class="col-md-6" id="code"></div>
                  </div> 
                

                

                      <span class="help-block text-muted primary">
                          <small></small>
                      </span> 

                      <div class="form-group row p-t-20">
                            <div class="col-sm-4">
                                <div class="custom-control custom-checkbox" id="customerBins">
                                    
                                </div>
                            </div>
                     </div>

                     <div class="col-m-12">
                         <button type="button" id="addCollection" class="btn waves-effect waves-light btn-primary">Add Collections</button>
                     </div>
   



              </div>
              </form>
 </div>

@endsection

@section('script')

<script>

    $(document).ready(function(){

        $('#customer').change(function(){

            if($(this).val().length > 0 ){

                var id = $(this).val();
                // var username = 'emmanueloduro@hotmail.com';
                // var password = '123456';
                // var credentials = btoa(username + ':' + password);
                // var BasicAuth = 'Basic ' + credentials;

                //  var grant_type = 'password';
                //  var client_id = 1;
                //  var client_secret = 'xoWzxwgDWATBtdkQVbuzgR9hXP399xMA4QmyIcQF';
                // var  username = 'emmanueloduro@hotmail.com@hotmail.com';
                //  var password = '123456';
                //  var theNewProvider = 'driver_api';
                // var scope = '';

                 var access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ0ZmIzMDE5NjkyNGEyYjQ5OGU2NTFiMDhkNDFmZjBmMTk1NzY0Zjg5NzViOTJmMjQwNTFhYmZlZGFlOTQ3YzkxOGU5ZTBiMWQ2Nzc4NjQzIn0.eyJhdWQiOiIxIiwianRpIjoiZDRmYjMwMTk2OTI0YTJiNDk4ZTY1MWIwOGQ0MWZmMGYxOTU3NjRmODk3NWI5MmYyNDA1MWFiZmVkYWU5NDdjOTE4ZTllMGIxZDY3Nzg2NDMiLCJpYXQiOjE1MjA5NzY1MDMsIm5iZiI6MTUyMDk3NjUwMywiZXhwIjoxNTUyNTEyNTAzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.XEA9Qo6YklOqe1Sqh7-I0EhxfHSwd3wAbqHc8mhIffjW_b3NkgV_HEPnLes6luexeo4qMX2sgtuOFxSQ6elS8jFDDQ51hETRuG6CgwsChew3IW8hRdtVnK051AJBYOu4N1dGJe3F9nW1NDyIKJXdjY0X0ymO1Csd9GwhLgRqb4WT2RSYPj5E9Um-VDtmIbXxyRjxsuREmqLrWZ-75cwyDUs5PT1wMu23sfW-cfj-PEVAjhXfND53dd-4KkYbKkMgcy5RmBcP4gF6NgOL6R-Xj5k1aLqcsmAwp2jcR-a0GRJT3gluUUMArGpEklwPLr6vYme5GeZ5K2R_IydASa01Lz1tHQhHs5C4yIvD9SyBEkleuwR1KikiM-HwCJacHpRuIGZrycWJKjv9OQ-DEIJErsn4GlBSHMbCJq5zExMPGYhOlscxD5FOWaQywWh6rJ66TBX5bZ5QEee223dlt8RkCNbQ6ZS7ynj-A9xllRueT0hxfZqXJyqBFrjmAd102Q_QnvGPxZufsXK9ddu81g_jWC4fOyg81RiMJz_Xaqo6YEYep7jiPWvQsp5zv8KKAKFXtegnz80LNEoy8-ncYD6bbusnNMslXaJa1ytVl9fFqmIihP3P_AZFjhUuu6Gp6PQ04Y38oHHTH3n9MBiGX_sbmjCWuJ48EdZ00QAkEfeewfM"

                //var location = window.location.host;
                $.ajax({
                    
                    beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + access_token); } ,
                    url: 'https://dixpose.dev/api/v1/collections/'+id, 
                   
                })
                .then(
                    function success(data){
                        var name = document.getElementById('CustomerName');
                        var code = document.getElementById('code');
                        var customerBins = document.getElementById('customerBins');
                        name.innerHTML = "Customer name: "+ "<b>"+ data.name +"</b>";
                        code.innerHTML = "Collection code: "+ "<b>"+ data.collection[0].code+ "</b>";

                        var bin = data.bin;
                        var customerBinsHtml = ''
                        
                        for (let index = 0; index < bin.length; index++) {
                            customerBinsHtml += '<input type=' + ' "checkbox" ' + ' name = "bins[]"' + ' id = "binscheckbox"' + ' value="' + bin[index].id +'"> '+ bin[index].type + ' litre bin<br>';   
                        }

                        customerBins.innerHTML = customerBinsHtml;


                        $('#addCollection').click(function(){
                            if(data){
                                var name = data.name;
                                var collection = data.collection[0].id;
                                var status = 'Collected';
                                var bins = [];

                                var checkedBins = { 'bins[]' : []};
                                $(":checked").each(function() {
                                checkedBins['bins[]'].push($(this).val());
                                });

                                var formData = {
                                    status: status,
                                    bins: checkedBins
                                }

                                


                                // var username = 'emmanueloduro@hotmail.com';
                                // var password = '123456';
                                // var credentials = btoa(username + ':' + password);
                                // var BasicAuth = 'Basic ' + credentials;
                                        
                                $.ajax({
                                  
                                    beforeSend: function(xhr, settings) { xhr.setRequestHeader('Authorization','Bearer ' + access_token); } ,
                                    url: 'https://dixpose.dev/api/v1/collections/'+collection,
                                    type: 'PUT',
                                    dataType: 'json',
                                    data: formData,
                                    crossDomain: true,
                                    success: function(result){
                                        swal({
                                            title: "Added!",
                                            text: "Collection was successfull!",
                                            icon: "success",
                                            button: "Add next!",
                                        }).
                                        then((result)=>{
                                            location.reload();
                                        });
                                    },
                                    error: function(error){
                                        swal({
                                            title: "Oops Sorry!",
                                            text: "Collectoion was not added",
                                            icon: "warning",
                                            button: "try again again!",
                                            }). 
                                            then((result)=>{
                                                location.reload();
                                        });
                                    }

                                })
                            }
                     }); 
                            
                    },
                    function fail(data){
                        swal({
                            title: "Oops Sorry!",
                            text: "Customer was not found",
                            icon: "warning",
                            button: "Search again!",
                            });
                 }
                );
            };
            
            
        });
    });
       
        </script>
    


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection