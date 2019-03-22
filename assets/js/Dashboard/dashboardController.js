// JS CONTROLLER - CAMALEON MicroFramework

(function ($) {
    // Globals DASHBOARD
    var URL_SINGLE = $("#urlSelector").val();
    console.log("Dashboard works!, " + URL_SINGLE);
    var objEdit = {"id": 0, "name": ""};
    //---------------------------------------------------------------------------------

    // UI controls
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    function disabledSave() {
        $("#saveCategory").addClass('disabled'); // Disables visually
        $("#saveCategory").prop('disabled', true); // Disables visually + functionally
    }
    function enabledSave() {
        $("#saveCategory").removeClass('disabled'); // Disables visually
        $("#saveCategory").prop('disabled', false); // Disables visually + functionally
    }

    function disabledEdit() {
        $("#editCategory").addClass('disabled'); // Disables visually
        $("#editCategory").prop('disabled', true); // Disables visually + functionally
    }
    function enabledEdit() {
        $("#editCategory").removeClass('disabled'); // Disables visually
        $("#editCategory").prop('disabled', false); // Disables visually + functionally
    }
    // Product 
    function disabledSaveProduct() {
        $("#saveProduct").addClass('disabled'); // Disables visually
        $("#saveProduct").prop('disabled', true); // Disables visually + functionally
    }
    function enabledSaveProduct() {
        $("#saveProduct").removeClass('disabled'); // Disables visually
        $("#saveProduct").prop('disabled', false); // Disables visually + functionally
    }
    function disabledEditProduct() {
        $("#editProduct").addClass('disabled'); // Disables visually
        $("#editProduct").prop('disabled', true); // Disables visually + functionally
    }
    function enabledEditProduct() {
        $("#editProduct").removeClass('disabled'); // Disables visually
        $("#editProduct").prop('disabled', false); // Disables visually + functionally
    }


    disabledEdit();
    enabledSave();


    // CRUD actions
    $("#saveCategory").on("click", function(){
        
        let nameCat = $("#categoryName").val();
        console.log("cat: "+ nameCat);
        if(nameCat == "" || nameCat == undefined || nameCat== null) {
            showAlert($(".alert.alert-warning"));
            $("#categoryName").focus();
        } else {
            // Save
            var dataForm=$("#formCategory").serialize()
            var promise = $.ajax({
                url: URL_SINGLE + 'Dashboard/saveCategory',
                type: 'POST',
                data:  dataForm,
                dataType: 'json',
                success: function(response){
                    console.log("response: ", response);
                    if (response.res == "success") {
                        showAlert($(".alert alert-success"));
                        location.reload();
                    }
                },
                error: function(err) {
                    console.log("err : "+ err);
                }
            });

        }
    });

    // Update Category
    $(".edit-category").on("click", function(){
        let categoryId = $(this).attr("data-id");
        if (categoryId!= "") {
            enabledEdit();
            disabledSave();
            var name = $(this).parent().prev().text();
            $("#categoryName").val(name);
            objEdit.id = categoryId
            objEdit.name = name
        }
    });

    // Edit Category :: Ajax request
    $("#editCategory").on("click", function(){
        // Edit
        var formData = new FormData();
        formData.append('id', objEdit.id);
        formData.append('categoryname', $("#categoryName").val());
        console.log("data json: "+ objEdit.name + " , " + objEdit.id + ", " + URL_SINGLE);

        $.ajax({
            url: URL_SINGLE + 'Dashboard/editCategory',
            type: 'POST',
            data:  formData,
            dataType: 'json',
            contentType: false,
            processData: false,            
            success: function(response){
                console.log("response: ", response);
                if (response.res == "success") {
                    console.log("edit ok");
                    disabledEdit();
                    enabledSave();
                    alert("Updated Category!");
                    showAlert($(".alert alert-success"), true);
                }
            },
            error: function(err) {
                console.log("err : "+ err);
            }
        });
    });

    // DELETE CATEGORY
    $(".delete-category").on("click", function(){

        let confirmDelete = confirm("Are you sure you want to delete the category?");

        if (confirmDelete) {
            let categoryId = $(this).attr("data-id");
            if (categoryId!= "") {
                var formData = new FormData();
                formData.append('id', categoryId);
    
                $.ajax({
                    url: URL_SINGLE + 'Dashboard/deleteCategory',
                    type: 'POST',
                    data:  formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,            
                    success: function(response){
                        console.log("response: ", response);
                        if (response.res == "success") {
                            console.log("delete ok");
                            disabledEdit();
                            enabledSave();
                            alert("Deleted Category!");
                            showAlert($(".alert alert-success"), true);
                        }
                    },
                    error: function(err) {
                        console.log("err : "+ err);
                    }
                });
            }
        } else {

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