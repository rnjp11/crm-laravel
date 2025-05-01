<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Crocs admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Crocs admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('public/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" type="image/x-icon">
    <title>CRM</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}">
    <!-- ico-font-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/icofont.css') }}">

    <!-- Themify icon-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/themify.css') }}">

    <!-- Flag icon-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/flag-icon.css') }}">

    <!-- Feather icon-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/feather-icon.css') }}">

    <!-- Plugins css start-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/slick.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick-theme.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/slick-theme.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/scrollbar.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/animate.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/datatables.css') }}">

    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/vendors/bootstrap.css') }}">

    <!-- App css-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/style.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">

    {{-- <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/color-1.css') }}">

    <!-- Responsive css-->
    {{-- <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css"> --}}
    <link rel="stylesheet" href="{{ asset('resources/css/responsive.css') }}">
    <!-- Latest Font Awesome 6.5 (Already in your code) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    


    <style>
        .ecommerce-dashboard div.dataTables_wrapper div.dataTables_filter {
            position: absolute;
            top: 40px;
            /* Adjust vertically as needed */
            right: 20px;
            /* Adjust horizontally as needed */
            z-index: 10;
        }

        /* ✅ Make header cell relative to position arrows inside */
        table.dataTable thead>tr>th {
            position: relative;
        }

        /* ✅ HIDE unwanted default arrows from :after */
        table.dataTable.table thead th.sorting:after,
        table.dataTable.table thead th.sorting_asc:after,
        table.dataTable.table thead th.sorting_desc:after,
        table.dataTable.table thead td.sorting:after,
        table.dataTable.table thead td.sorting_asc:after,
        table.dataTable.table thead td.sorting_desc:after {
            display: none !important;
        }

        /* ✅ CUSTOM sorting arrows using :before */
        table.dataTable thead>tr>th.sorting:before,
        table.dataTable thead>tr>th.sorting_asc:before,
        table.dataTable thead>tr>th.sorting_desc:before,
        table.dataTable thead>tr>th.sorting_asc_disabled:before,
        table.dataTable thead>tr>th.sorting_desc_disabled:before,
        table.dataTable thead>tr>td.sorting:before,
        table.dataTable thead>tr>td.sorting_asc:before,
        table.dataTable thead>tr>td.sorting_desc:before,
        table.dataTable thead>tr>td.sorting_asc_disabled:before,
        table.dataTable thead>tr>td.sorting_desc_disabled:before {
            position: absolute;
            top: 50%;
            right: 8px;
            transform: translateY(-50%);
            content: "▲";
            font-size: 10px;
            color: #333;
        }

        /* ✅ Descending sort arrow */
        table.dataTable thead>tr>th.sorting_desc:before,
        table.dataTable thead>tr>td.sorting_desc:before {
            content: "▼";
        }

        <style>

        /* 🔍 Search input height */
        div.dataTables_filter input {
            padding: 4px 8px;
            font-size: 13px;
            height: 30px;
        }

        /* 📋 Length menu select box */
        div.dataTables_length select {
            padding: 4px 8px;
            font-size: 13px;
            height: 30px;
        }

        /* Optionally: reduce spacing between label and inputs */
        div.dataTables_filter,
        div.dataTables_length {
            margin-bottom: 10px;
            /* or less if needed */
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-left: 15px !important;
            border: none;
            align-items: center;
            padding-top: 0;
        }


        /* General pagination container styling */
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        /* Pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #f4f4ff;
            border: none !important;
            color: #4f46e5;
            /* Indigo-600 */
            padding: 8px 12px;
            margin: 0 2px;
            cursor: pointer;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Hover effect */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        /* Active page */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #e0e7ff;
            color: #3730a3;
            font-weight: 700;
        }

        /* Disable previous/next when inactive */
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .dataTables_wrapper button {
            font-size: 14px;
            font-weight: 500;
            background-color: #F5F6F9;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .ecommerce-dashboard div.dataTables_wrapper table.dataTable tbody>tr>td:nth-child(5) .btn {
            border-radius: 5px;
            padding: 3px 10px;
            min-width: 10px;
        }
    </style>

</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid for-light" src="{{ asset('public/images/logo/logo-1.png') }}"
                                alt="">
                            <img class="img-fluid for-dark" src="{{ asset('public/images/logo/logo.png') }}"
                                height="10" alt="">
                        </a>
                    </div>
                    <div class="toggle-sidebar">
                        <i class="fas fa-bars mt-2 p-2" style="font-size: 20px"></i>
                    </div>
                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        <li>
                            <div class="mode">
                                <i class="fa fa-cog" style="font-size: 20px;"></i>
                            </div>
                        </li>

                        <li class="profile-nav onhover-dropdown p-0">
                            <div class="d-flex align-items-center profile-media mt-2    ">
                                <div class="flex-grow-1 ">
                                    <span class="mb-0">{{ session('username') ?? 'User' }}</span>
                                    <p>{{ session('useremail') ?? 'Email' }}</p>

                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="{{ route('logout') }}"><i data-feather="log-out"> </i><span>Log
                                            out</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            {{-- <div class="ProfileCard-realName">{{name}}</div> --}}
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" data-layout="fill-svg">
                <div>
                    <div class="logo-wrapper">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('public/images/logo/logo.png') }}" width="120"
                                height="120">
                        </a>
                        <div class="toggle-sidebar">
                            <i class="fas fa-bars" style="color:white; font-size: 20px;"></i>
                        </div>
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('public/image/logo/logo-icon.png') }}"
                                alt="">
                        </a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid"
                                            src="{{ asset('public/image/logo/logo-icon.png') }}" alt=""
                                            height="80"></a>
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
                                        <i class="fas fa-chart-line" style="color: #a0a7c0"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                @if (session('roleid') == 2)
                                    <li class="sidebar-list">
                                        <i class="fa fa-thumb-tack"> </i>
                                        <a class="sidebar-link sidebar-title link-nav"
                                            href="{{ route('user.index') }}">
                                            <i class="fas fa-user" style="color: #a0a7c0"></i>
                                            <span>Users</span>
                                        </a>
                                    </li>
                                @endif

                                <li class="sidebar-list">
                                    <i class="fa fa-thumb-tack"> </i>
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('service.index') }}">
                                        <i class="fas fa-cog" style="color: #a0a7c0"></i>
                                        <span>Services</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <i class="fa fa-thumb-tack"> </i>
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('reference.index') }}">
                                        <i class="fas fa-address-book" style="color: #a0a7c0"></i>
                                        <span>References</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <i class="fa fa-thumb-tack"> </i>
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('city.index') }}">
                                        <i class="fas fa-map" style="color: #a0a7c0"></i>
                                        <span>Cities</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <i class="fa fa-thumb-tack"> </i>
                                    <a class="sidebar-link sidebar-title link-nav"
                                        href="{{ route('enquiry.index') }}">
                                        <i class="fas fa-comment" style="color: #a0a7c0"></i>
                                        <span>Enquiry</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            {{-- Page Body --}}
            @yield('content')
            {{-- Page body ends --}}
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 p-0 footer-copyright">
                            <p class="mb-0">Copyright 2024 © <a href="https://ivisiontraining.in/">ivision</a></p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('resources/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('resources/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('resources/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('resources/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('resources/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('resources/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('resources/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('resources/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('resources/js/sidebar-pin.js') }}"></script>
    <script src="{{ asset('resources/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('resources/js/slick/slick.js') }}"></script>
    <script src="{{ asset('resources/js/header-slick.js') }}"></script>
    <script src="{{ asset('resources/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('resources/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('resources/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('resources/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('resources/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('resources/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('resources/js/datatable/datatables/datatable.custom1.js') }}"></script>
    <script src="{{ asset('resources/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('resources/js/animation/wow/wow.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('resources/js/script.js') }}"></script>
    <script src="{{ asset('resources/js/theme-customizer/customizer.js') }}"></script>
    <!-- Plugin used-->
    <script>
        new WOW().init();
    </script>
</body>

</html>
