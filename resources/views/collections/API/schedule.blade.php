@extends('driver.layout.collection')

@section('title', 'Welcome')

@section('content')

<div class="card-body">
        <h4 class="card-title">You have 2 Schedules Today</h4>
        <h6 class="card-subtitle">View Below to start Schedule</h6>
        <table id="demo-foo-row-toggler" class="table toggle-circle table-hover">
            <thead>
                <tr>
                    <th data-toggle="true"> SN </th>
                    <th> Supervisor </th>
                    <th data-hide="phone"> Sector </th>
                    <th data-hide="all"> Number of Customers </th>
                    <th data-hide="all"> Number of Bins </th>
                    <th data-hide="all"> Start Scheule </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kerry Sinclair</td>
                    <td>SECTOR A1</td>
                    <td>2,400</td>
                    <td>1,800</td>
                    <td><button class="btn btn-success"><i class="fa fa-truck"></i> Start Schedule<button</td>
                </tr>
                <tr>
                        <td>2</td>
                        <td>Terrance Owusu</td>
                        <td>SECTOR C1</td>
                        <td>1,400</td>
                        <td>800</td>
                        <td><button class="btn btn-success"><i class="fa fa-truck"></i>Start Schedule<button</td>
                </tr>
               
                
            </tbody>
        </table>
    </div>

@endsection