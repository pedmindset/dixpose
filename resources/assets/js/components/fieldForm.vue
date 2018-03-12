<template>

  <div class="col-md-4 col-md-offset-4">
    <!--<div class="row">-->
    <div class="make-center">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title ">Field Collection</h3>
          </div>
            <div class="panel-body">
              <form>
                <!--customer id created to run get function created-->
                <div class="form-group">
                  <input type="text">
                  <button @click='created' >Enter</button>
                </div>
                <!--customer id created to run get function created-->

                <!--customer information is displayed here-->
              <div class="card">
                <div class="customer-box">
                    <h4>Client Info</h4>
                    <div id="customerInfo" v-for="customer in customers">
                      <h5>{{customer.title}}</h5>
                      <p>{{customer.body}}</p>
                    </div>
                  <!--customer information is displayed here-->

                  <!--bin data is loaded here-->
                  <div v-for= "bin in bins" >
                      <input type="checkbox" name="bin-1" >{{bin.id}}<br>-->
                      <input type="checkbox" name="bin-2" > {{bin.id}}<br>-->
                  </div>
                  <!--end of bin data-->
                </div>
              </div>
              <div>
                <textarea name="remarks" placeholder="Enter Remarks"></textarea>
              </div>
              <div class="button-box">
                <button class="btn btn-primary pull-right" v-on:click.prevent="addCollection">Collected </button>
                <button class="btn btn-primary pull-left" v-on:click.prevent>Not Collected</button>
              </div>
              </form>
          </div>
        </div>
    <!--</div>-->
    </div>
  </div>

</template>

<script>
  var session_url = 'api/v1/collections';
  var username = 'emmarthurson@gmail.com';
  var password = '123456';
  var credentials = btoa(username + ':' + password);
  var BasicAuth = 'Basic ' + credentials;
    export default {

        data: function(){
          return{
            customers: [],
            location: '',
            status: '',
            bins:[]
            }
          },
          methods: {

            created() {
              axios.get(session_url, {
                headers: {'Authorization': BasicAuth }
              })
                .then((response) => {
                  console.log(response.data);
                  this.customers = response.data.body;
                })
                .catch(error => {
                  console.error(error.message)

                })
            }
          },
            addCollection: function () {
              axios.put(session_url,{
                headers: {'Authorization': BasicAuth}
              })
                .then(function (input) {
                  this.status = '';
                  this.bins = '';
                  console.log(input);
                })
                .catch(error => {
                  console.error(error.message)
                });
            }
    }

 
</script>

<style >
  body{
     background-color : green;
  }
  textarea {
    display: block;
    margin: auto;
    padding: auto;

  }
  .customer-box {
    display: block;
    margin: auto;
    padding: 15px;
    background: #eee;

  }
  .button-box{
    margin: auto;
    padding: 15px;

  }
  .make-center{
    align-content: center;
    justify-content: center;
    display: flex;
    margin-top: 40%;
  }


</style>


<!--authentication allows-->
<!--//   'Access-Control-Allow-Credentials': true,-->
<!--'Access-Control-Allow-Headers'; 'Origin, Content-Type, X-Auth-Token, Authorization',-->
<!--'Access-Control-Allow-Methods'; 'GET, POST, PATCH, PUT, DELETE, OPTIONS',-->
<!--'Content-Type'; 'application/json'-->
<!---->






