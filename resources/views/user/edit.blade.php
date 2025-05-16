@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Edit User</h2>

    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="email">Email:</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="address">Role:</label>
                    <select class="form-select" name="role_id" id="role">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3" ">Update</button>
        </div>
    </form>
@endsection
