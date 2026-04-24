<div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-width: 0px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control tgl mb-3">
            </div>
            <div class="modal-footer" style="border-width: 0px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    $('.tgl').flatpickr({
        "locale": "id",
        "dateFormat": "d-m-Y",
        maxDate: "today"
    });

    $(document).on('change', '.tgl', function() {
        var tgl = $(this).val();
        $.ajax({
            url: "DataAbsensi/getAbsensibyDate/" + tgl,
            method: "GET",
            data: {tgl_absen: tgl},
            success: function(data) {
                $('.absenFilter').html(data);
            }
        });
    });
</script>
