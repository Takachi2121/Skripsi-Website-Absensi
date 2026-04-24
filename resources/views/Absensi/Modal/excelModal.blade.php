<div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-width: 0px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control tgl-filter mb-3">
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border-width: 0px;">
                <button type="button" class="btn btn-success down-excel wait" id="download" disabled>Download</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    $('.tgl-filter').flatpickr({
        "locale": "id",
        "dateFormat": "d-m-Y",
        maxDate: "today"
    });

    $(".tgl-filter").on('change', function() {
        $("#download").prop("disabled", false);
    });

    $(".down-excel").on('click', function() {
        var tgl = $(".tgl-filter").val();
        console.log(tgl);
        $.ajax({
            url: "{{url('DataAbsensi/download')}}/" + tgl,
            type: "GET",
            success: function(data) {
                console.log("Sukses");
                $('.wait').html("Loading...");
                // $('.wait').prop("disabled", true);
                window.location.href = "{{url('DataAbsensi/download')}}/" + tgl;
            },
        });
    });
</script>
