@extends('layouts.app', ['title' => 'Welcome to Lahomes'])

@section('content')

    <!-- 🔹 Top Navigation Bar (বুটস্ট্র্যাপ নেভবার) -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white shadow-sm rounded-3">
        <div class="d-flex align-items-center">
            <span class="bg-primary text-white px-3 py-2 rounded-3 me-2 fw-bold shadow-sm">LH</span>
            <h3 class="fw-bold mb-0 text-primary">Lahomes</h3>
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4 shadow-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-dark fw-medium me-3 text-decoration-none">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 shadow-sm">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <!-- 🔹 Hero Banner + Search Bar -->
    <div class="hero-section text-center shadow-sm">
        <span class="badge bg-light text-primary px-3 py-2 rounded-pill mb-3 fw-bold text-uppercase">Discover Your Future</span>
        <h1 class="display-5 fw-extrabold text-dark mb-3">Find Your Perfect Dream Home</h1>
        <p class="text-muted fs-5 mb-4">Browse premium residential and commercial properties for sale or rent — curated just for you.</p>
        
        <!-- 🔹 Search Bar Form -->
        <div class="bg-white shadow rounded-3 p-4 col-lg-9 mx-auto">
            <form action="{{ route('customer.properties.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <div class="input-group border rounded-3">
                        <span class="input-group-text bg-white border-0 text-muted"><i class="ri-map-pin-line"></i></span>
                        <input type="text" name="search" class="form-control border-0 px-2" placeholder="Location or City...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select border rounded-3">
                        <option value="">Property Type</option>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="villa">Villa</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select border rounded-3">
                        <option value="">Status</option>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary rounded-3">
                        <i class="ri-search-line me-1"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🔹 Statistics Section -->
    <div class="row g-4 text-center my-4">
        <div class="col-6 col-md-3">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <h2 class="fw-bold text-primary mb-1">500+</h2>
                <p class="text-muted mb-0">Listings Available</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <h2 class="fw-bold text-primary mb-1">200+</h2>
                <p class="text-muted mb-0">Happy Clients</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <h2 class="fw-bold text-primary mb-1">150+</h2>
                <p class="text-muted mb-0">Verified Agents</p>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="bg-white shadow-sm rounded-3 p-4">
                <h2 class="fw-bold text-primary mb-1">10+</h2>
                <p class="text-muted mb-0">Years Experience</p>
            </div>
        </div>
    </div>

    <!-- 🔹 Property Categories Section -->
    <div class="my-5">
        <h2 class="fw-bold text-dark mb-4 text-center">Property Categories</h2>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="category-card p-4 text-center">
                    <i class="ri-building-2-line display-6 text-primary mb-2 d-block"></i>
                    <h5 class="fw-semibold text-secondary mb-0">Apartments</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 text-center">
                    <i class="ri-home-4-line display-6 text-primary mb-2 d-block"></i>
                    <h5 class="fw-semibold text-secondary mb-0">Houses</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 text-center">
                    <i class="ri-community-line display-6 text-primary mb-2 d-block"></i>
                    <h5 class="fw-semibold text-secondary mb-0">Villas</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 text-center">
                    <i class="ri-building-line display-6 text-primary mb-2 d-block"></i>
                    <h5 class="fw-semibold text-secondary mb-0">Commercial</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- 🔹 Featured Properties Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <div>
            <h4 class="fw-bold text-dark mb-1">Featured Properties</h4>
            <p class="text-muted small mb-0">Handpicked premium quality homes</p>
        </div>
        <a href="{{ route('customer.properties.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            View All <i class="ri-arrow-right-line ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @forelse ($properties as $property)
            <div class="col-md-4">
                <div class="card property-card h-100 overflow-hidden">
                    <div class="position-relative">
                        <img src="{{ $property->image ? asset($property->image) : '/images/small/img-9.jpg' }}"
                             alt="{{ $property->name }}" class="card-img-top w-100" style="height: 220px; object-fit: cover;">
                        <span class="position-absolute top-0 start-0 m-3 badge rounded-pill 
                            {{ $property->status == 'rent' ? 'bg-info text-white' : 'bg-danger text-white' }}">
                            {{ $property->status == 'rent' ? 'For Rent' : 'For Sale' }}
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-primary fw-bold fs-5">${{ number_format($property->price) }}</span>
                            <span class="text-muted small"><i class="ri-building-4-line me-1"></i>{{ ucfirst($property->type ?? 'Apartment') }}</span>
                        </div>
                        <h5 class="card-title fw-bold text-dark text-truncate mb-1">{{ $property->name }}</h5>
                        <p class="text-muted small mb-3"><i class="ri-map-pin-2-line text-danger me-1"></i>{{ $property->city }}, {{ $property->country }}</p>

                        <div class="d-flex justify-content-between text-muted small border-top pt-3">
                            <span><i class="ri-hotel-bed-line text-primary me-1"></i>{{ $property->beds ?? 3 }} Beds</span>
                            <span><i class="ri-water-flash-line text-primary me-1"></i>{{ $property->baths ?? 2 }} Baths</span>
                            <span><i class="ri-ruler-2-line text-primary me-1"></i>{{ $property->sqft ?? '1,200' }} Sqft</span>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <a href="{{ route('customer.properties.details', $property->id) }}" class="btn btn-outline-primary w-100 py-2 rounded-3 fw-medium">
                            View Full Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="fw-bold text-dark">No Properties Listed Yet</h5>
            </div>
        @endforelse
    </div>

    <!-- 🔹 Latest Properties Section -->
    <div class="my-5">
        <h2 class="fw-bold text-dark mb-4 text-center">Latest Properties</h2>
        <div class="row g-4">
            @foreach ($latestProperties as $property)
                <div class="col-md-4">
                    <div class="card property-card h-100 overflow-hidden">
                        <img src="{{ $property->image ? asset($property->image) : '/images/small/img-9.jpg' }}" alt="{{ $property->name }}" class="card-img-top w-100" style="height: 220px; object-fit: cover;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark text-truncate mb-1">{{ $property->name }}</h5>
                            <p class="text-muted small mb-2"><i class="ri-map-pin-2-line text-danger me-1"></i>{{ $property->city }}, {{ $property->country }}</p>
                            <span class="text-primary fw-bold fs-5">${{ number_format($property->price) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 🔹 Why Choose Us Section -->
    <div class="my-5 bg-light py-5 rounded-4 px-3 px-md-5">
        <h2 class="fw-bold text-dark mb-5 text-center">Why Choose Us</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="bg-white shadow-sm rounded-3 p-4 text-center h-100">
                    <i class="ri-shield-check-line display-5 text-primary mb-3 d-block"></i>
                    <h5 class="fw-semibold text-dark mb-2">Trusted Agents</h5>
                    <p class="text-muted small mb-0">Work with verified professionals who ensure transparency.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white shadow-sm rounded-3 p-4 text-center h-100">
                    <i class="ri-bank-card-line display-5 text-primary mb-3 d-block"></i>
                    <h5 class="fw-semibold text-dark mb-2">Easy Financing</h5>
                    <p class="text-muted small mb-0">Flexible payment plans tailored to your needs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white shadow-sm rounded-3 p-4 text-center h-100">
                    <i class="ri-check-double-line display-5 text-primary mb-3 d-block"></i>
                    <h5 class="fw-semibold text-dark mb-2">Verified Listings</h5>
                    <p class="text-muted small mb-0">All properties are thoroughly checked for authenticity.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Testimonials Section -->
    <div class="my-5">
        <h2 class="fw-bold text-dark mb-5 text-center">What Our Clients Say</h2>
        <div class="row g-4">
            @foreach ($testimonials as $testimonial)
                <div class="col-md-4">
                    <div class="bg-white shadow-sm rounded-3 p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $testimonial->avatar ?? '/images/avatar.png' }}" alt="{{ $testimonial->name }}" class="rounded-circle me-3" style="width: 48px; height: 48px; object-fit: cover;">
                            <div>
                                <h5 class="fw-semibold text-dark mb-0 fs-6">{{ $testimonial->name }}</h5>
                                <p class="text-muted small mb-0">{{ $testimonial->designation }}</p>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">“{{ $testimonial->message }}”</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 🔹 Call To Action Section -->
    <div class="my-5 bg-primary text-white py-5 rounded-4 text-center shadow-sm px-3">
        <h2 class="fw-bold mb-3">Ready to Find Your Dream Home?</h2>
        <p class="fs-5 mb-4 opacity-75">Join Lahomes today and explore thousands of verified listings curated for you.</p>
        <a href="{{ route('register') }}" class="btn btn-light text-primary fw-semibold px-4 py-2 rounded-3">Get Started Now</a>
    </div>

<!-- 🔹 Forced Full Width Footer -->
<footer class="bg-dark text-light py-5 mt-5" style="width: 100vw !important; max-width: 100vw !important; min-width: 100vw !important; margin: 0 !important; position: relative; left: 50%; right: 50%; margin-left: -50vw !important; margin-right: -50vw !important; box-sizing: border-box !important;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <h5 class="text-white fw-bold mb-3">About Lahomes</h5>
                <p class="text-muted small">Lahomes is your trusted real estate platform offering premium residential and commercial properties.</p>
            </div>
            <div class="col-md-3">
                <h5 class="text-white fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled text-muted small">
                    <li><a href="{{ route('customer.properties.index') }}" class="text-muted text-decoration-none hover:text-white">Properties</a></li>
                    <li><a href="{{ route('login') }}" class="text-muted text-decoration-none hover:text-white">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-muted text-decoration-none hover:text-white">Register</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="text-white fw-bold mb-3">Contact</h5>
                <ul class="list-unstyled text-muted small">
                    <li><i class="ri-map-pin-line me-2"></i> Dhaka, Bangladesh</li>
                    <li><i class="ri-phone-line me-2"></i> +880 1234 567890</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="text-white fw-bold mb-3">Follow Us</h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-muted fs-5"><i class="ri-facebook-fill"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="ri-twitter-fill"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="ri-instagram-line"></i></a>
                </div>
            </div>
        </div>
        <div class="border-top border-secondary mt-4 pt-4 text-center text-muted small">
            © {{ date('Y') }} Lahomes. All rights reserved.
        </div>
    </div>
</footer>

@endsection
