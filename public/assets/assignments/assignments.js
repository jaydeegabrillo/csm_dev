$(document).ready(function () {
    var new_assignment = $("#new_assignment")
    var assignments_table = $("#assignments_table")
    var add_assignment_modal = $("#add_assignment_modal")
    var view_assignment = $(".view_assignment")
    var edit_assignment = $(".edit_assignment")

    $(document).on('click', '.add_assignment', function (e) {
        // $('input').prop('disabled', true);
        // $('select').prop('disabled', true);
        $('button[type="submit"]').prop('disabled', false);
        $('.modal-title').html('Add Assignment');
        $('input').val('')
        $('select').val('')
        $('textarea').val('')
    })

    $(document).on('change', '#specialty, #start_date, #end_date, #time_start, #time_end', function(e){
        var id = $('.id').val();
        var specialty = $('#specialty').val()
        var start_date = $('#start_date').val()
        var end_date = $('#end_date').val()
        var time_start = $('#time_start').val()
        var time_end = $('#time_end').val()

        var data = {
            'id': specialty,
            'start_date': start_date,
            'end_date': end_date,
            'time_start': time_start,
            'time_end': time_end
        };

        if(start_date === '' || end_date === '' || time_start === '' || time_end === ''){
            // $("#assigned_user").empty().append('<option></option><option disabled>No Staff Available</option>');
        }else{
            $.ajax({
                type: 'get',
                url: '/assignments/get_staff/',
                data: data,
                success: function (result) {
                    $('#assigned_user').html('');

                    if (result) {
                        $.each(JSON.parse(result), function (index, value) {
                            $('#assigned_user').append('<option value="'+value.id+'" >'+value.name+'</option>')
                        });
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    })

    $(document).on('click', '.view_assignment', function (e) {
        var self = $(this);

        var id = self.data('id');
        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('textarea').prop('disabled', true);
        $('button[type="submit"]').prop('disabled', true);
        $('.modal-title').html('Assignment Details');

        $.ajax({
            type: 'get',
            url: '/assignments/get_assignment',
            data: { 'id': id },
            success: function (result) {
                if (result) {
                    $('select').prop('disabled', true);
                    $.each(JSON.parse(result), function (index, value) {
                        if($('#'+index).is("select")){
                            $("select[name='" + index + "']").val(value).change()
                        }else{
                            $("input[name='" + index + "']").val(value)
                            $("textarea[name='" + index + "']").val(value)
                        }
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    $(document).on('click', '.edit_assignment', function (e) {
        var self = $(this);

        var id = self.data('id');
        $('input').prop('disabled', false);
        $('textarea').prop('disabled', false);
        $('.modal-title').html('Edit Assignment');
        $('#assigned_user option').attr('disabled', true);

        $.ajax({
            type: 'get',
            url: '/assignments/get_assignment',
            data: { 'id': id },
            success: function (result) {
                if (result) {

                    $.each(JSON.parse(result), function (index, value) {
                        if ($('#' + index).is("select")) {
                            $("select[name='" + index + "']").val(value).change()
                            if(index === 'assigned_user'){
                                $('#assigned_user option[value="' + value + '"]').removeAttr('disabled');
                            }
                        } else {
                            $("input[name='" + index + "']").val(value)
                            $("textarea[name='" + index + "']").val(value)
                        }
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    $(document).on('hidden.bs.modal', '#add_assignment_modal' , function(){
        $('input').prop('disabled', '');
        $('select').prop('disabled', '');
        $('#assigned_user option').attr('disabled','disabled');
    });

    new_assignment.submit(function (e) {
        e.preventDefault();
        var data = new_assignment.serialize();
        console.log(data,'data');
        $.ajax({
            type: 'post',
            url: '/assignments/save_assignment',
            data: data,
            beforeSend: function () {
                add_assignment_modal.find('button[type="submit"]').prop('disabled', true);
            },
            success: function (result) {
                if (result) {
                    var alerts = JSON.parse(result)
                    add_assignment_modal.find('button[type="submit"]').prop('disabled', false);
                    $("#add_assignment_modal").modal('toggle');
                    $('.modal-backdrop').remove();
                    assignments_table.DataTable().ajax.reload();
                    Swal.fire(
                        alerts.header,
                        alerts.message,
                        alerts.type
                    )
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    assignments_table.DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[1, "asc"]],
        ajax: "assignments/assignments-datatable",
        columnDefs: [
            { targets: 0, orderable: false }, //first column is not orderable.
        ]
    });

});
