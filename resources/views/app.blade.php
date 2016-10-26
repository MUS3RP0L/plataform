<!DOCTYPE html>

<html>

    @include('partials.htmlheader')
    <body class="hold-transition skin-green sidebar-collapse sidebar-mini">
    {{-- <body class="skin-green sidebar-mini fixed hold-transition sidebar-collapse"> --}}
    <!-- <body class="skin-green sidebar-mini fixed wysihtml5-supported sidebar-collapse"> -->
        <div class="wrapper">

            @include('partials.mainheader')

            @include('partials.sidebar')

            <div class="content-wrapper">

                @include('partials.contentheader')

                <section class="content">

                    @yield('main-content')

                </section>

            </div>

            @include('partials.controlsidebar')

            @include('partials.footer')

        </div>

        @include('partials.scripts')

        @yield('scripts')

    </body>
</html>
