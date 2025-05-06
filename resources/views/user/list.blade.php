@extends('layouts.app') {{-- Replace with your actual layout --}}

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Users</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    </div>
    
    <div class="tab-pane p-3 active preview">
        <table class="table  table-striped">
            <thead>
            <tr class="align-middle">
                <th class="col">#</th>
                <th class="col">Name</th>
                <th class="col">Email</th>
                <th class="col">Role</th>
                <th class="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="align-middle">
                    <td>
                        <div>{{ $user->id }}</div>
                    </td>
                    <td>
                        <div>{{ $user->name }}</div>
                    </td>
                    <td>
                        <div>{{ $user->email }}</div>
                    </td>
                    <td>
                        <div>{{ $user->role->name }}</div>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-link"><i class="icon icon-xl cil-pencil"></i></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger"><i class="icon icon-xl cil-trash"></i> </button>
                            </form>
                        </div>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection