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


        // UI controls
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
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

            // TODO: comment - Request API CURRENCY
            //var res = convertCurrency(priceProd);
            // todo: comment end

            var formData = new FormData($("#formProduct")[0]);
            formData.append('nameProd', nameProd);
            formData.append('categoryProd', categoryProd);
            formData.append('priceProd', priceProd);
            formData.append('quantityProd', quantityProd);

            // Request 
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
        //const axios = require('../../js/libraries/axios');

        var endpoint = 'quotes';
        var access_key = '1869|oZZ9c79DK_rn1ND8UFHcr6TFTrbnzRyj';
        
        // define from currency, to currency, and amount
        var fromVar = 'COP';
        var to = 'USD';
        var amount = '10';

        var url = 'https://api.cambio.today/v1/'+ endpoint +'/'+ fromVar +'/'+ to +'/json?quantity='+ value +'&key=' + access_key;
        var response='';

        // axios({
        //     method:'get',
        //     url:'https://api.cambio.today/v1/'+ endpoint +'/'+ fromVar +'/'+ to +'/json?quantity='+ value +'&key=' + access_key,
        //     responseType:'json'
        // })
        // .then(function (response) {
        //     console.log(response);
        // });

        var x = 0;
        var y = 0;
        //dataType: 'jsonp',
        $.ajax({
            headers: {
                'Access-Control-Allow-Credentials' : true,
                'Content-Type':'application/json',
                'Access-Control-Allow-Origin':'http://localhost/joyeria-xyz/',
                'Access-Control-Allow-Methods':'GET',
                'Access-Control-Allow-Headers':'*',
            }, 
            type: 'GET',
            contentType: 'application/json',
            dataType: 'jsonp',
            responseType: 'application/json',
            url: 'https://api.cambio.today/v1/quotes/COP/USD/json?quantity=40000&key=1869|oZZ9c79DK_rn1ND8UFHcr6TFTrbnzRyj',
            crossDomain: true,
            beforeSend: function(xhr){
                xhr.withCredentials = true;
          },
           success: function(data, textStatus, request){
                console.log(data);
           },
           error: function(err) {
               console.log("err:: ", err);
           }
        });



        // $.ajax({
        //     url: 'https://api.cambio.today/v1/quotes/COP/USD/json?quantity=40000&key=1869|oZZ9c79DK_rn1ND8UFHcr6TFTrbnzRyj',
        //     crossDomain: true,
        //     method: 'GET',            
        //     dataType: 'jsonp',
        //     contentType: 'application/json',
        //     crossOrigin: false,
        //     success: function(data){
        //       console.log('succes: '+data);
        //     }
        //   });
          //header("Access-Control-Allow-Origin: *")
        // $.ajax({
        //     type: 'GET',
        //     crossDomain: true,
        //     dataType: 'jsonp',
        //     contentType: 'application/json',
        //     headers: {
        //         'Access-Control-Allow-Credentials' : true,
        //         'Access-Control-Allow-Origin':'http://localhost/joyeria-xyz/Dashboard/product',
        //         'Access-Control-Allow-Methods':'GET',
        //         'Access-Control-Allow-Headers':'application/json',
        //     },            
        //     url: 'https://api.cambio.today/v1/quotes/COP/USD/json?quantity=40000&key=1869|oZZ9c79DK_rn1ND8UFHcr6TFTrbnzRyj',
        //     success: function(jsondata){
        //         console.log(jsondata);
        //         var c = "test";
        //         var j = 817;
        //         response = jsondata
        //     }
        //  })
        return response;

        // execute the conversion using the "convert" endpoint:
        // var promiseCurrency = $.ajax({
        //     url: 'http://apilayer.net/api/' + endpoint + '?access_key=' + access_key +'&from=' + fromVar + '&to=' + to + '&amount=' + amount,   
        //     dataType: 'json',
        //     success: function(json) {
        //         // access the conversion result in json.result
        //         alert(json.result);
        //     }
        // });

        // promiseCurrency.done(function(){
        //     console.log("promise current");
        //     console.log("result: ");
        // })
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

                        alert("Deleted Product!");
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

    // Generate Report - action  ***********************************************************
    // 
    $("#generateReport").on("click", function(){
        console.log("click");

        let promiseReport = $.ajax({
            url: URL_SINGLE + 'Dashboard/generateReportRequest',
            type: 'POST',
            data:  {"report": "true"},
            dataType: 'json',
            contentType: false,
            processData: false,            
            success: function(response){
                console.log("response: ", response);
                if (response.res == "success") {
                    //alert("controller ok" + response.htmlRender);
                    $("#tableRender").append(response.htmlRender);
                    $("#htmlId").val(response.pdfRender)
                }
            },
            error: function(err) {
                console.log("error : ", err);
            }
        });   

    });

    function reloadCurrentPage() {
        location.reload();
    }

})(jQuery);