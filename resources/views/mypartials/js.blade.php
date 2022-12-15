<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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