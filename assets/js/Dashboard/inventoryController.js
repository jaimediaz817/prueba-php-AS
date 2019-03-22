// JS CONTROLLER - CAMALEON MicroFramework

(function ($) {
    // Globals DASHBOARD
    var URL_SINGLE = $("#urlSelector").val();
    console.log("Inventory works!, " + URL_SINGLE);

    var $btnAction = $("#actionInventory");
    $("#actions").on("change", function(){
        console.log("action on", $(this).val());
        if ($(this).val() == 1) {
            $btnAction.addClass("btn-promary").removeClass("btn-danger").text("add quantity");
        } else {
            $btnAction.removeClass("btn-promary").addClass("btn-danger").text("remove quantity")
        }

    })

    $btnAction.on("click", function() {
        let quantity = $("#quantity").val();
        let prodId = $("#idProdInput").val();
        let typeAction = ($("#actions").val()==1)?"add":"remove";
        
        if ($("#quantity").val() == "" || $("#quantity").val() == null || $("#quantity").val() == undefined) {
            alert("you must enter an amount to add or remove from inventory");
            $("#quantity").focus();
        } else {
            if($("#quantity").val() < 0 ) {
                alert("the amount can not be negative. Please enter a positive valid number");
                $("#quantity").val(0);
                $("#quantity").focus();
            } else {
                // Request
                var formData = new FormData();
                formData.append('prodId', prodId);
                formData.append('quantity', quantity);
                formData.append('typeAction', typeAction);
                
                $.ajax({
                    url: URL_SINGLE + 'Dashboard/updateQuantities',
                    type: 'POST',
                    data:  formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response){
                        console.log("response: ", response);

                        if (response.res == "success" && response.removeFlag == true) {
                            console.log("delete ok");
                            alert("The movement has been successfully made in the inventory.");
                            // refresh
                            location.reload();
                        } else if (response.res == "fail" && response.removeFlag == false){
                            alert("You can not subtract the amount entered to the current amount of product existence, enter a lower value so that the difference is NOT negative");
                        }

                    },
                    error: function(err) {
                        console.log("err : "+ err);
                    }
                });
            }
        }
    });

    // Show and Hide warning - action  ***********************************************************
    function showAlert($jqueryAlert, reload=false) {
        console.log("alert warning")
        $jqueryAlert.removeClass("d-none");

        setTimeout(function() { 
            $jqueryAlert.addClass("d-none");
        }, 3000);

        if (reload) {
            reloadCurrentPage();
        }
    }

    function reloadCurrentPage() {
        location.reload();
    }
})(jQuery);