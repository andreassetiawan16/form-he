<!DOCTYPE html>

<html>
@include('skeleton.header')

<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  @include('skeleton.head')
  <!-- Left side column. contains the logo and sidebar -->
  @include('skeleton.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="display:flex; justify-content:space-between; align-items:center">
      <h1>
        @yield('title_page')
        {{-- <small>Optional description</small> --}}
      </h1>
      {{-- <ol class="breadcrumb"> --}}
        @yield('add_button')
        {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li> --}}
      {{-- </ol> --}}
    </section>

    <section class="content container-fluid">
      @yield('content')
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  @include('skeleton.rightsidebar')
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('skeleton.script')

</body>
</html>