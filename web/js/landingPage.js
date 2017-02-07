$(document).ready(function () {

////// Bouton Poopup Inscription 
    $(".insctrip").css("display", "none");
    $(".insctripeError").css("display", "none");
    
    $(".btnClose").click(function () {
        $(".insctrip").css("display", "none");
        $(".insctripeError").css("display", "none");
    });

    $("#validationInscrip").click(function () {

        ///////Recuperation champ inscription 
        ////Recuperachamption mail  
        var $mail = $("input[id=mail]").val();
        /// Verification cheekbox 
        if ($('input[id=newLetter').is(':checked')) {
            var $newLetter = 1;
        } else {
            var $newLetter = 0;
        }
        //////Requet ajax pour inscription
        $.ajax({
            url: 'http://localhost/tp/projet/beweb/web/app_dev.php/candidatureValid', ///// La ressource ciblée
            data: {"mail": $mail, "newsletter": $newLetter},
            type: 'get',
            dataType: "json",
            /**
             * Le paramètre data n'est plus renseigné, nous ne faisons plus passer de variable
             */
            success: function ($nop) {
//                
                if ($nop === 1) {
                    $(".insctrip").css("display", "block");
                } else {
                    $(".insctripeError").css("display", "block");
                }

            },
            complete: function () {

            },
            error: function () {

            }


        });

    });
    //////Requet ajax pour Contacte
    $("#validationConta").click(function () {

        ///////Recuperation champ inscription 
        ////Recuperachamption mail  
        var $mailConta = $("input[id=mailConta]").val();
        var $objConta = $("input[id=objConta]").val();
        var $messConta = $("textarea[id=messConta]").val();

        //////Requet ajax pour inscription
        $.ajax({
            url: 'http://localhost/tp/projet/beweb/web/app_dev.php/contacteValid', ///// La ressource ciblée
            data: {"mailConta": $mailConta,
                "objConta": $objConta,
                "messConta": $messConta
            },
            type: 'get',
            dataType: "json",
            /**
             * Le paramètre data n'est plus renseigné, nous ne faisons plus passer de variable
             */
            success: function () {


            },
            complete: function () {

            }


        });

    });

});