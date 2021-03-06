<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">
  <title>Data Mate</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="<?php echo url('/'); ?>/css/dashboard.css" rel="stylesheet">
  <link href="<?php echo url('/'); ?>/css/style.css" rel="stylesheet">

  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/9d093081ee.js" crossorigin="anonymous"></script>

  
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
   
 </head>

<body class="dashboard-body" style="font-family: 'Montserrat', sans-serif;">
  <nav class="navbar sticky-top flex-md-nowrap p-0 navbar-custom">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 logo" href="#">MILKWAY</a>
    <ul class="nav justify-content-end mr-3">
      <li class="nav-item mr-3" style="padding: 5px; color: #4d384b;">
        <span><a href="{{ route('settings.index') }}">Setting</a></span>
      </li>
      <li class="nav-item mr-3" style="padding: 5px; color: #4d384b;">
        <span>Welcome, {{ Auth::user()->name }}</span>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submmit" class="btn btn-sm btn-kelu">Log Out</button>
        </form>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column" style="margin-top: 19%;">
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('home') }}" style="text-align: center;">
                <!-- nav-active -->
                <img src="<?php echo url('/'); ?>/img/dashboard.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Dashboard </span> 
              </a>
            </li>
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('customers.index') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/student.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Customers </span> 
              </a>
            </li>
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('products.index') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/library.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Products </span> 
              </a>
            </li>
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('sales_vouchers.create') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/homework.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Sales Vouchers </span> 
              </a>
            </li>
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('payment_vouchers.index') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/calendar.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Payment Vouchers </span> 
              </a>
            </li>
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('sales_vouchers.report_filter') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/stream.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Report </span> 
              </a>
            </li>
            <!--<li class="nav-item p-1">
              <a class="nav-link" href="" style="text-align: center;">
                <img src="/img/library.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Semester </span> 
              </a>
            </li>-->
            <li class="nav-item p-1">
              <a class="nav-link" href="{{ route('users.index') }}" style="text-align: center;">
                <img src="<?php echo url('/'); ?>/img/user.png" style="height: 40px;"><br/>
                <span style=" color: #FEFEFE; font-size: 14px;">  Users </span> 
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        @yield ('content')
      </main>
    </div>
  </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>
    @yield ('JS_Code')
</body>
</html>