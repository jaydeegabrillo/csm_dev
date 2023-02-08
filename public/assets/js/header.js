$(document).ready(function () {
    $(document).on('click', '.profile-pic', function(){
        var dropdown = $('.profile_dropdown');
        // alert("It's working now")
        // console.log($('.profile_dropdown').hasClass('show'));
        // console.log("ASDFADS");
        if (dropdown.hasClass('show')){
            dropdown.removeClass('show');
        }else{
            dropdown.addClass('show');
        }
    });
})