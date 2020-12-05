<!DOCTYPE html>
<html>
@include('template.frontend.head')
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        @include('template.frontend.header')
        <!-- Full Width Column -->
        @yield('content-wrapper')
        <!-- /.content-wrapper -->
        @include('template.frontend.footer')
    </div>
    <!-- ./wrapper -->
    @include('template.frontend.foot')
</body>
</html>