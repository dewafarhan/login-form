@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Staff Dashboard</div>

                <div class="card-body">
                    <h2>Welcome, {{ auth()->user()->name }}</h2>
                    
                    <div class="mt-4">
                        <h4>Quick Actions</h4>
                        <div class="list-group">
                            <a href="{{ route('verify') }}" class="list-group-item list-group-item-action">
                                Verification Management
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>Your Statistics</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Pending Verifications</h5>
                                        <p class="card-text h3">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
