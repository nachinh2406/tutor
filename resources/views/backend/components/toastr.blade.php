<script>
    @if (Session::has('message'))
    var message = "{{Session::get('message')}}";
    var type = "{{Session::get('type')}}";
    switch(type) {
        case 'success':
        toastr['success'](message, { showDuration: 300, rtl: false });
        break;
        case 'error':
        toastr['error'](message, { showDuration: 300, rtl: false });
        break;
    }
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr['error']("{{ $error }}", { showDuration: 300, rtl: false });
        @endforeach
    @endif
</script>
