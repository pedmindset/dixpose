@extends('layouts.admin')

@section('title', 'Zone')

@section('styles')

@endsection

@section('content')

<div class="card">
        <div class="card-header">
           <b>View Zone</b>
                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                
            </div>
        </div>
        <div class="card-body collapse show">
                @if (session('status'))
                <div class="alert alert-success">
                    
                    {{ session('status') }}
               </div>
         @endif
                <table class="table table-hover color-table success-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Zone Name</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{$zone->name}}</td>
                                <td>{{$zone->desc}} </td>
                                <td class="text-nowrap">
                                        <a href="{{ action('ZoneController@edit', $zone->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        
                                 </td>
                                 <td class="text-nowrap">
                                 <form action="{{ action('ZoneController@destroy',$zone->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                     <button class="" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
        </div>
    </div>
@endsection

@section('scripts')

@endsection