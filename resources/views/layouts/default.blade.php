<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IU_Back</title>
    <x-layer-components.style_common></x-layer-components.style_common>
    @vite('resources/js/app.js')
    <!-- Styles -->
    @stack('css')
</head>
<body>

<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include("components.layer-components.navbar_component")
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include("components.layer-components.sidebard_component")
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a
                                href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                                class="mdi mdi-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>


<x-layer-components.scripts_common></x-layer-components.scripts_common>
@stack('js')
</body>
</html>
