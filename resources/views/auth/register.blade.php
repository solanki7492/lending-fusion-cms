@extends('layouts.app') {{-- Assuming you're extending a layout like CoreUI's 'auth' layout --}}

@section('content')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card p-4">
          <div class="card-body">
            <h1 class="text-center mb-4">Registration</h1>

            @if (session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                  type="text" 
                  name="name" 
                  id="name" 
                  class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name') }}" 
                  required 
                  autofocus
                >
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input 
                  type="email" 
                  name="email" 
                  id="email" 
                  class="form-control @error('email') is-invalid @enderror"
                  value="{{ old('email') }}" 
                  required 
                >
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                  type="password" 
                  name="password" 
                  id="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  required
                >
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Role</label>
                <select 
                  name="role_id" 
                  id="role" 
                  class="form-control @error('role_id') is-invalid @enderror" 
                  required
                >
                  <option value="" selected disabled>Select Role</option>
                  @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{$role->name}}</option>
                  @endforeach
                  
                </select>
                @error('role_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
             
              <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection