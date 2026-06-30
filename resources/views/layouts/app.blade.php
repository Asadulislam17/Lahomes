<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials/title-meta', ['title' => $title ?? 'Welcome to Lahomes'])
    @include('layouts.partials/head-css')

    <style>
        /* থিমের ড্যাশবোর্ড বক্সড লেআউট জোর করে ভেঙে হোমপেজকে ফুল-উইডথ করার কাস্টম সিএসএস */
        html, body, #layout-wrapper, .main-content, .page-content {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            transform: none !important;
            background-color: #f8f9fa !important;
        }
        /* ড্যাশবোর্ডের মেনুবার বা সাইডবার হোমপেজে চলে আসলে তা হাইড রাখার জন্য */
        .vertical-menu, .navbar-menu, .footer-theme, .page-title-box, .navbar-header {
            display: none !important;
        }
        .hero-section {
            background: linear-gradient(135deg, #f1f3f5 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 60px 20px;
            margin-top: 24px;
            margin-bottom: 24px;
        }
        .category-card, .property-card {
            background: #ffffff;
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .category-card:hover, .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="bg-gray-50 m-0 p-0 overflow-x-hidden">

<div class="container py-4">
    @yield('content')
</div>

@include('layouts.partials/footer-scripts')

</body>

</html>
