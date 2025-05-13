@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="mb-4">User Profile</h2>

    <form action="{{ route('profile.update',$user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6 col-6">
                <div class="mb-1">
                    <label class="form-label" for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3" ">Submit</button>
        </div>
    </form>
    
@endsection