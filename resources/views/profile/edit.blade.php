@extends('layouts.vertical', ['title' => 'My Profile', 'subTitle' => 'Account'])

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">

        @if (session('status') == 'profile-updated')
            <div class="alert alert-success">Profile updated successfully!</div>
        @endif

        @if (session('status') == 'password-updated')
            <div class="alert alert-success">Password updated successfully!</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- প্রোফাইলের উপরের অংশ: ছবি, নাম, রোল -->
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <img src="{{ $user->photo ? asset($user->photo) : '/images/users/avatar-2.jpg' }}"
                     class="avatar-xl rounded-circle border" alt="profile photo">
                <div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                    <span class="badge bg-primary text-uppercase">{{ $user->role }}</span>
                </div>
            </div>
        </div>

        <!-- প্রোফাইল তথ্য আপডেট করার ফর্ম -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
                    </div>

                    @if ($user->role == 'agent')
                        <div class="mb-3">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" class="form-control" value="{{ old('experience', $user->experience) }}" placeholder="e.g. 3 Year">
                        </div>
                    @endif

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- পাসওয়ার্ড পরিবর্তনের ফর্ম -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- অ্যাকাউন্ট ডিলিট -->
        <div class="card border-danger">
            <div class="card-header">
                <h4 class="card-title text-danger">Delete Account</h4>
            </div>
            <div class="card-body">
                <p class="text-muted">একবার অ্যাকাউন্ট ডিলিট করলে সব তথ্য মুছে যাবে, ফিরিয়ে আনা যাবে না।</p>
                <form action="{{ route('profile.destroy') }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete your account?');">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password" class="form-control" required style="max-width: 300px;">
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
