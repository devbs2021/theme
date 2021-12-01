<!DOCTYPE html>
<html>

<head>
    @include('theme::layouts.head')
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">
        @include('theme::layouts.nav')
        @include('theme::layouts.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('theme::layouts.footer')
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    @include('theme::layouts.script')
    @if(Session::has('success'))
    <script>
        $(function(){
    toastr.success('{{ Session::get("success") }}');
    });
    </script>
    @endif
    @if(Session::has('error'))
    <script>
        $(function(){
    toastr.error('{{ Session::get("error") }}');
    });
    </script>
    @endif
    @stack('js')

</body>

</html>