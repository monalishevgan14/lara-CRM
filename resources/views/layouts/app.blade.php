<!DOCTYPE html>
<html>
<head>
    <title>CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

          .card {
            border-radius: 12px;
        }

        .table thead th {
            font-weight: 500;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .pagination {
            margin-bottom: 0;
        }

        /* ===== Top Navbar ===== */
        .top-navbar {
            height: 60px;
            background: #ffffff;
            border-bottom: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            left: 230px;
            right: 0;
            z-index: 1000;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1e293b;
            color: white;
            padding-top: 20px;
            overflow-y: auto;
        }

        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: white;
        }

        /* ===== Main Content ===== */
        .main-content {
            margin-left: 230px;
            margin-top: 60px;
            padding: 30px;
        }

        /* Responsive */
        @media(max-width: 768px) {
            .sidebar {
                display: none;
            }

            .top-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }


        .pagination {
            margin-bottom: 0;
            margin-left: 10px !important;
        }
    </style>
</head>

<body>

<!-- 🟢 SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center text-white mb-4">CRM</h5>
    <!-- Brand -->
    {{-- <a class="navbar-brand fw-bold text-primary" href="{{ url('/dashboard') }}">
        CRM
    </a> --}}


    <a href="{{ url('/dashboard') }}"
       class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <a href="{{ route('products.index') }}"
       class="{{ request()->is('products*') ? 'active' : '' }}">
        <i class="bi bi-box-seam me-2"></i> Products
    </a>

    <a href="{{ route('products.create') }}"
       class="{{ request()->is('products/create') ? 'active' : '' }}">
        <i class="bi bi-plus-circle me-2"></i> Add Product
    </a>

    <a href="{{ route('bulk-products') }}"
       class="{{ request()->is('bulk-products') ? 'active' : '' }}">
        <i class="bi bi-upload me-2"></i> Bulk Product
    </a>

    <a href="{{ route('products.trash') }}"
       class="{{ request()->is('products.trash') ? 'active' : '' }}">
        <i class="bi bi-trash me-2"></i> Trash Product
    </a>
</div>

<!-- 🔵 TOP NAVBAR -->
{{-- <nav class="navbar navbar-expand-lg top-navbar px-4">
    <div class="container-fluid">

        <div class="ms-auto d-flex align-items-center">

            <a href="#" class="nav-link me-3 text-dark">
                <i class="bi bi-person-check"></i> User Activation
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   href="#"
                   id="profileDropdown"
                   data-bs-toggle="dropdown">

                    <img src="https://ui-avatars.com/api/?name=M&background=0D6EFD&color=fff"
                         class="rounded-circle me-2"
                         width="35"
                         height="35">

                    <span class="fw-semibold text-dark">Monali</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-lg top-navbar px-4">
    <div class="container-fluid">

        <!-- LEFT SIDE : Page Title -->
        {{-- <div class="d-flex align-items-center">
            <h4 class="mb-0 fw-semibold text-dark fw-bold">
                @yield('page_title', 'Dashboard')
            </h4>
        </div> --}}


        <!-- RIGHT SIDE -->
        <div class="ms-auto d-flex align-items-center">

            <a href="#" class="nav-link me-3">
                <i class="bi bi-person-check"></i> User Activation
            </a>

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   href="#"
                   id="profileDropdown"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">

                    <img src="https://ui-avatars.com/api/?name=M&background=0D6EFD&color=fff"
                         class="rounded-circle me-2"
                         width="35"
                         height="35">

                    <span class="fw-semibold text-dark">Monali</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item text-danger" href="#">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>


<!-- 🔶 MAIN CONTENT -->
<div class="main-content">
    {{-- <div class="d-flex align-items-center mb-3">
        <h3 class="mb-0 fw-semibold text-dark fw-bold ">
            @yield('page_title', 'Dashboard')
        </h3>
    </div> --}}

<div class="d-flex justify-content-between align-items-center mb-4 px-3">

    <!-- Left Side → Page Title -->
    <h3 class="mb-0 text-dark">
        @yield('page_title', 'Dashboard')
    </h3>

    <!-- Right Side → Back Button (Optional)  btn-secondary-->
    @hasSection('back_url')
        <a href="@yield('back_url')" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    @endif

</div>



    @yield('content')
</div>

@stack('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
