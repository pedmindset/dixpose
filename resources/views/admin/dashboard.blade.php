@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <router-view></router-view>
            </div>
        </div>
    </div>
@endsection
