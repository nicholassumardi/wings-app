<!-- END: Footer-->
<script src=".{{ url('assets/js/main/jquery.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<script src="{{ url('assets/js/vendors.min.js') }}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ url('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/vendors/chartjs/chart.min.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{ url('assets/js/plugins.js') }}"></script>
<script src="{{ url('assets/js/search.js') }}"></script>
<script src="{{ url('assets/js/custom/custom-script.js') }}"></script>
<script src=".{{ url('assets/js/scripts/ui-alerts.js') }}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->

@stack('js')
<!-- END PAGE LEVEL JS-->
</body>

</html>