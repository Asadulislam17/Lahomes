@extends('layouts.auth', ['title' => 'Reset Password'])

@section('content')

<div class="col-xl-5">
    <div class="card auth-card">
        <div class="card-body px-3 py-5">
            <div class="mx-auto mb-4 text-center auth-logo">
                {{-- ১. লোগোর লিঙ্ক পরিবর্তন করে route('login') করা হয়েছে --}}
                <a href="{{ route('login') }}" class="logo-dark">
                    <img src="/images/logo-dark.png" height="32" alt="logo dark">
                </a>

                <a href="{{ route('login') }}" class="logo-light">
                    <img src="/images/logo-light.png" height="28" alt="logo light">
                </a>
            </div>

            <h2 class="fw-bold text-uppercase text-center fs-18">Reset Password</h2>
            <p class="text-muted text-center mt-1 mb-4">Enter your email address and we'll send you an email with instructions <br /> to reset your password.</p>

            
            @if (session('status'))
                <div class="alert alert-success mx-4 text-center" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="px-4">
               
                <form action="{{ route('password.email') }}" method="POST" class="authentication-form">
                    @csrf 

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                       
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control bg-light bg-opacity-50 border-light py-2" placeholder="Enter your email" required autofocus>
                        
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-1 text-center d-grid">
                        <button class="btn btn-danger py-2 fw-medium" type="submit">Reset Password</button>
                    </div>
                </form>
            </div> <!-- end col -->
        </div> <!-- end card-body -->
    </div> <!-- end card -->
    
    <p class="mb-0 text-center text-white">Back to <a href="{{ route('login') }}" class="text-reset text-unline-dashed fw-bold ms-1">Sign In</a></p>
</div> <!-- end col -->

@endsection
