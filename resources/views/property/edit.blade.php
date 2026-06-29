@extends('layouts.vertical', ['title' => 'Edit Property', 'subTitle' => 'Real Estate'])

@section('css')
    @vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
    <!-- প্রোপার্টি আপডেট ফরম, POST এর সাথে PUT মেথড এবং ইমেজ আপলোডের enctype -->
    <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="row">
            <!-- বাম পাশের প্রিভিউ কলাম (ডাটাবেজের বর্তমান ডাটা দেখাবে) -->
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <img id="leftPropertyPreviewImg" src="{{ $property->image ? asset($property->image) : asset('/images/properties/p-1.jpg') }}" alt="" class="img-fluid rounded bg-light" style="width: 100%; max-height: 200px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 p-1">
                                <span id="leftPropertyForBadge" class="badge {{ strtolower($property->property_for) == 'rent' ? 'bg-success' : 'bg-warning' }} text-light fs-13">For {{ $property->property_for }}</span>
                            </span>
                        </div>
                        <div class="mt-3">
                            <h4 class="mb-1">
                                <span id="leftPropertyNameText">{{ $property->name }}</span>
                                <span id="leftPropertyCategoryText" class="fs-14 text-muted ms-1">({{ $property->category }})</span>
                            </h4>
                            <p id="leftPropertyAddressText" class="mb-1 text-muted fs-13">{{ $property->address }}</p>
                            <h5 class="text-dark fw-medium mt-3">Price :</h5>
                            <h4 id="leftPropertyPriceText" class="fw-semibold mt-2 text-primary">${{ number_format($property->price, 2) }}</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-light-subtle">
                        <div class="row g-2">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100">Update Property</button>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ route('property.list') }}" class="btn btn-danger w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ডান পাশের ইনফরমেশন কলাম -->
            <div class="col-xl-9 col-lg-8">
                <!-- ইমেজ আপলোড কার্ড (এডিট মোড সাপোর্টসহ ড্রপজোন) -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Property Photo</h4>
                    </div>
                    <div class="card-body">
                        <div class="bg-light-subtle py-5 text-center border border-dashed rounded position-relative"
                            id="customDropzone"
                            style="cursor: pointer; border-style: dashed !important; border-width: 2px !important;">

                            <input name="image" type="file" id="propertyImageInput" class="d-none" accept="image/*">

                            <!-- ডিফল্ট মেসেজ লজিক -->
                            <div id="defaultUploadMessage" class="{{ $property->image ? 'd-none' : '' }}">
                                <i class="ri-upload-cloud-2-line fs-48 text-primary"></i>
                                <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                <span class="text-muted fs-13">PNG, JPG and GIF files are allowed</span>
                            </div>

                            <!-- ইমেজ প্রিভিউ কন্টেইনার -->
                            <div class="{{ $property->image ? '' : 'd-none' }} p-2" id="imagePreviewContainer">
                                <div class="position-relative d-inline-block">
                                    <img id="imagePreview" src="{{ $property->image ? asset($property->image) : '' }}" alt="Property Preview"
                                        class="img-fluid rounded border shadow-sm"
                                        style="max-height: 200px; object-fit: cover;">
                                    <button type="button" id="removeImageBtn"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0"
                                        style="width: 24px; height: 24px; line-height: 20px; border: none;">×</button>
                                </div>
                                <div class="mt-2">
                                    <span id="fileNameDisplay" class="fw-medium text-success fs-13 d-block">
                                        {{ $property->image ? basename($property->image) : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- প্রোপার্টি ইনফরমেশন কার্ড -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Property Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- প্রোপার্টি নাম -->
                            <div class="col-lg-6 mb-3">
                                <label for="property-name" class="form-label">Property Name</label>
                                <input type="text" name="name" id="property-name" class="form-control" value="{{ old('name', $property->name) }}" required>
                            </div>

                            <!-- প্রোপার্টি ক্যাটাগরি -->
                            <div class="col-lg-6 mb-3">
                                <label for="property-categories" class="form-label">Property Categories</label>
                                <select class="form-control" id="property-categories" data-choices name="category" required>
                                    @foreach(['Villas', 'Residences', 'Bungalow', 'Apartment', 'Penthouse'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $property->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- প্রোপার্টি মূল্য -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20 px-2 py-0"><i class="ri-money-dollar-circle-line"></i></span>
                                    <input type="number" name="price" id="property-price" class="form-control" value="{{ old('price', $property->price) }}" required>
                                </div>
                            </div>

                            <!-- প্রোপার্টি ধরন -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-for" class="form-label">Property For</label>
                                <select class="form-control" id="property-for" data-choices name="property_for" required>
                                    <option value="Sale" {{ old('property_for', $property->property_for) == 'Sale' ? 'selected' : '' }}>Sale</option>
                                    <option value="Rent" {{ old('property_for', $property->property_for) == 'Rent' ? 'selected' : '' }}>Rent</option>
                                    <option value="Other" {{ old('property_for', $property->property_for) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <!-- বেডরুম সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-bedroom" class="form-label">Bedroom</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>
                                    <input type="number" name="bedroom" id="property-bedroom" class="form-control" value="{{ old('bedroom', $property->bedroom) }}">
                                </div>
                            </div>

                            <!-- বাথরুম সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-bathroom" class="form-label">Bathroom</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>
                                    <input type="number" name="bathroom" id="property-bathroom" class="form-control" value="{{ old('bathroom', $property->bathroom) }}">
                                </div>
                            </div>

                            <!-- স্কয়ার ফিট -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-square-foot" class="form-label">Square Foot</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                    <input type="number" name="sqft" id="property-square-foot" class="form-control" value="{{ old('sqft', $property->sqft) }}">
                                </div>
                            </div>

                            <!-- ফ্লোর সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-floor" class="form-label">Floor</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                    <input type="number" name="floor" id="property-floor" class="form-control" value="{{ old('floor', $property->floor) }}">
                                </div>
                            </div>

                            <!-- প্রোপার্টি ঠিকানা -->
                            <div class="col-lg-12 mb-3">
                                <label for="property-address" class="form-label">Property Address</label>
                                <textarea class="form-control" name="address" id="property-address" rows="3" required>{{ old('address', $property->address) }}</textarea>
                            </div>

                            <!-- জিপ কোড -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-zipcode" class="form-label">Zip-Code</label>
                                <input type="number" name="zip_code" id="property-zipcode" class="form-control" value="{{ old('zip_code', $property->zip_code) }}">
                            </div>

                            <!-- শহর (City) -->
                            <div class="col-lg-4 mb-3">
                                <label for="choices-city" class="form-label">City</label>
                                <select class="form-control" id="choices-city" data-choices name="city" required>
                                    <option value="">Choose a city</option>
                                    @foreach(['UK' => ['London', 'Manchester', 'Liverpool'], 'FR' => ['Paris', 'Lyon', 'Marseille'], 'US' => ['New York', 'Michigan']] as $countryCode => $cities)
                                        <optgroup label="{{ $countryCode }}">
                                            @foreach($cities as $c)
                                                <option value="{{ $c }}" {{ old('city', $property->city) == $c ? 'selected' : '' }}>{{ $c }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <!-- দেশ (Country) -->
                            <div class="col-lg-4 mb-3">
                                <label for="choices-country" class="form-label">Country</label>
                                <select class="form-control" id="choices-country" data-choices name="country" required>
                                    <option value="">Choose a country</option>
                                    @foreach(['United Kingdom', 'France', 'Netherlands', 'U.S.A', 'Canada', 'Germany'] as $ct)
                                        <option value="{{ $ct }}" {{ old('country', $property->country) == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- row end -->
                    </div> <!-- card-body end -->
                </div> <!-- card end -->
                <!-- নিচের সাবমিট বাটন গ্রুপ -->
                <div class="mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100">Update Product</button>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('property.list') }}" class="btn btn-danger w-100">Cancel</a>
                        </div>
                    </div>
                </div>
            </div> <!-- col-xl-9 end -->
        </div> <!-- row end -->
    </form>
@endsection

@section('script-bottom')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropzoneBox = document.getElementById('customDropzone');
            const fileInput = document.getElementById('propertyImageInput');
            const defaultMessage = document.getElementById('defaultUploadMessage');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            const removeBtn = document.getElementById('removeImageBtn');

            // লাইভ রিফ্লেকশন প্রিভিউ ইলিমেন্টস
            const leftImg = document.getElementById('leftPropertyPreviewImg');
            const leftName = document.getElementById('leftPropertyNameText');
            const leftCategory = document.getElementById('leftPropertyCategoryText');
            const leftAddress = document.getElementById('leftPropertyAddressText');
            const leftPrice = document.getElementById('leftPropertyPriceText');
            const leftBadge = document.getElementById('leftPropertyForBadge');

            // ১. ক্লিকে ফাইল ম্যানেজার ওপেন
            dropzoneBox.addEventListener('click', function(e) {
                if (e.target === removeBtn) return;
                fileInput.click();
            });

            // ২. ফাইল সিলেক্ট প্রিভিউ ও ডুয়াল সিঙ্ক
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    fileNameDisplay.textContent = file.name;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        leftImg.src = e.target.result;

                        defaultMessage.classList.add('d-none');
                        previewContainer.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // ৩. ইমেজ রিমুভ বাটন
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = ""; 
                previewContainer.classList.add('d-none');
                defaultMessage.classList.remove('d-none');
            });

            // ৪. ড্র্যাগ অ্যান্ড ড্রপ
            dropzoneBox.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('bg-primary-subtle'); });
            dropzoneBox.addEventListener('dragleave', function(e) { e.preventDefault(); this.classList.remove('bg-primary-subtle'); });
            dropzoneBox.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('bg-primary-subtle');
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });

            // ৫. রিয়েল-টাইম লাইভ টাইপিং প্রিভিউ
            document.getElementById('property-name').addEventListener('input', function() {
                leftName.textContent = this.value || 'Property Name';
            });
            document.getElementById('property-categories').addEventListener('change', function() {
                leftCategory.textContent = `(${this.value})`;
            });
            document.getElementById('property-address').addEventListener('input', function() {
                leftAddress.textContent = this.value || 'Property Address here...';
            });
            document.getElementById('property-price').addEventListener('input', function() {
                leftPrice.textContent = this.value ? `$${parseFloat(this.value).toLocaleString(undefined, {minimumFractionDigits: 2})}` : '$0.00';
            });
            document.getElementById('property-for').addEventListener('change', function() {
                leftBadge.textContent = `For ${this.value}`;
                leftBadge.className = this.value === 'Rent' ? 'badge bg-success text-light fs-13' : 'badge bg-warning text-light fs-13';
            });
        });
    </script>
@endsection
