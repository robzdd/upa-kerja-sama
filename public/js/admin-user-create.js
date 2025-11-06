$(document).ready(function() {
    // Initialize Select2 for type dropdown (no search)
    $('#type').select2({
        minimumResultsForSearch: -1,
        placeholder: "Pilih Tipe User",
        allowClear: false
    });

    // Initialize Select2 for program studi dropdown (with search)
    $('#program_studi_id').select2({
        placeholder: "Pilih Program Studi",
        allowClear: true
    });

    const alumniFields = $('#alumni-fields');
    const mitraFields = $('#mitra-fields');
    const mahasiswaFields = $('#mahasiswa-fields');

    function updateFieldsVisibility() {
        const selectedType = $('#type').val();

        alumniFields.hide();
        mitraFields.hide();
        mahasiswaFields.hide();

        if (selectedType === 'alumni') {
            alumniFields.fadeIn(300);
        } else if (selectedType === 'mitra') {
            mitraFields.fadeIn(300);
        } else if (selectedType === 'mahasiswa') {
            mahasiswaFields.fadeIn(300);
        }
    }

    // Jalankan setelah semuanya siap
    updateFieldsVisibility();
    $('#type').on('change', updateFieldsVisibility);

    // Pastikan trigger saat page load (kalau ada value default)
    $('#type').trigger('change');
});
