@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Login</div>

                <div class="card-body">
                    @if (session('status'))
                            <div class="alert alert-danger">
                                
                                {{ session('status') }}
                           </div>
                     @endif
                    <form method="POST" action="{{ route('signin') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="subdomain" class="col-sm-4 col-form-label text-md-right">Company Subdomain</label>

                            <div class="col-md-6">
                                <input id="subdomain" type="text" class="form-control{{ $errors->has('subdomain') ? ' is-invalid' : '' }}" name="subdomain" value="{{ old('subdomain') }}" required autofocus>

                                @if ($errors->has('subdomain'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subdomain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
