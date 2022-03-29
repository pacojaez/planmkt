<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta name="viewport" content="width=device-width" />

  <!-- Favicon and title -->
  <link rel="icon" href="path/to/fav.png">
  <title>My Marketing Planner</title>

  <!-- Halfmoon CSS -->
  <link href="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/css/halfmoon-variables.min.css" rel="stylesheet" />

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
  <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars" data-dm-shortcut-enabled="true" data-sidebar-shortcut-enabled="true" data-set-preferred-mode-onload="true">
  <!-- Modals go here -->
  <!-- Reference: https://www.gethalfmoon.com/docs/modal -->
  @include('components.modal')

  <!-- Page wrapper start -->
  <div class="page-wrapper with-navbar with-sidebar with-navbar-fixed-bottom">

    <!-- Sticky alerts (toasts), empty container -->
    <!-- Reference: https://www.gethalfmoon.com/docs/sticky-alerts-toasts -->
    <div class="sticky-alerts"></div>

    @include('components.navigation')

    @include('components.sidebar')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        @yield('content')
      <!--
        Add your page's main content here
        Examples:
        1. https://www.gethalfmoon.com/docs/content-and-cards/#building-a-page
        2. https://www.gethalfmoon.com/docs/grid-system/#building-a-dashboard
      -->
    </div>
    <!-- Content wrapper end -->

    <!-- Navbar fixed bottom start -->
    <nav class="navbar navbar-fixed-bottom">
      <!-- Reference: https://www.gethalfmoon.com/docs/navbar#navbar-fixed-bottom -->
    </nav>
    <!-- Navbar fixed bottom end -->

  </div>
  <!-- Page wrapper end -->

  <!-- Halfmoon JS -->
  <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
  @stack('scripts')
  @livewireScripts
</body>
</html>
