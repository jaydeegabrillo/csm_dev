// import Swal from 'sweetalert2';

$(document).ready(function () {
    var new_user = $("#new_user")
    var users_table = $("#users_table")
    var add_user_modal = $("#add_user_modal")
    var view_user = $(".view_user")
    var edit_user = $(".edit_user")
    var email = $('input[name="email"]')
    var username = $('input[name="username"]')
    var duplicate_email = $('#duplicate_email')
    var duplicate_username = $('#duplicate_username')

    $(document).on('click','button.add_user', function(){
        $('input').prop('disabled',false);
        $('select').prop('disabled',false);
        $('input').val('')
        $('button[type="submit"]').prop('disabled', false);
        $('.modal-title').html('Add User');
    })

    $(document).on('click','.view_user', function(e){
        var self = $(this);

        var id = self.data('id');
        $('input').prop('disabled',true);
        $('select').prop('disabled',true);
        $('button[type="submit"]').prop('disabled',true);
        $('.modal-title').html('User Details');

        $.ajax({
            type: 'get',
            url: '/users/get_user',
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

    $(document).on('click','.edit_user', function(e){
        var self = $(this);

        var id = self.data('id');
        $('input').prop('disabled', false);
        $('.modal-title').html('Edit User');

        $.ajax({
            type: 'get',
            url: '/users/get_user',
            data: {'id': id},
            success: function (result) {
                if (result) {
                    $.each(JSON.parse(result), function (index, value) {
                        $("input[name='"+index+"']").val(value)
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    $(document).click('.close', function(){
        // $('input').prop('disabled', false);
    })

    new_user.submit(function(e){
        e.preventDefault();
        var data = new_user.serialize();
        
        $.ajax({
            type: 'post',
            url: '/users/save_user',
            data: data,
            beforeSend: function(){
                add_user_modal.find('button[type="submit"]').prop('disabled',true);
            },
            success: function (result) {
                if(result){
                    var alerts = JSON.parse(result)
                    console.log(alerts.header,'alerts');
                    add_user_modal.find('button[type="submit"]').prop('disabled', false);
                    $("#add_user_modal").modal('toggle');
                    $('.modal-backdrop').remove();
                    users_table.DataTable().ajax.reload();
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

    users_table.DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        pageLength: 50,
        processing: true,
        serverSide: true,
        order: [[1, "asc"]],
        ajax: "users/users-datatable",
        columnDefs: [
            { targets: 0, orderable: false }, //first column is not orderable.
        ]
    });
    
    email.keyup(function () {
        var data = email.val();
        var email_duplicate = $('span.duplicate_email')
        
        $.ajax({
            type: 'get',
            url: '/users/check_email?email='+data,
            success: function (result) {
                if (result) {
                    email.parent().addClass('error');
                    email_duplicate.closest('div.form-group').show();
                    email_duplicate.show();
                    $(':button[type="submit"]').prop('disabled', true)
                } else {
                    email.parent().removeClass('error');
                    email_duplicate.closest('div.form-group').hide();
                    email_duplicate.hide();
                    $(':button[type="submit"]').prop('disabled', false)
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })

    username.keyup(function () {
        var data = username.val();
        var user_duplicate = $('span.duplicate_username')
        console.log(user_duplicate.closest('div.form-group'),'users');
        
        $.ajax({
            type: 'get',
            url: '/users/check_username?username='+data,
            success: function (result) {
                if (result) {
                    username.parent().addClass('error');
                    user_duplicate.closest('div.form-group').show()
                    user_duplicate.show();
                    $(':button[type="submit"]').prop('disabled',true)
                }else{
                    username.parent().removeClass('error');
                    user_duplicate.closest('div.form-group').hide()
                    user_duplicate.hide();
                    $(':button[type="submit"]').prop('disabled', false)
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    })
});