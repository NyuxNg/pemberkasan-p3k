<!DOCTYPE html>
<html>
   @include('template.backend.head')
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         @include('template.backend.main-header')
         <!-- Left side column. contains the logo and sidebar -->
         @include('template.backend.main-sidebar')
         <!-- Content Wrapper. Contains page content -->
         @yield('content-wrapper')
         <!-- /.content-wrapper -->
         @include('template.backend.footer')
      </div>
      <!-- ./wrapper -->
      @include('template.backend.foot')
   </body>
</html>