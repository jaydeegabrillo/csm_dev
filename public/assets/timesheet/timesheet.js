$(document).ready(function () {
    const slug = 'timesheet';
    var timesheet_form = $('#timesheet_pdf_form');

    $('#timesheet_table').DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[1, "desc"]],
        ajax: "timesheet/timesheet-datatable",
        columnDefs: [
            { targets: 0, orderable: false }, //first column is not orderable.
        ]
    });

    timesheet_form.submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = slug + "/timesheet_pdf?" + data;
        window.open(url, '_blank');
    });

});
