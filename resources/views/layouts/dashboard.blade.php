<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
<head>
        <meta charset="UTF-8">
        <title>Pick Admin</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">        
        <link rel="stylesheet" href="{{ asset('assets/vendors/flags-icon/css/flag-icon.min.css') }}">         
        <!-- END Template CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="{{ asset('assets/vendors/morris/morris.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/vendors/weather-icons/css/pe-icon-set-weather.min.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/vendors/starrr/starrr.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/ionicons/css/ionicons.min.css') }}"> 
        <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css') }}">
        
        
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatable/css/dataTables.bootstrap4.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatable/buttons/css/buttons.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-bs4.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('assets//vendors/select2/css/select2.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets//vendors/select2/css/select2-bootstrap.min.css') }}"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert/sweetalert.css') }}">
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <!-- END: Custom CSS-->
        @livewireStyles
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        <!-- START: Pre Loader-->
        {{-- <div class="se-pre-con">
            <div class="loader"></div>
        </div> --}}
        <!-- END: Pre Loader-->

        <!-- START: Header-->
            @include('dashboard.partials.header')
        <!-- END: Header-->

        <!-- START: Main Menu-->
            @include('dashboard.partials.sidebar')
        <!-- END: Main Menu-->

        <!-- START: Main Content-->
        <main>
            <div class="container-fluid site-width">
                @yield('content')
            </div>
        </main>
        <!-- END: Content-->
        <!-- START: Footer-->
            @include('dashboard.partials.footer')
            <!-- END: Footer-->
            
            
        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->
        @livewireScripts
        <!-- START: Template JS-->
        <script>
            var asset_url = "{{ asset('') }}";
        </script>
        <script src="{{ asset('assets/vendors/jquery/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>    
        <script src="{{ asset('assets/vendors/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- END: Template JS-->

        <script>
            function intTooltip(){
                $('[data-toggle="tooltip"]').tooltip();
            }
            function intSummernote(){
                $('.summernote').summernote({
                    height: 100,
                    airMode:0,
                    callbacks: {
                        onPaste: function(e) {
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            
                            // Automatically create a link if the pasted text is a URL
                            if (bufferText.match(/https?:\/\/[^\s]+/)) {
                                document.execCommand('insertHTML', false, '<a href="' + bufferText + '" target="_blank">' + bufferText + '</a>');
                            } else {
                                document.execCommand('insertText', false, bufferText);
                            }
                        },
                        onImageUpload: function(files) {
                            // Upload image via AJAX
                            var data = new FormData();
                            data.append('file', files[0]);
                            $.ajax({
                                url: '{{ route("image.upload") }}',  // Your Laravel route
                                method: 'POST',
                                data: data,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    // Insert the image URL into the editor
                                    console.log(response);
                                    
                                    $('.summernote').summernote('insertImage', response.url);
                                },
                                error: function() {
                                    alert('Image upload failed.');
                                }
                            });
                        },
                        onMediaDelete: function(target) {
                            var imageSrc = target[0].src;
                            // Remove image from server
                            $.ajax({
                                url: '{{ route("image.delete") }}',  // Your Laravel route
                                method: 'POST',
                                data: { src: imageSrc },
                                success: function(response) {
                                    console.log('Image deleted');
                                },
                                error: function() {
                                    alert('Image deletion failed.');
                                }
                            });
                        }
                    }
                });
            }
            function intSelect2(){
                $('.select2').select2({
                    width: '100%'
                });
            }
        </script>
        <!-- START: APP JS-->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <!-- END: APP JS-->

        <!-- START: Page Vendor JS-->
        <script src="{{ asset('assets/vendors/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/starrr/starrr.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.canvaswrapper.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.colorhelpers.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.saturated.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.browser.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.drawSeries.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.uiConstants.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.legend.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-flot/jquery.flot.pie.js') }}"></script>        
        <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>  
        <script src="{{ asset('assets/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js') }}"></script>
        <script src="{{ asset('assets/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
        <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <!-- END: Page Vendor JS-->

        
        <script src="{{ asset('assets/vendors/datatable/js/jquery.dataTables.min.js') }}"></script> 
        <script src="{{ asset('assets/vendors/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/datatable/buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/x-editable/js/bootstrap-editable.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/summernote/summernote-bs4.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script src="{{ asset('assets/vendors/select2/js/select2.full.min.js') }}"></script>
        {{-- <script src="{{ asset('assets//js/select2.script.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('assets/vendors/sweetalert/sweetalert.min.js') }}"></script>

        
        <!-- START: Page JS-->
        <script src="{{ asset('assets/js/home.script.js') }}"></script>
        <!-- END: Page JS-->
        @yield('script')
        <script>
            $(document).ready(function() {
                
                intSummernote();
                intSelect2();
                $('.dropify').dropify();
            });
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
        
            @if(Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        
            @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
        
            @if(Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @endif
        </script>
        @include('task.task_script')  
    </body>
</html>
