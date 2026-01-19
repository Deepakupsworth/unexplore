{{-- iziToast --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('success'))
            iziToast.success({
                title: 'Success',
                message: @json(session('success')),
                position: 'topRight',
                timeout: 5000
            });
        @endif

        @if(session('error'))
            iziToast.error({
                title: 'Error',
                message: @json(session('error')),
                position: 'topRight',
                timeout: 6000
            });
        @endif

        @if(session('warning'))
            iziToast.warning({
                title: 'Warning',
                message: @json(session('warning')),
                position: 'topRight',
                timeout: 6000
            });
        @endif

        @if(session('info'))
            iziToast.info({
                title: 'Info',
                message: @json(session('info')),
                position: 'topRight',
                timeout: 5000
            });
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                iziToast.error({
                    title: 'Validation Error',
                    message: @json($error),
                    position: 'topRight',
                    timeout: 7000
                });
            @endforeach
        @endif

    });
</script>
