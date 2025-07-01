document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua tombol edit (untuk tiap field)
    document.querySelectorAll('.edit-field-btn').forEach(function (btn) {
        let isEdit = false; // state edit untuk masing-masing tombol

        btn.addEventListener('click', function () {
            // Cari elemen form group terdekat yang ada tombol ini
            const formGroup = btn.closest('.ps-3.my-2.d-flex.justify-content-between.flex-row.w-100');
            if (!formGroup) return;

            // Dalam form group itu, ambil elemen display & input
            const display = formGroup.querySelector('.field-display');
            const input = formGroup.querySelector('.field-input');

            if (!isEdit) {
                // Masuk mode edit
                input.value = display.innerText;
                display.style.display = 'none';
                input.style.display = 'inline-block';
                input.focus();
                btn.innerHTML = '<span class="fw-bold" style="display: flex;margin-top:1.5vw;height:5vw;color:#b89c6c; justify-content:center;">Simpan</span>';
            } else {
                // Simpan perubahan
                display.innerText = input.value;
                display.style.display = 'inline-block';
                input.style.display = 'none';
                btn.innerHTML = '<img src="img/arrow-kanan.png" alt="">';
            }
            isEdit = !isEdit;
        });

        // Enter-to-save: pastikan hanya untuk input dalam form group terkait tombol ini
        const formGroup = btn.closest('.ps-3.my-2.d-flex.justify-content-between.flex-row.w-100');
        if (formGroup) {
            const input = formGroup.querySelector('.field-input');
            input.addEventListener('keydown', function (e) {
                if (e.key === "Enter" && input.style.display !== 'none') {
                    btn.click();
                }
            });
        }
    });
});
