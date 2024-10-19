<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ProgresMax Warehouse - App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.partials.styles')
    @yield('styles')
</head>

<body>

    <div id="wrapper">

        @guest
        @else
            @include('layouts.partials.sidebar')
        @endguest
        <!-- main content area start -->
        
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('layouts.partials.header')

            @yield('content')
            </div>
        </div>
    </div>
    <!-- page container area end -->
    @include('layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
