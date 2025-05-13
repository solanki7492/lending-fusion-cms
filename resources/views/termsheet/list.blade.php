@extends('layouts.app') {{-- Replace with your actual layout --}}

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Termsheets</h3>
        <a href="{{ route('termsheet.create') }}" class="btn btn-primary">Create Termsheet</a>
    </div>
    
    <div class="tab-pane p-3 active preview">
        <table class="table  table-striped">
            <thead>
            <tr class="align-middle">
                <th class="col">LEAD NAME</th>
                <th class="col">FIRST NAME</th>
                <th class="col">LAST NAME</th>
                <th class="col">LOAN AMOUNT</th>
                <th class="col">SEND AT</th>
                <th class="col" style="width: 30%;">SENT TO</th>
                <th class="col">SENT BY</th>
                <th class="col">TERMSHEET</th>
            </tr>
            </thead>
            <tbody>
            @foreach($termsheets as $termsheet)
                <tr class="align-middle">
                    <td>
                        <div>{{ $termsheet->merchant_name }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->first_name }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->last_name }}</div>
                    </td>
                    <td>
                        <div>{{ number_format( $termsheet->loan_amount) }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->created_at->format('m/d/Y') }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->emails->pluck('email')->join(', ') }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->user->name }}</div>
                    </td>
                    <td>
                        <a href="{{ asset('/' . $termsheet->termsheet) }}" class="btn btn-link" target="_blank"><i class="icon icon-xxl mb-2 cil-cloud-download"> </i></a>
                    </td>
                </tr>
            @endforeach
                        
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $termsheets->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection