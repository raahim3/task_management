<!doctype html>
<html lang="en">
<head>

        <meta charset="utf-8" />
        <title>Dashboard | Lexa - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}">
        <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />        <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        
        <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
        <style>
            .dropify-wrapper .dropify-message span.file-icon {
                font-size: 29px;
            }
        </style>
    </head>
    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <div id="layout-wrapper">

            @include('admin.partials.header')
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                   @include('admin.partials.sidebar')
                </div>
            </div>

            <div class="main-content">
                <div class="page-content">
                    @yield('admin')
                </div>
            
               @include('admin.partials.footer')
            </div>            
        </div>

        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
                    <h5 class="m-0 me-2">Settings</h5>
                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <hr class="mt-0" />
                   <div class="px-4 py-2">
                    <h6 class="mb-3">Select Custome Colors</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-default" value="default" onchange="document.documentElement.setAttribute('data-theme-mode', 'default')" checked>
                            <label class="form-check-label" for="theme-default">Default</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-red" value="red" onchange="document.documentElement.setAttribute('data-theme-mode', 'red')">
                            <label class="form-check-label" for="theme-red">Red</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input theme-color" type="radio" name="theme-mode"
                                id="theme-teal" value="teal" onchange="document.documentElement.setAttribute('data-theme-mode', 'teal')">
                            <label class="form-check-label" for="theme-teal">Teal</label>
                        </div>
                   </div>
           

                <h6 class="text-center mb-0 mt-3">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="{{ asset('admin_assets/images/layouts/layout-1.jpg') }}" class="img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{ asset('admin_assets/images/layouts/layout-2.jpg') }}" class="img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" data-bsStyle="{{ asset('admin_assets/css/bootstrap-dark.min.css') }}" data-appStyle="{{ asset('admin_assets/css/app-dark.min.html') }}" />
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{ asset('admin_assets/images/layouts/layout-3.jpg') }}" class="img-thumbnail" alt="">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="{{ asset('admin_assets/css/app-rtl.min.css') }}" />
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!--Morris Chart-->
        <!-- Required datatable js -->
        <script src="{{ asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/morris.js/morris.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/pages/dashboard.init.js') }}"></script>
        <script src="{{ asset('admin_assets/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
        <script src="https://cdn.tiny.cloud/1/lz77clm3lly9fvnp1ni93vvswdw0tcte2j485d0c2crdcwmx/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        @yield('script')
        <script>
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

            $('.dropify').dropify();

            tinymce.init({
            selector: '#content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            });
        </script>        
    </body>
</html>