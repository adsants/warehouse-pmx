<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    @yield('styles')
</head>

<body>

    <div id="wrapper">

       @include('backend.layouts.partials.sidebar')

        <!-- main content area start -->
        
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            @include('backend.layouts.partials.header')

            @yield('admin-content')
            </div>
        </div>
    </div>
    <!-- page container area end -->
    @include('backend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
