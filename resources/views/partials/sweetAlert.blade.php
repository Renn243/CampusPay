@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: '{!! implode("<br>", $errors->all()) !!}',
        confirmButtonText: 'Oke',
        confirmButtonColor: '#0d6efd',
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        confirmButtonText: 'Oke',
        confirmButtonColor: '#0d6efd',
    });
</script>
@endif