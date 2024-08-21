 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Select2 -->
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <!-- Bootstrap Bundle -->
 <script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

 <!-- Simplebar -->
 <script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>

 <!-- Waves -->
 <script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>

 <!-- Feather Icons -->
 <script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>

 <!-- Lord Icon -->
 <script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

 <!-- Plugins Js -->
 <script src="{{ URL::asset('build/js/plugins.js') }}"></script>

 <!-- List.js -->
 <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
 <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

 <!-- Ticketlist Initialization -->
 <script src="{{ URL::asset('build/js/pages/ticketlist.init.js') }}"></script>

 <!-- Sweetalert2 -->
 <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

 <!-- Password Create Initialization -->
 <script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>

 <!-- Prism.js -->
 <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

 <!-- App Js -->
 <script src="{{ URL::asset('build/js/app.js') }}"></script>
 <script>
    //  $(document).ready(function() {
                $('.Project_Language').select2();
                $('.Select_Country').select2();
                $('.links_per_post').select2();
                $('.links_admitted').select2();
                $('.delicated_topics').select2();
                $('.js-example-basic-multiple').select2();
                $('.select2').select2();
            // });
 </script>

 <!-- Flashy Message -->
 @include('flashy::message')



 <!-- Additional scripts from other views -->
 @yield('script')
 @yield('script-bottom')
