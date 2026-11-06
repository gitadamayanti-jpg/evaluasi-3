<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const replayToast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    @if (session('success'))
        replayToast.fire({
            icon: 'success',
            title: @json(session('success'))
        });
    @endif

    @if (session('error'))
        replayToast.fire({
            icon: 'error',
            title: @json(session('error'))
        });
    @endif

    @if ($errors->any())
        replayToast.fire({
            icon: 'error',
            title: @json($errors->first())
        });
    @endif
</script>