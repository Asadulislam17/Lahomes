@extends('layouts.vertical', ['title' => 'Add Property', 'subTitle' => 'Real Estate'])

@section('css')
    @vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
    <!-- ১টি মাত্র মেইন ফরম এবং ফাইল আপলোডের জন্য enctype যুক্ত করা হয়েছে -->
    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- লারাভেলের সিকিউরিটি টোকেন -->

        <div class="row">
            <!-- বাম পাশের প্রিভিউ কলাম -->
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <img src="/images/properties/p-1.jpg" alt="" class="img-fluid rounded bg-light">
                            <span class="position-absolute top-0 end-0 p-1">
                                <span class="badge bg-success text-light fs-13">For Rent</span>
                            </span>
                        </div>
                        <div class="mt-3">
                            <h4 class="mb-1">Dvilla Residences Batu<span class="fs-14 text-muted ms-1">(Residences)</span>
                            </h4>
                            <p class="mb-1">4604 , Philli Lane Kiowa U.S.A</p>
                            <h5 class="text-dark fw-medium mt-3">Price :</h5>
                            <h4 class="fw-semibold mt-2 text-muted">$8,930.00</h4>
                        </div>
                    </div>
                    <div class="card-footer bg-light-subtle">
                        <div class="row g-2">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100">Save Property</button>
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
                <!-- ইমেজ আপলোড কার্ড (আপনার আগের ড্রপজোন ডিজাইন) -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Property Photo</h4>
                    </div>
                    <div class="card-body">
                        <!-- মেইন আপলোড বক্স (এখানে ক্লিক করলেই ফাইল ম্যানেজার খুলবে) -->
                        <div class="bg-light-subtle py-5 text-center border border-dashed rounded position-relative"
                            id="customDropzone"
                            style="cursor: pointer; border-style: dashed !important; border-width: 2px !important;">

                            <!-- আসল লারাভেল ইনপুট ফিল্ড (লুকানো থাকবে) -->
                            <input name="image" type="file" id="propertyImageInput" class="d-none" accept="image/*"
                                required>

                            <!-- ডিফল্ট মেসেজ (ছবি সিলেক্ট করার আগে এটি দেখাবে) -->
                            <div id="defaultUploadMessage">
                                <i class="ri-upload-cloud-2-line fs-48 text-primary"></i>
                                <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to
                                        browse</span></h3>
                                <span class="text-muted fs-13">
                                    1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                </span>
                            </div>

                            <!-- ছবি সিলেক্ট করার পর এই বক্সের ভেতরেই আসল ছবি এবং নাম দেখাবে -->
                            <div class="d-none p-2" id="imagePreviewContainer">
                                <div class="position-relative d-inline-block">
                                    <!-- এখানে আসল ছবি শো করবে -->
                                    <img id="imagePreview" src="" alt="Property Preview"
                                        class="img-fluid rounded border shadow-sm"
                                        style="max-height: 200px; object-fit: cover;">
                                    <!-- রিমুভ করার জন্য ছোট বাটন -->
                                    <button type="button" id="removeImageBtn"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-0 style-none"
                                        style="width: 24px; height: 24px; line-height: 20px;">×</button>
                                </div>
                                <div class="mt-2">
                                    <span id="fileNameDisplay" class="fw-medium text-success fs-13 d-block"></span>
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
                                <input type="text" name="name" id="property-name" class="form-control"
                                    placeholder="Name" required>
                            </div>

                            <!-- প্রোপার্টি ক্যাটাগরি -->
                            <div class="col-lg-6 mb-3">
                                <label for="property-categories" class="form-label">Property Categories</label>
                                <select class="form-control" id="property-categories" data-choices name="category" required>
                                    <option value="Villas">Villas</option>
                                    <option value="Residences">Residences</option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Penthouse">Penthouse</option>
                                </select>
                            </div>

                            <!-- প্রোপার্টি মূল্য -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20 px-2 py-0"><i
                                            class="ri-money-dollar-circle-line"></i></span>
                                    <input type="number" name="price" id="property-price" class="form-control"
                                        placeholder="000" required>
                                </div>
                            </div>

                            <!-- প্রোপার্টি ধরন -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-for" class="form-label">Property For</label>
                                <select class="form-control" id="property-for" data-choices name="property_for" required>
                                    <option value="Sale">Sale</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <!-- বেডরুম সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-bedroom" class="form-label">Bedroom</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:bed-broken"
                                            class="align-middle"></iconify-icon></span>
                                    <input type="number" name="bedroom" id="property-bedroom" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <!-- বাথরুম সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-bathroom" class="form-label">Bathroom</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:bath-broken"
                                            class="align-middle"></iconify-icon></span>
                                    <input type="number" name="bathroom" id="property-bathroom" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <!-- স্কয়ার ফিট -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-square-foot" class="form-label">Square Foot</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon icon="solar:scale-broken"
                                            class="align-middle"></iconify-icon></span>
                                    <input type="number" name="sqft" id="property-square-foot" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <!-- ফ্লোর সংখ্যা -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-floor" class="form-label">Floor</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-20"><iconify-icon
                                            icon="solar:double-alt-arrow-up-broken"
                                            class="align-middle"></iconify-icon></span>
                                    <input type="number" name="floor" id="property-floor" class="form-control"
                                        placeholder="0">
                                </div>
                            </div>

                            <!-- প্রোপার্টি ঠিকানা -->
                            <div class="col-lg-12 mb-3">
                                <label for="property-address" class="form-label">Property Address</label>
                                <textarea class="form-control" name="address" id="property-address" rows="3" placeholder="Enter address"
                                    required></textarea>
                            </div>

                            <!-- জিপ কোড -->
                            <div class="col-lg-4 mb-3">
                                <label for="property-zipcode" class="form-label">Zip-Code</label>
                                <input type="number" name="zip_code" id="property-zipcode" class="form-control"
                                    placeholder="zip-code">
                            </div>

                            <!-- শহর (City) -->
                            <div class="col-lg-4 mb-3">
                                <label for="choices-city" class="form-label">City</label>
                                <select class="form-control" id="choices-city" data-choices name="city" required>
                                    <option value="">Choose a city</option>
                                    <optgroup label="UK">
                                        <option value="London">London</option>
                                        <option value="Manchester">Manchester</option>
                                        <option value="Liverpool">Liverpool</option>
                                    </optgroup>
                                    <optgroup label="FR">
                                        <option value="Paris">Paris</option>
                                        <option value="Lyon">Lyon</option>
                                        <option value="Marseille">Marseille</option>
                                    </optgroup>
                                    <optgroup label="US">
                                        <option value="New York">New York</option>
                                        <option value="Michigan">Michigan</option>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- দেশ (Country) -->
                            <div class="col-lg-4 mb-3">
                                <label for="choices-country" class="form-label">Country</label>
                                <select class="form-control" id="choices-country" data-choices name="country" required>
                                    <option value="">Choose a country</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="France">France</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="U.S.A">U.S.A</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Germany">Germany</option>
                                </select>
                            </div>
                        </div> <!-- row end -->
                    </div> <!-- card-body end -->
                </div> <!-- card end -->

                <!-- নিচের সাবমিট বাটন গ্রুপ -->
                <div class="mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100">Create Product</button>
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

            // ১. বাক্সের যেকোনো জায়গায় ক্লিক করলেই ফাইল ম্যানেজার খুলবে
            dropzoneBox.addEventListener('click', function(e) {
                // যদি ইউজার রিমুভ বাটনে ক্লিক করে তবে ফাইল ম্যানেজার খুলবে না
                if (e.target === removeBtn) return;
                fileInput.click();
            });

            // ২. ফাইল সিলেক্ট করার পর বাক্সের ভেতরের লেখা লুকিয়ে আসল ছবি দেখাবে
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    fileNameDisplay.textContent = file.name;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;

                        // ডিফল্ট লেখা লুকাবে এবং ছবি শো করবে
                        defaultMessage.classList.add('d-none');
                        previewContainer.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // ৩. রিমুভ বাটনে ক্লিক করলে ছবি মুছে আবার আগের মতো করে দেবে
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // বাক্সের ক্লিকে যেন আবার ফাইল ম্যানেজার না খোলে
                fileInput.value = ""; // ইনপুট খালি করবে

                // ছবি লুকাবে এবং ডিফল্ট লেখা ফিরিয়ে আনবে
                previewContainer.classList.add('d-none');
                defaultMessage.classList.remove('d-none');
            });

            // ৪. ড্র্যাগ অ্যান্ড ড্রপ সাপোর্ট
            dropzoneBox.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('bg-primary-subtle');
            });
            dropzoneBox.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('bg-primary-subtle');
            });
            dropzoneBox.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('bg-primary-subtle');
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });
        });
    </script>
@endsection
