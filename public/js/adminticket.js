document.addEventListener('livewire:navigated', function () {
    const input = document.getElementById('gambar');
    const preview = document.getElementById('preview');
    const cameraIcon = document.getElementById('camera-icon');

    input.addEventListener('change', function (event) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                cameraIcon.classList.add('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        }
    });
});