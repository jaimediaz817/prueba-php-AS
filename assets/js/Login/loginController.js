// JS CONTROLLER - CAMALEON MicroFramework

(function ($) {
    console.log("login works JS!");
    var URL_SINGLE = $("#urlSelector").val();
    var userId = '';
    function getDataLogin() {

    }

    $("#signIn").on("click", function(e){
        e.preventDefault();
    
        let nickname = $("#loginInput").val()
        let password = $("#passwordInput").val()
        console.log("data " + nickname + " " + password);

        // Validation
        if (nickname=!"" && password != "" ) {
            let objUser = {
                login: nickname,
                password: password
            }

            var dataForm=$("#form-login").serialize()

            var promesa = $.ajax({
                url: URL_SINGLE + 'Login/signInLogin',
                type: 'POST',
                data:  dataForm,
                dataType: 'json',
                success: function(response){
                    console.log("response: " + response.res  + " login : " + (response.nick[0]));

                    let data = (response.nick);
                    //var i;
                    // for (i=0; i < response.nick.length; i++) {
                    //     console.log("hello: "+ response.nick[i]["usua_password"]);

                    // }


                    // ACCESS VALIDATE
                    if (response.res == "success") {

                        // redirect Home
                        window.location.href = URL_SINGLE + "Dashboard/index";

                    } else if (response.res == "fail") {
                        // Show message error
                        var resQuestion = confirm("your data is valid but access to the platform has not been authorized, do you want to receive an email right now to validate your access?");

                        if (resQuestion) {
                            console.log("yes")
                            setResponseQuestionMail(true);
                            userId = response.userId;
                            console.log("question::: "+ userId)
                        } else {
                            console.log("No")
                            setResponseQuestionMail(false);
                        }
                    }
                },
                error: function(err) {
                    console.log("err ¿? : "+ err);
                }
            });
        } else {

        }
    })

    function setResponseQuestionMail(res) {
        if (res) {
            $(".group-email-validation").removeClass("d-none");
            $("#emailInput").focus();
        } else {
            console.log("NO send email request");
        }
    }

    // step final
    $("#sendMailFinal").on("click", function(){
        console.log("send email request");
        var email = $("#emailInput").val();
        var login = $("#loginInput").val();

        
        if (email !=='') {
            console.log("begin")
            var formData = new FormData();
            formData.append('action', 'sendMail');
            formData.append('email', email);
            formData.append('login', login);
            formData.append('userId', userId);
    
            var promiseEmail = $.ajax({
                url: URL_SINGLE + 'Login/accessMail',
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response.res)
                    $(".group-email-validation").addClass("d-none");
                    alert("A link was sent to the email you wrote in the text field, please review it and activate your access account right now.");
                },
                error: function(err) {
                    console.log("err : "+ err);
                }
            }); 
        } else {
            alert('plase write you email');
        }
    })

})(jQuery);