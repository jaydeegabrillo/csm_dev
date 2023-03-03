const slug = 'dashboard';
let lat = 0;
let lng = 0;

$(document).ready(function(){
    getLocation();
    var dashboard_table = $('#dashboard_table').DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[1, "asc"]],
        ajax: {
            url: "dashboard/dashboard-datatable",
            data: function(d){
                d.search_date = $('#search_date').val();
                console.log(d);
            }
        },
        columnDefs: [
            { targets: 0, orderable: false }, //first column is not orderable.
        ]
    });

    $(document).on('click', 'span.clock_in, span.clock_out', function () {
        var self = $(this);
        var id = self.data('id');
        var date = self.data('date');
        console.log(date);

        if (lat == 0 && lng == 0) {
            Swal.fire({
                title: 'Warning',
                text: 'Please enable your location to clock in/out',
                icon: 'warning',
            });
        }else{
            $.ajax({
                url: slug + '/clock_in/' + id + '/' + date,
                success: function (result) {
                    var type = JSON.parse(result).type;

                    if (type == 'update' || type == 'insert') {
                        dashboard_table.ajax.reload()
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    })

    $(document).on('change', '#search_date', function(e){
        dashboard_table.ajax.reload();
    });

    $(document).on('click', '.delete_log_modal', function(){
        var id = $(this).data('id')

        $('.delete_log').attr('data-id', id);
    })

    $(document).on('click', '.edit_log_modal', function(){
        var id = $(this).data('id');

        $('#log_id').val(id)
        $('input[name="in"]').val($(this).data('in'));
        $('input[name="out"]').val($(this).data('out'));
        $('input[name="date"]').val($(this).data('date'));
    })

    $(document).on('submit', '#edit_log',function(e){
        e.preventDefault()

        var self = $(this)
        var data = self.serialize()

        $.ajax({
            url: slug + '/edit_log/',
            type: 'get',
            data: data,
            success: function (result) {

                var success = JSON.parse(result).success;
                if (success) {
                    $('#edit_log_modal').toggle()
                    $('.modal-backdrop').remove();

                    Swal.fire(
                        'Update',
                        'Log has been updated',
                    )
                    dashboard_table.ajax.reload()
                    self[0].reset();
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    $(document).on('click', '.delete_log', function(){
        var self = $(this);
        var id = self.data('id')

        $.ajax({
            url: slug + '/delete_log/' + id,
            success: function (result) {
                var success = JSON.parse(result).success;

                if(success){
                    $('#delete_log_modal').toggle()
                    $('.modal-backdrop').remove();

                    Swal.fire(
                        'Delete Log',
                        'Log has been deleted',
                    )
                    dashboard_table.ajax.reload()
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })
})

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lng = position.coords.longitude;
}
