<style>
  /* Sidebar Active & Hover Styling */
.sidebar .nav-item .nav-link {
    color: #6c757d;
    transition: all 0.2s ease-in-out;
}

.sidebar .nav-item .nav-link:hover {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.05);
}

.sidebar .nav-item.active .nav-link {
    color: #0d6efd;
    background-color: rgba(13, 110, 253, 0.1);
    font-weight: 600;
    border-left: 4px solid #0d6efd;
}

.sidebar .nav-category {
    font-size: 0.725rem;
    letter-spacing: 0.05rem;
}
</style>
<nav class="sidebar sidebar-offcanvas shadow-sm" id="sidebar">
    <ul class="nav flex-column">
        
        {{-- Section: Overview --}}
        <li class="nav-category text-uppercase small text-muted fw-bold px-3 pt-3 pb-2">
            Main
        </li>

        {{-- Dashboard --}}
        <li class="nav-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center py-2 px-3 rounded" 
               href="{{ route('admin.dashboard') }}"
               aria-current="{{ request()->routeIs('admin.dashboard*') ? 'page' : 'false' }}">
                <i class="mdi mdi-view-dashboard-outline menu-icon fs-5 me-3"></i>
                <span class="menu-title fw-medium">Dashboard</span>
            </a>
        </li>

        {{-- Section: Management --}}
        <li class="nav-category text-uppercase small text-muted fw-bold px-3 pt-4 pb-2">
            Catalog Management
        </li>

        {{-- Categories --}}
        <li class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center justify-content-between py-2 px-3 rounded" 
               href="{{ route('admin.categories.index') }}">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-shape-outline menu-icon fs-5 me-3"></i>
                    <span class="menu-title fw-medium">Categories</span>
                </div>
            </a>
        </li>

        {{-- Products --}}
        <li class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center justify-content-between py-2 px-3 rounded" 
               href="{{ route('admin.products.index') }}">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-package-variant-closed menu-icon fs-5 me-3"></i>
                    <span class="menu-title fw-medium">Products</span>
                </div>
                {{-- Optional: Add count badge if available --}}
                @if(isset($productCount))
                    <span class="badge bg-primary rounded-pill small">{{ $productCount }}</span>
                @endif
            </a>
        </li>

        {{-- Brands --}}
        <li class="nav-item {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">
            <a class="nav-link d-flex align-items-center justify-content-between py-2 px-3 rounded" 
               href="{{ route('admin.brands.index') }}">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-tag-text-outline menu-icon fs-5 me-3"></i>
                    <span class="menu-title fw-medium">Brands</span>
                </div>
            </a>
        </li>

    </ul>
</nav>