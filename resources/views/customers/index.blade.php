@extends('layouts.admin')

@section('title', 'View Customers')

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('node_modules/datatables/jquery.dataTables.min.css') }}" />

@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">View Customers</h4>
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
                        <table class="table table-responsive table-striped table-hover display nowrap table table-hover table-striped table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Zone</th>
                                        <th>Sector</th>
                                        <th>Ghana Post GPS</th>
                                        <th>Pick up Frequency</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                @foreach($customers as $customer)
                                <tbody>
                                   
                                    <tr>    
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $customer->name or ''}} </td>
                                            <td>{{ $customer->phone1 or '' }}</td>
                                            <td>{{ $customer->email or '' }}</td>
                                            <td>{{ $customer->address or '' }} </td>
                                            <td>{{ $customer->zone->name or '' }}</td>
                                            <td>{{ $customer->service_zone->name or ''}} </td>
                                            <td>{{ $customer->ghana_gps or '' }}</td>
                                            <td>{{ $customer->frequency or '' }}</td>
                                            <td class="text-nowrap">
                                                    <a href="{{ action('CustomerController@edit',$customer->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                    
                                             </td>
                                             <td class="text-nowrap">
                                             <form action="{{ action('CustomerController@destroy',$customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                 <button class="" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i></button>
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
