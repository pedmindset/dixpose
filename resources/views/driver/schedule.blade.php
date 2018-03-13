@extends('driver.layout.collection')

@section('title', 'Welcome')

@section('content')

<div class="card-body">
        <h4 class="card-title">You have {{ $number_of_assigned_schedules }} Schedules Today</h4>
        <h6 class="card-subtitle">View Below to start Schedule</h6>
        @if (session('status'))
        <div class="alert alert-success">
            
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

@endsection

@section('script')

<script>
        var x = document.getElementById("demo");
      
        var locationNotSupported;

        
        (function  () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                locationNotSupported = "Geolocation is not supported by this browser.";
            }
        })();
        
        function showPosition(position) {
            var latitude = document.getElementById('ld').value = position.coords.latitude;
            var longitude = document.getElementById('lg').value =  position.coords.longitude;
          
        }
        </script>

@endsection