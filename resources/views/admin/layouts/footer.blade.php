<!-- BEGIN: Footer-->
<footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy; {{date('Y')}}</span></div>
    </div>
</footer>

<!-- BEGIN: Custom JS-->
<script src="{{ url('assets/js/main/jquery.min.js') }}"></script>
<script src="{{ url('assets/js/vendors.min.js') }}"></script>
<script src="{{ url('assets/js/selects/select2.min.js') }}"></script>
<script src="{{ url('assets/vendors/select2/select2.full.min.js') }}"></script>
{{-- <script src="{{ url('assets/js/noty/noty.min.js')}}"></script> --}}
<script src="{{ asset('assets/js/plugins/notifications/noty.min.js') }}"></script>
<script src="{{ url('assets/js/snackbar/snackbar.min.js') }}"></script>
<script src="{{ url('assets/js/waitme/waitMe.min.js') }}"></script>
<script src="{{ url('assets/vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/js/plugins.js') }}"></script>
<script src="{{ url('assets/js/search.js') }}"></script>
<script src="{{ url('assets/js/custom/custom-script.js') }}"></script>
<script src="{{ url('assets/js/scripts/customizer.js')}}"></script>
<script src="{{ url('assets/js/scripts/form-select2.js')}}"></script>
<script src="{{ url('assets/js/scripts/data-tables.js')}}"></script>
<script src="{{ url('assets/vendors/data-tables/js/dataTables.select.min.js') }}"></script>
<script src="{{ url('assets/vendors/quill/katex.min.js') }}"></script>
<script src="{{ url('assets/vendors/quill/highlight.min.js') }}"></script>
<script src="{{ url('assets/vendors/quill/quill.min.js') }}"></script>
<script src="{{ url('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/vendors/chartjs/chart.min.js') }}"></script>
<script src="{{ url('assets/js/scripts/dashboard-ecommerce.js') }}"></script>
<script src="{{ url('assets/js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ url('assets/js/custom.js')}}"></script>


@stack('js')
<!-- END: Custom JS-->
</body>

</html>