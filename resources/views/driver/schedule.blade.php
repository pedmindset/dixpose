@extends('driver.layout.collection')

@section('title', 'Welcome')

@section('content')

<div class="card-body">
        <h4 class="card-title">You have {{ $number_of_assigned_schedules }} Schedules Today</h4>
        <h6 class="card-subtitle">View Below to start Schedule</h6>
        @if (session('status'))
        <div class="alert alert-warning">
            
            {{ session('status') }}
       </div>
 @endif
        <table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
            <thead>
                <tr>
                    <th data-toggle="true"> SN </th>
                    <th> Supervisor </th>
                    <th data-hide="sector">Sector </th>
                    <th data-hide="all"> Pick up date </th>
                    <th data-hide="all" class="text-nowrap"> Start Scheule </th>
                </tr>
            </thead>
            <tbody class="{{ $i = '' }}">
                @foreach($assigned_schedules as $assigned_schedule)
                <tr>
                     <td>{{ ++$i }}</td>
                    <td>{{ $assigned_schedule->supervisor->name }}</td>
                    <td>{{ $assigned_schedule->service_zone->name }}</td>
                    <td>{{ $assigned_schedule->pickupdate }}</td>
                    <td class="text-nowrap">
                        <form action="{{ action('DriverController@startSchedule', $assigned_schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="lg" name='startpoint_lg' value=""> 
                            <input type="hidden" id='lt' name='startpoint_lt' value=""> 
                            <input type="hidden" name='startpoint_time' value="{{ now()->toDateTimeString() }}"> 
                            <input type="hidden" name='status' value="Started"> 

                        <button class="btn btn-success"><i class="fa fa-truck"></i> Start Schedule</button>
                        </form>
                    </td>
                </tr>

               
                
               
                @endforeach
            </tbody>
        </table>
       
    </div>
    <div id="map" class="map col-m-12"></div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJzm4i6XEWNpWOrqluaF_olV1vs_DT8oc&callback=" async defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.min.js"></script>


<script>

$(document).ready(function(){
  var element =  document.getElementById('map');
    if (typeof(element) != 'undefined' && element != null)
  {
    var map = new GMaps({
        el: '#map',
        lat: -12.043333,
        lng: -77.028333
        });

        GMaps.geolocate({
        success: function(position) {
        map.setCenter(position.coords.latitude, position.coords.longitude);
        
  },
        error: function(error) {
            alert('Geolocation failed: '+error.message);
        },
        not_supported: function() {
            alert("Your browser does not support geolocation");
        },
        always: function() {
            alert("Done!");
        }
    });
  }
});


        
       
</script>

@endsection