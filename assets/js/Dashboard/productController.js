// JS CONTROLLER - CAMALEON MicroFramework

(function ($) {
    // Globals DASHBOARD
    var URL_SINGLE = $("#urlSelector").val();
    console.log("Product works!, " + URL_SINGLE);

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
    //-------------------------------------------------------------------------------------------

    enabledSaveProduct();
    disabledEditProduct();
    let objProductEdit = {"idProduct": 0}

    // Click Save
    $("#saveProduct").on("click", function() {

        let confirmSave = confirm("Are you sure you want to create a new product?");

        if (confirmSave) {

            // get data
            let nameProd     = $("#productName").val();
            let categoryProd = $("#categories").val();
            let priceProd    = $("#productPrice").val();
            let quantityProd = $("#quantity").val();

            // Request
            //var res = convertCurrency(priceProd);

            var formData = new FormData($("#formProduct")[0]);
            formData.append('nameProd', nameProd);
            formData.append('categoryProd', categoryProd);
            formData.append('priceProd', priceProd);
            formData.append('quantityProd', quantityProd);

            let promiseProduct = $.ajax({
                url: URL_SINGLE + 'Dashboard/addProductRequest',
                type: 'POST',
                data:  formData,
                dataType: 'json',
                contentType: false,
                processData: false,            
                success: function(response){
                    console.log("response: ", response);
                    if (response.res == "success") {
                        console.log("add Product ok");
                        alert("The product has been saved successfully");
                        // refresh
                        location.reload();
                    }

                    if (response.res == "fail" && response.uploadStatus == 0) {
                        alert("You must add a photo with a valid image format, usually .ico formats are not accepted for you to take it into account");
                    }
                },
                error: function(err) {
                    console.log("err : "+ err);
                }
            });

            promiseProduct.done(function() {
                console.log("flujo #1")    
            });

            console.log("flujo #2")
        } else {
            return false;
        }      
    });


    function convertCurrency(value) {

        var endpoint = 'convert';
        var access_key = '89dd481d423f920afcb058422d4e4f72';
        
        // define from currency, to currency, and amount
        var fromVar = 'EUR';
        var to = 'GBP';
        var amount = '10';
        
        // execute the conversion using the "convert" endpoint:
        var promiseCurrency = $.ajax({
            url: 'http://apilayer.net/api/' + endpoint + '?access_key=' + access_key +'&from=' + fromVar + '&to=' + to + '&amount=' + amount,   
            dataType: 'jsonp',
            success: function(json) {
        
                // access the conversion result in json.result
                alert(json.result);
                        
            }
        });
    }


    // Eclit Edit | link table
    $(".edit-product").on("click", function() {
        let id = $(this).parent().next().find("#idProd").val();
        let name = $(this).parent().next().find("#nameProd").val();
        let categoryId = $(this).parent().next().find("#cateProd").val();
        let price = $(this).parent().next().find("#priceProd").val();

        console.log("val: " + id + ", "+ name + " , "+ categoryId + " , " + price);

        // Set category
        $("select#categories option").each((i,j)=>{
            if ($(j).val() == categoryId) {
                $(j).attr("selected", true);
            }
        });

        // set name
        objProductEdit.idProduct = id;
        $("#productName").val(name);
        $("#productPrice").val(categoryId);
        $("#quantity").val(price);

        disabledSaveProduct();
        enabledEditProduct();
    })

    $(".delete-product").on("click", function() {
        let id = $(this).parent().next().find("#idProd").val();

        let confirmEdit = confirm("Do you really want to Delete the data of this product (logical erasing)?")
        if (confirmEdit) {
            // ajax request
            var formData = new FormData();
            formData.append('id', id);
            $.ajax({
                url: URL_SINGLE + 'Dashboard/deleteProductRequest',
                type: 'POST',
                data:  formData,
                dataType: 'json',
                contentType: false,
                processData: false,            
                success: function(response){
                    console.log("response: ", response);
                    if (response.res == "success") {
                        console.log("delete ok");

                        enabledSaveProduct();
                        disabledEditProduct();

                        alert("Deleted Category!");
                        showAlert($(".alert alert-success"), true);
                    }
                },
                error: function(err) {
                    console.log("err : "+ err);
                }
            });
        }
    });


    // Click Edit | Main action
    $("#editProduct").on("click", function() {

        let confirmEdit = confirm("Do you really want to edit the data of this product?")

        if (confirmEdit) {
            console.log("edit ");
            // get data
            let nameProd     = $("#productName").val();
            let categoryProd = $("#categories").val();
            let priceProd    = $("#productPrice").val();
            let quantityProd = $("#quantity").val();
    
            var formData = new FormData($("#formProduct")[0]);
            formData.append('idProduct', objProductEdit.idProduct);
            formData.append('nameProd', nameProd);
            formData.append('categoryProd', categoryProd);
            formData.append('priceProd', priceProd);
            formData.append('quantityProd', quantityProd);
    
            let promiseProduct = $.ajax({
                url: URL_SINGLE + 'Dashboard/editProductRequest',
                type: 'POST',
                data:  formData,
                dataType: 'json',
                contentType: false,
                processData: false,            
                success: function(response){
                    console.log("response: ", response);
                    if (response.res == "success") {
                        alert("The product has been updated successfully");
                        enabledSaveProduct();
                        disabledEditProduct();
                        // refresh
                        location.reload();
                    }
                },
                error: function(err) {
                    console.log("err : "+ err);
                }
            });   
        }
    });




    // Search inventory
    $("#showInventory").on("click", function(e){
        e.preventDefault();
        if ($("#products").val() !== "") {
            var id = $("#products").val();
            window.location.href = URL_SINGLE + "Dashboard/inventory/" + id
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