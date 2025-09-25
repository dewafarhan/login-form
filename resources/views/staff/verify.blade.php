@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verification Management</div>

                <div class="card-body">
                    <h2>Verification Queue</h2>
                    <div class="alert alert-info">
                        No pending verifications at the moment.
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-secondary">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
