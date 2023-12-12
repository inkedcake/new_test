$(document).ready(function(){
    $('#btn_submit_note').click(function(){
        var email = $('#email').val();
        var phone = $('#phone').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();

        $.ajax({
            url: "/register/run",
            type: "post",
            dataType: "json",
            data: {
                "email": email,
                "phone": phone,
                "password": password,
                "password2": password2,
            },
            error: function (result) {
                alert(result.message);
            },
            
            success: function (result) {
                alert(result.message);
            }
        });
    });
});