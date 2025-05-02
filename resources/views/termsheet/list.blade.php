@extends('layouts.app') {{-- Replace with your actual layout --}}

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Termsheet List</h4>
        <a href="{{ route('termsheet.create') }}" class="btn btn-primary">Create Termsheet</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Merchant Name</th>
                    <th>First Name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>loan_amount</th>
                    <th>origination_fee</th>
                    <th>net_loan_amount</th>
                    <th>monthly_payment</th>
                    <th>interest_rate</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($termsheets as $termsheet)
                    <tr>
                        <td>{{ $termsheet->id }}</td>
                        <td>{{ $termsheet->merchant_name }}</td>
                        <td>{{ $termsheet->first_name }}</td>
                        <td>{{ $termsheet->last_name }}</td>
                        <td>{{ $termsheet->sent_to }}</td>
                        <td>{{ $termsheet->loan_amount }}</td>
                        <td>{{ $termsheet->origination_fee }}%</td>
                        <td>{{ $termsheet->net_loan_amount }}</td>
                        <td>{{ $termsheet->monthly_payment }}</td>
                        <td>{{ $termsheet->interest_rate }}%</td>
                        <td>
                            @if($termsheet->status == 1)
                                <span class="badge bg-success">Approved</span>
                            @elseif($termsheet->status == 0)
                                <span class="badge bg-danger">Declined</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection