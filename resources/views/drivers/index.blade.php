@extends('layouts.admin')

@section('title', 'View Drivers')

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables/jquery.dataTables.min.css') }}" />

@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">View Drivers</h4>
                        <h6 class="card-subtitle">{{ $i = '' }}</a></h6>
                         @if (session('status'))
                            <div class="alert alert-success">
                                
                                {{ session('status') }}
                           </div>
                     @endif
                        <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                    </div>
                </div>
                <div class="card-body">  
                        <table class="table table-striped table-hover display nowrap table table-responsive table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Driver Name</th>
                                        <th>Phone 1</th>
                                        <th>Phone 2</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                @foreach($drivers as $driver)
                                <tbody>
                                   
                                    <tr>    
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $driver->name or '' }} </td>
                                            <td>{{ $driver->phone1 or '' }}</td>
                                            <td>{{ $driver->phone2 or '' }} </td>
                                            <td>{{ $driver->email or '' }} </td>
                                            <td>{{ $driver->address or '' }}</td>
                                            <td class="text-nowrap">
                                                    <a href="{{ action('DriverController@edit',$driver->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                    
                                             </td>
                                             <td class="text-nowrap">
                                             <form action="{{ action('DriverController@destroy',$driver->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                 <button class="" data-toggle="tooltip" data-original-title="delete"> <i class="fa fa-close text-danger"></i></button>
                                                </form>
                                            </td>
                                        
                                        </tr>
                                    
                                </tbody>
                                @endforeach
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('scripts')
<script src="{{ asset('node_modules/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
 <!-- start - This is for export functionality only -->
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
 <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
 <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
 <!-- end - This is for export functionality only -->
 <script>
 $(document).ready(function() {
     $('#myTable').DataTable();
     $(document).ready(function() {
         var table = $('#table3').DataTable({
             "columnDefs": [{
                 "visible": false,
                 "targets": 2
             }],
             "order": [
                 [2, 'asc']
             ],
             "displayLength": 25,
             "drawCallback": function(settings) {
                 var api = this.api();
                 var rows = api.rows({
                     page: 'current'
                 }).nodes();
                 var last = null;
                 api.column(2, {
                     page: 'current'
                 }).data().each(function(group, i) {
                     if (last !== group) {
                         $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                         last = group;
                     }
                 });
             }
         });
         // Order by the grouping
         $('#table2 tbody').on('click', 'tr.group', function() {
             var currentOrder = table.order()[0];
             if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                 table.order([2, 'desc']).draw();
             } else {
                 table.order([2, 'asc']).draw();
             }
         });
     });
 });
 $('#table1').DataTable({
     dom: 'Bfrtip',
     buttons: [
         'copy', 'csv', 'excel', 'pdf', 'print'
     ]
 });
 </script>

@endsection
