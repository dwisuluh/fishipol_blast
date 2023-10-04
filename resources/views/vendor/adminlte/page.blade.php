@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
  @stack('css')
  @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
  <div class="wrapper">

    {{-- Preloader Animation --}}
    @if ($layoutHelper->isPreloaderEnabled())
      @include('adminlte::partials.common.preloader')
    @endif

    {{-- Top Navbar --}}
    @if ($layoutHelper->isLayoutTopnavEnabled())
      @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
      @include('adminlte::partials.navbar.navbar')
    @endif

    {{-- Left Main Sidebar --}}
    @if (!$layoutHelper->isLayoutTopnavEnabled())
      @include('adminlte::partials.sidebar.left-sidebar')
    @endif

    {{-- Content Wrapper --}}
    @empty($iFrameEnabled)
      @include('adminlte::partials.cwrapper.cwrapper-default')
    @else
      @include('adminlte::partials.cwrapper.cwrapper-iframe')
    @endempty

    {{-- Footer --}}
    @hasSection('footer')
      @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if (config('adminlte.right_sidebar'))
      @include('adminlte::partials.sidebar.right-sidebar')
    @endif

  </div>
@stop

@section('adminlte_js')
  @stack('js')
  <script>
    $(function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    });
  </script>
  @yield('js')
@stop
