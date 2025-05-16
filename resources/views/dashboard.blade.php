@extends('layouts.app') {{-- Replace with your actual layout --}}

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Termsheet Count</h3>
    </div>
    
    <div class="tab-pane p-3 active preview">
        <table class="table  table-striped">
            <thead>
            <tr class="align-middle">
                <th class="col">User Name</th>
                <th class="col">Email</th>
                <th class="col">Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($termsheets as $termsheet)
                <tr class="align-middle">
                    <td>
                        <div>{{ $termsheet->user->name }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->user->email }}</div>
                    </td>
                    <td>
                        <div>{{ $termsheet->termsheet_count }}</div>
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