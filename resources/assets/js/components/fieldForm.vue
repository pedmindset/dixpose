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
            <div class="form-group form-control">
              <input type="text" v-model="location">
            </div>
            <div>
              <button @click='created'>Enter</button>
            </div>
            <!--customer id created to run get function created-->

            <!--customer information is displayed here-->
            <div class="card">
              <div class="customer-box">
                <h4>Client Info</h4>

                <h5 style="font-weight: 600;">{{ customers.name }}</h5>
                <div id="customerInfo" v-for="bin in customers.bins">
                  <input class="" type="checkbox" name="bin-1">{{bin.type}}<br>
                  
                  
                  <!--<p>{{customer.body}}</p>-->
                </div>
                <!--customer information is displayed here-->

                <!--bin data is loaded here-->
                <div v-for="customer in customers">
                  <!-- <input class="" type="checkbox" name="bin-1">{{customer.order}}<br> -->
                </div>
                <!--end of bin data-->
              </div>
            </div>
            <div>
              <textarea name="remarks" placeholder="Enter Remarks"></textarea>
            </div>
            <div class="button-box">
              <button class="btn btn-primary pull-right" v-on:click.prevent="addCollection()">Collected</button>
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
  import axios from 'axios'

  var session_url = 'http://localhost:8000/api/v1/collections';
  var username = 'kevin@gmail.com';
  var password = 'password';
  var credentials = btoa(username + ':' + password);
  var BasicAuth = 'Basic ' + credentials;

  export default {
    name: "fieldForm.vue",

    data: function () {
      return {
        customers: [],

        location: '',

        status: '',

        bins: []
      }
    },
    methods: {

      created() {
        axios.get('api/v1/collections/' + this.location, {
          // headers: {'Authorization': BasicAuth}
        })
          .then((response) => {
            // console.log(response);
            // console.log(response.data.data)
            this.customers = response.data.data;
            // console.log(this.customers["bins"])
            
          
          })
          .catch(error => {
            console.error(error.message)

          })
      }
    },
    addCollection: function () {
      axios.put(session_url, {
        // headers: {'Authorization': BasicAuth}
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

<style>
  body {
    background-color: green;
  }



  .customer-box {
    display: block;
    margin: auto;
    width: 100%;
    padding: 15px;
    background: #eee;

  }


  .make-center {
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
<!--limit data value to 5 in json api-->
<!--let newDataSet = {},-->
<!--i = 0;-->
<!--for (let key in response.data) {-->
<!--if (response.data.hasOwnProperty(key) && i < 5) {-->
<!--newDataSet[key] = response.data[key];-->
<!--}-->
<!--i++;-->
<!--}-->
<!--<!--limit data value to 5 in json api-->-->






