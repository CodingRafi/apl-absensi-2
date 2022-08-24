<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="/template/vendors/feather/feather.css">
    <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="shortcut icon" href="/template/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        @include('mypartials.navbar')
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

            <!-- partial:partials/_settings-panel.html -->
            @include('mypartials.settings-panel')
            <!-- partial -->

            <!-- partial:partials/_sidebar.html -->
            @include('mypartials.aside')
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('container')
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="/template/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/template/vendors/chart.js/Chart.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/template/js/off-canvas.js"></script>
    <script src="/template/js/hoverable-collapse.js"></script>
    <script src="/template/js/template.js"></script>
    <script src="/template/js/settings.js"></script>
    <script src="/template/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/template/js/dashboard.js"></script>
    <script src="/template/js/Chart.roundedBarCharts.js"></script>
    <script src="/template/js/chart.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
