
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <link rel="icon" href="{{asset('img/mini_logo.png')}}" type="image/png">
            <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap1.min.css')}}" />
        <!-- themefy CSS -->
        <link rel="stylesheet" href="{{asset('vendors/themefy_icon/themify-icons.css')}}" />
        <!-- select2 CSS -->
        <link rel="stylesheet" href="{{asset('vendors/niceselect/css/nice-select.css')}}" />
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('vendors/owl_carousel/css/owl.carousel.css')}}" />
        <!-- gijgo css -->
        <link rel="stylesheet" href="{{asset('vendors/gijgo/gijgo.min.css')}}" />
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="{{asset('vendors/font_awesome/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/tagsinput/tagsinput.css')}}" />

        <!-- date picker -->
        <link rel="stylesheet" href="{{asset('vendors/datepicker/date-picker.css')}}" />

        <link rel="stylesheet" href="{{asset('vendors/vectormap-home/vectormap-2.0.2.css')}}" />
        
        <!-- scrollabe  -->
        <link rel="stylesheet" href="{{asset('vendors/scroll/scrollable.css')}}" />
        <!-- datatable CSS -->
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/jquery.dataTables.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/responsive.dataTables.min.css')}}" />
        <link rel="stylesheet" href="{{asset('vendors/datatable/css/buttons.dataTables.min.css')}}" />
        <!-- text editor css -->
        <link rel="stylesheet" href="{{asset('vendors/text_editor/summernote-bs4.css')}}" />
        <!-- morris css -->
        <link rel="stylesheet" href="{{asset('vendors/morris/morris.css')}}">
        <!-- metarial icon css -->
        <link rel="stylesheet" href="{{asset('vendors/material_icon/material-icons.css')}}" />

        <!-- menu css  -->
        <link rel="stylesheet" href="{{asset('css/metisMenu.css')}}">
        <!-- style CSS -->
        <link rel="stylesheet" href="{{asset('css/style1.css')}}" />
        <link rel="stylesheet" href="{{asset('css/colors/default.css')}}" id="colorSkinCSS">
        <script src="{{asset('js/jquery1-3.4.1.min.js')}}"></script> 
         
        @livewireStyles
    </head>
    <body  class="crm_body_bg">
         <!-- sidebar  -->

        <!--/ sidebar  -->
        <!-- footer  -->
        <section class="main_content dashboard_part large_header_bg">

            <div class="main_content_iner overly_inner ">
                    <div class="container-fluid p-0 ">
                        <!-- page title  -->



                        <div class="row ">
                         {{ $slot }}
                        </div>
                    </div>
            </div>
            
            <!-- footer part -->
            @livewire('footer')
        </section>
            <!-- main content part end -->
        <div id="back-top" style="display: none;">
            <a title="Go to Top" href="#">
                <i class="ti-angle-up"></i>
            </a>
        </div>
         @stack('modals')
        <!-- popper js -->
        <script src="{{asset('js/popper1.min.js')}}"></script>
        <!-- bootstarp js -->
        <script src="{{asset('js/bootstrap1.min.js')}}"></script>
        <!-- sidebar menu  -->
     
        
        @livewireScripts
      
        {{-- Modals area --}}
       {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
    </body>
</html>
