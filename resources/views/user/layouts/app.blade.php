<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BizLand Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('/')}}templateimg/favicon.png" rel="icon">
  <link href="{{asset('/')}}templateimg/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('/')}}vendor/aos/aos.css" rel="stylesheet">
  <link href="{{asset('/')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('/')}}vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('/')}}vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('/')}}vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{asset('/')}}vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('/')}}css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.7.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('user.components.topbar')

  @include('user.components.header')  

  @include('user.components.hero')  

  <main id="main">

    @include('user.components.main_featuredservice')

    @include('user.components.main_about')

    @include('user.components.main_skill')

    @include('user.components.main_counts')

    @include('user.components.main_clients')

    @include('user.components.main_services')

    @include('user.components.main_testimonials')

    @include('user.components.main_portfolio')

    @include('user.components.main_team')

    @include('user.components.main_pricing')

    @include('user.components.main_faq')

    @include('user.components.main_contact')      

  </main><!-- End #main -->

  @include('user.components.footer')


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('/')}}vendor/purecounter/purecounter.js"></script>
  <script src="{{asset('/')}}vendor/aos/aos.js"></script>
  <script src="{{asset('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('/')}}vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset('/')}}vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{asset('/')}}vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('/')}}vendor/waypoints/noframework.waypoints.js"></script>
  <script src="{{asset('/')}}vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('/')}}js/main.js"></script>

</body>

</html>