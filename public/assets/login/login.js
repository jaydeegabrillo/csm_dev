// set variables
var login_form = $('#login_form');

// execution
login_form.submit(function(e){
    e.preventDefault();
    var data = login_form.serialize();
    
    $.ajax({
        type: 'GET',
        url:'login',
        data: data,
        success: function(result){
            if(result == 'true'){
                window.location.href=window.location.origin + "/dashboard";
            }else{
                $('div.alert').removeClass('hide');
                $('div.alert').addClass('show');
            }
        },
        error: function(err){
            console.log(err);
        }
    });
});