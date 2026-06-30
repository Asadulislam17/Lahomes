@extends('layouts.vertical', ['title' => 'Agent Grid', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h4 class="text-dark mb-1">Welcome Back , Gaston</h4>
                        <p class="fs-14">This is your properties portfolio report</p>
                        <div class="row align-items-center text-center mb-2">
                            <div class="col-lg-7 border-end border-light">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div id="grid-chart" class="apex-charts"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>Properties</h5>
                                        <h2 class="fw-semibold text-dark">250</h2>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ps-2">
                                    <p class="d-flex align-items-center mb-2 gap-2"><i class='ri-circle-fill text-primary'></i>80 Vacant</p>
                                    <p class="d-flex align-items-center mb-2 gap-2"><i class='ri-circle-fill text-warning'></i>40 Occupied</p>
                                    <p class="d-flex align-items-center gap-2 mb-0"><i class='ri-circle-fill text-success'></i>30 Unlisted</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mb-0 d-flex align-items-center gap-1">Last Updated <span>:</span> <span class="text-dark">4 day ago</span></p>
                    </div>
                    <div class="col-lg-5 text-end">
                        <img src="/images/home-2.png" alt="" class=" img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center border-bottom border-dashed">
                <h4 class="card-title mb-0">Development Task</h4>
                <div class="ms-auto">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle drop-arrow-none card-drop p-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">Download</a>
                            <a href="javascript:void(0);" class="dropdown-item">Share</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <h5 class="text-dark fw-medium mb-1">250</h5>
                        <p class="text-muted mb-0">Total properties </p>
                    </div>
                    <div class="col-lg-4 col-3 text-center">
                        <h5 class="text-dark fw-medium mb-1">30</h5>
                        <p class="text-muted mb-0">Pending</p>
                    </div>
                    <div class="col-xl-3 col-3 text-end">
                        <h5 class="text-dark fw-medium mb-1">04</h5>
                        <p class="text-muted mb-0">Day Left</p>
                    </div>
                </div>
                <div class="progress progress-lg bg-light-subtle rounded-0 gap-1 overflow-visible mt-2" style="height: 10px">
                    <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: 40%">
                    </div>
                    <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: 30%">
                    </div>
                    <div class="progress-bar bg-info rounded-pill" role="progressbar" style="width: 30%">
                    </div>
                </div>
                <p class="mb-0 mt-3"><span class="text-success fw-medium mb-0"><i class="ri-arrow-up-line"></i>34.4%</span> vs last month</p>
            </div>
            <div class="card-footer d-flex justify-content-between  py-2">
                <p class="text-muted mb-0 d-flex align-items-center gap-1">Last Updated <span>:</span> <span class="text-dark">12 hour ago</span></p>
                <a href="#!" class="link-primary fw-medium">View More</a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6">
        <div class="card bg-primary bg-gradient">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h4 class="card-title mb-2 text-white">Total Seal Properties </h4>
                        <p class="text-white fw-medium fs-24 mb-0">450</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-light rounded">
                            <iconify-icon icon="solar:home-bold-duotone" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div id="seal_properties" data-colors="#ffffff" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card bg-body shadow-none">
            <div class="card-header border-0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <p class="mb-0 text-muted">Showing all <span class="text-dark fw-semibold">311</span> Agent</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-md-end mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary me-1"><i class="ri-settings-2-line me-1"></i>More Setting</button>
                            <button type="button" class="btn btn-outline-primary me-1"><i class="ri-filter-line me-1"></i> Filters</button>
                            <button type="button" class="btn btn-success me-1"><i class="ri-add-line"></i> New Agent</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    @forelse ($agents as $agent)
    <div class="col-xl-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-2 border-bottom pb-3">
                    <img src="{{ $agent->photo ? asset($agent->photo) : '/images/users/avatar-2.jpg' }}" alt="" class="avatar-lg rounded-3 border border-light border-3">
                    <div class="d-block">
                        <a href="{{ route('agents.details', ['id' => $agent->id]) }}" class="text-dark fw-medium fs-16">{{ $agent->name }}</a>
                        <p class="mb-0">{{ $agent->email }}</p>
                        <p class="mb-0 text-primary"># {{ $agent->id }}</p>
                    </div>
                </div>
                <p class="mt-3 d-flex align-items-center gap-2 mb-2"><iconify-icon icon="solar:phone-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ $agent->phone ?? 'N/A' }}</p>
                <p class="d-flex align-items-center gap-2 mt-2"><iconify-icon icon="solar:map-point-wave-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ $agent->address ?? 'N/A' }}</p>
                <p class="d-flex align-items-center gap-2 mt-2"><iconify-icon icon="solar:case-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ $agent->experience ?? 'N/A' }} Experience</p>
            </div>
            <div class="card-footer border-top">
                <div class="row g-2">
                    <div class="col-lg-6">
                        <a href="tel:{{ $agent->phone }}" class="btn btn-primary w-100"><iconify-icon icon="solar:outgoing-call-rounded-broken" class="align-middle fs-18"></iconify-icon> Call Us</a>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('messages.index') }}" class="btn btn-light w-100"><iconify-icon icon="solar:chat-round-dots-broken" class="align-middle fs-16"></iconify-icon> Message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">No agents found.</div>
    @endforelse

</div>
<div class="p-3 border-top">
    {{ $agents->links() }}
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/agent-grid.js'])
@endsection