@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Top Header / Action Bar --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 fw-bold text-dark mb-1">Create Product</h2>
            <p class="text-muted small mb-0">Add a new item to your inventory catalog.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Inventory</span>
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check fs-5 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <div class="d-flex align-items-center mb-2">
                <i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i>
                <strong class="me-auto">Please correct the following errors:</strong>
            </div>
            <ul class="mb-0 ps-4 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Main Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-bold text-primary mb-0">Product Details</h5>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">Back</a>
        </div>
        
        <div class="card-body p-4">

            {{-- Category Filter Trigger (Preserved Original Form) --}}
            <form action="{{ route('admin.products.create') }}" method="GET" enctype="multipart/form-data" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-semibold">Select Category</label>
                        <select name="category_id" id="category_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $selectedCategoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <noscript><button type="submit" class="btn btn-sm btn-secondary mt-2">Filter Brands</button></noscript>
                    </div>
                </div>
            </form>

            <hr class="my-4 text-muted">

            {{-- Main Product Creation Form --}}
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category_id" value="{{ $selectedCategoryId }}">

                {{-- Basic Product Information --}}
                <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-info-circle me-1"></i> Basic Details</h6>
                <div class="row g-3 mb-4">
                    
                    {{-- Brand Dropdown (Preserved Original Logic) --}}
                    <div class="col-md-4">
                        <label for="brand_id" class="form-label fw-semibold">Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" {{ $brands->isEmpty() ? 'disabled' : '' }} required>
                            <option value="">
                                {{ empty($selectedCategoryId) ? '-- Select Category First --' : '-- Select Brand --' }}
                            </option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Name --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Purchase Price --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Price *</label>
                        <input type="number" step="any" name="price" value="{{ old('price', '1') }}" class="form-control @error('price') is-invalid @enderror">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Status *</label>
                        <select name="Status" class="form-select @error('Status') is-invalid @enderror">
                            <option value="0" {{ old('Status', 0) == 0 ? 'selected' : '' }}>0: General</option>
                            <option value="1" {{ old('Status') == 1 ? 'selected' : '' }}>1: Actual</option>
                        </select>
                        @error('Status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Vehicle Specifications --}}
                <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-car me-1"></i> Specifications</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chassis Number</label>
                        <input type="text" name="ChassisNumber" value="{{ old('ChassisNumber') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Engine Number</label>
                        <input type="text" name="EngineNumber" value="{{ old('EngineNumber') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Color</label>
                        <input type="text" name="Color" value="{{ old('Color') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Year</label>
                        <input type="text" name="Year" value="{{ old('Year') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">CC</label>
                        <input type="number" name="CC" value="{{ old('CC') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">WD</label>
                        <input type="text" name="WD" value="{{ old('WD') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Transmission</label>
                        <input type="text" name="Transmission" value="{{ old('Transmission') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">ODO Meter</label>
                        <input type="text" name="ODOMeter" value="{{ old('ODOMeter') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Auction Grade</label>
                        <input type="text" name="AuctionGrade" value="{{ old('AuctionGrade') }}" class="form-control">
                    </div>
                </div>

                {{-- Logistics & Sourcing --}}
                <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-truck-ramp-box me-1"></i> Logistics & Sourcing</h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <input type="text" name="Supplier" value="{{ old('Supplier') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Pickup Yard</label>
                        <input type="text" name="PickupYard" value="{{ old('PickupYard') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Score</label>
                        <input type="text" name="Score" value="{{ old('Score') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Invoice Number</label>
                        <input type="text" name="InvoiceNumber" value="{{ old('InvoiceNumber') }}" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Remarks</label>
                        <textarea name="Remarks" class="form-control" rows="3">{{ old('Remarks') }}</textarea>
                    </div>
                </div>

                {{-- Save Button --}}
                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <button type="submit" class="btn btn-primary px-4" {{ empty($selectedCategoryId) ? 'disabled' : '' }}>
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection