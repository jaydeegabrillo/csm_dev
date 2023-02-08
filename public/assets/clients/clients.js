// import Swal from 'sweetalert2';

$(document).ready(function () {
    var new_client = $("#new_client")
    var clients_table = $("#clients_table")
    var add_client_modal = $("#add_client_modal")
    var email = $('input[name="email"]')
    var username = $('input[name="username"]')
    var duplicate_email = $('#duplicate_email')
    var duplicate_username = $('#duplicate_username')

    $('input[name="phone"]').inputmask('(999) 999-9999')

    $(document).on('click','button.add_client', function(e){
        $('input').prop('disabled',false);
        $('input').val('')
        $('button[type="submit"]').prop('disabled', false);
        $('.modal-title').html('Add Client');
    })

    $(document).on('click','.view_client, .edit_client', function(e){
        var self = $(this);

        var id = self.data('id');
        var action = self.data('action')
        if(action == 'view'){
            $('input, select').prop('disabled',true);
            $('button[type="submit"]').prop('disabled',true);
            $('.modal-title').html('Client Details');
        }else{
            $('input, select').prop('disabled', false);
            $('button[type="submit"]').prop('disabled', false);
            $('.modal-title').html('Edit Client');
        }

        $.ajax({
            type: 'get',
            url: '/clients/get_client',
            data: {'id': id},
            success: function (result) {
                if (result) {
                    $.each(JSON.parse(result), function (index, value) {
                        $("input[name='"+index+"']").val(value)
                        $("select[name='"+index+"']").val(value).change()
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    new_client.submit(function(e){
        e.preventDefault();
        var data = new_client.serialize();

        $.ajax({
            type: 'post',
            url: '/clients/save_client',
            data: data,
            beforeSend: function(){
                add_client_modal.find('button[type="submit"]').prop('disabled',true);
            },
            success: function (result) {
                if(result){
                    var alerts = JSON.parse(result)
                    add_client_modal.find('button[type="submit"]').prop('disabled', false);
                    $("#add_client_modal").modal('toggle');
                    $('.modal-backdrop').remove();
                    clients_table.DataTable().ajax.reload();
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

    clients_table.DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[1, "asc"]],
        ajax: "clients/clients-datatable",
        columnDefs: [
            { targets: 0, orderable: false }, //first column is not orderable.
        ]
    });
    
    email.keyup(function () {
        var data = email.val();
        
        $.ajax({
            type: 'get',
            url: '/clients/check_email?email='+data,
            success: function (result) {
                if (result) {
                    email.parent().addClass('error');
                    $('span.duplicate_email').show();
                    $(':button[type="submit"]').prop('disabled', true)
                } else {
                    email.parent().removeClass('error');
                    $('span.duplicate_email').hide();
                    $(':button[type="submit"]').prop('disabled', false)
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })
});

function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}