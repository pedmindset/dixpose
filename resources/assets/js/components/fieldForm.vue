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
                <div id="customerInfo" v-for="bin in customers.bins" v-model="collectedBins">
                  <input class="" type="checkbox">{{bin.type}}<br>
                </div>
                <!--customer information is displayed here-->
 
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
 
        collectedBins: [],
 
        collectionsId: '',
 
 
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
            this.cullectionId = response.data.data["collectionsId"]
 
            // console.log(this.customers["bins"])
           
         
          })
          .catch(error => {
            console.error(error.message)
 
          })
      }
    },
    addCollection: function() {
      axios.put(session_url, {
        // headers: {'Authorization': BasicAuth}
          status = "collected",
          bins = this.collectedBins,
          collectionId =this.collectionId.id,
      })
        .then((update)=> {
          console.log(update);
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