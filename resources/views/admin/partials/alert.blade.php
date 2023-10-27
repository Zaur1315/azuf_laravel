{{--Flash messages--}}
@if(session('success'))
    <script>
        let message = "{{session('success')}}"
        toastr.success(message);
    </script>
@endif
@if(session('error'))
    <script>
        let message = "{{session('error')}}"
        toastr.error(message);
    </script>
@endif
@if(session('info'))
    <script>
        let message = "{{session('info')}}"
        toastr.error(message);
    </script>
@endif
