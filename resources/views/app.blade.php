<!DOCTYPE html>

<html>

@include('partials.htmlheader')

<body class="skin-red sidebar-mini">
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

</body>
</html>
