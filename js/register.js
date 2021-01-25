$(document).ready(function () {
    // var DOMAIN = "http://localhost/inv_project/public_html";
    //For Register Part
    $("#register_form").on("submit", function () {
        var status = false;
        var fullName = $("#fullName");
        var username = $("#username");
        var email = $("#email");
        var pass1 = $("#password");
        var pass2 = $("#password2");
        // var type = $("#usertype");

        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        if (fullName.val() == "" || fullName.val().length < 6) {
            fullName.addClass("border-danger");
            $("#fn_error").html("<span class='text-danger'>Morate uneti puno ime i prezime duže od 6 karaktera</span>");
            status = false;
        } else {
            fullName.removeClass("border-danger");
            $("#fn_error").html("");
            status = true;
        }
        if (username.val() == "" || username.val().length < 6) {
            username.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Morate uneti korisničko ime duže od 6 karaktera</span>");
            status = false;
        } else {
            username.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }
        if (!e_patt.test(email.val())) {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Morate uneti validnu email adresu</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if (pass1.val() == "" || pass1.val().length < 9) {
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Morate uneti šifru dužu od 9 karaktera</span>");
            status = false;
        } else {
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }
        if (pass2.val() == "" || pass2.val().length < 9) {
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Morate potvrditi šifru dužu od 9 karaktera</span>");
            status = false;
        } else {
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }
        // if(type.val() == ""){
        // 	type.addClass("border-danger");
        // 	$("#t_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
        // 	status = false;
        // }else{
        // 	type.removeClass("border-danger");
        // 	$("#t_error").html("");
        // 	status = true;
        // }
        if ((pass1.val() == pass2.val()) && status == true) {
            $(".overlay").show();
            console.log("okej su mu podaci")
            var json = {};
            json["username"] = $("#username").val();
            json["password"] = $.sha256($('#password').val());
            json["fullName"] = $("#fullName").val();
            json["email"] = $("#email").val();
            json["status"] = "user";
            request = $.ajax({
                url: "http://localhost/domaci3/register",
                method: "POST",
                data: JSON.stringify(json)
                // data : $("#register_form").serialize(),
                // success : function(data){
                // 	if (data == "EMAIL_ALREADY_EXISTS") {
                // 		$(".overlay").hide();
                // 		alert("It seems like you email is already used");
                // 	}else if(data == "SOME_ERROR"){
                // 		$(".overlay").hide();
                // 		alert("Something Wrong");
                // 	}else{
                // 		$(".overlay").hide();
                // 		window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
                // 	}
                // }
            })

            request.done(function (response, textStatus, jqXHR) {

                console.log(response.poruka)
                if (response.poruka === 'Korisnik je uspešno registrovan') {
                    alert('Korisnik je uspešno registrovan');
                    console.log('Korisnik je uspešno registrovan');
                    location.reload(true);
                    window.location.href = encodeURI("http://localhost/domaci_iteh/index.php");

                    // $(".overlay").hide();
                	// window.location.href = encodeURI("http://localhost/domaci_iteh/index.php?msg=Uspešno ste se registrovali. Možete se prijaviti.");
                }
                else {
                    alert('Korisnik nije registrovan ' + response.poruka);
                    console.log('Korisnik nije registrovan ' + response.poruka);
                }
                console.log(response);
            });
        
            request.fail(function (jqXHR, textStatus, errorThrown) {
                console.error('Pojavila se sledeća greška: ' + textStatus, errorThrown);
            });
        } else {
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Lozinke nisu identične</span>");
            status = true;
        }
    })
});