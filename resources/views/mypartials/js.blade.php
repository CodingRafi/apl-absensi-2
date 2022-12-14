<script>
    function showAlert(message, type) {
        if (type == 'success') {
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'topRight'
            });
        } else {
            iziToast.error({
                title: 'Failed',
                message: message,
                position: 'topRight'
            });
        }
    }
    @if (session()->has('msg_success')) showAlert("{{ session('msg_success') }}", 'success')
    @elseif(session()->has('msg_error')) showAlert("{{ session('msg_error') }}", 'error')
    @endif
</script>