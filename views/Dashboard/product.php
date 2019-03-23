<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Title -->
        <title><?php echo $this->title; ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <link rel="stylesheet" href="<?php echo ASSET_URL ?>styles/styles.css">
    </head>
    <body class="dashboard">
        
        <main>
            <header>            
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Dashboard Joyería</a>
                    <a href="<?php echo SINGLE_URL; ?>Login/signOut" class="btn btn-secondary btn-lg active float-right" role="button" aria-pressed="true">Sign Out</a>
                </nav>                
            </header>

            <div id="wrapper">

                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand">
                            <a href="#">
                                Main Menú - Home
                            </a>
                        </li>
                        <li>
                            <a href="index">Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>/Dashboard/product" class="active">Products</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Dashboard/searchProduct">Inventory</a>
                        </li>
                        <li>
                            <a href="showProducts">Show Products</a>
                        </li>
                        <li>
                            <a href="reports">Reports</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Login/signOut">Exit</a>
                        </li>
                    </ul>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>ATLANTIC SOFT - TEST</h1>
                                <p>Products</p>
                                <div class="container-fluid mx-0 px-0">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="card">
                                                <h5 class="card-header">New product</h5>
                                                <div class="card-body">
                                                    <form class="form" id="formProduct" enctype="multipart/form">

                                                        <!-- Name -->
                                                        <div class="form-group">
                                                            <label for="productName">Name:</label>
                                                            <input type="text" name="productname" id="productName" class="form-control">
                                                        </div>

                                                        <!-- Categories -->
                                                        <div class="form-group">
                                                            <label for="categoryName">Category:</label>
                                                            <?php if(empty($this->categoriesList)) :?>
                                                                <div>No categories!</div>
                                                            <?php else: ?>
                                                                <select class="selectpicker form-control" id="categories">
                                                                    <?php foreach($this->categoriesList as $val) :?>                                                                
                                                                        <option value="<?= $val->cate_id_pk ?>"><?= $val->cate_nombre ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- File -->
                                                        <div class="custom-file form-group" id="customFile" lang="es">
                                                            <label for="">Photo:</label>
                                                            <input type="file" class="custom-file-input" id="imageInputFile" aria-describedby="fileHelp" name="imageInputFile">
                                                            <label class="custom-file-label" for="imageInputFile">Select file...</label>
                                                        </div>

                                                        <!-- Price -->
                                                        <div class="form-row">
                                                            <div class="form-group col-6">
                                                                <label for="productPrice">Price:</label>
                                                                <input type="text" name="productPrice" id="productPrice" class="form-control">
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="quantity">Initial quantity of products:</label>                                                                
                                                                <input type="number" name="productname" id="quantity" class="form-control">
                                                                <i class="fas fa-dolly-flatbed product-count-icon"></i>
                                                            </div>
                                                        </div>

                                                        <!-- Count stock -->


                                                        <!-- Actions *** -->
                                                        <div class="form-group">
                                                            <a href="#" class="btn btn-primary" id="saveProduct">Save Product</a>
                                                            <a href="#" class="btn btn-success" id="editProduct">Edit Product</a>
                                                        </div>
                                                    </form>

                                                    <div class="alert alert-success d-none" role="alert">
                                                        The Product has been saved correctly
                                                    </div>
                                                    <div class="alert alert-warning d-none" role="alert">                               
                                                        Enter a Product name
                                                    </div>                                                
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-7 pl-0">
                                            <?php if(empty($this->products)) :?>
                                                <div>Void Result</div>
                                            <?php else: ?>
                                                <table class="table table-dark t-products">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Photo</th>
                                                            <th scope="col">Actions</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($this->products as $prod) :?>
                                                            <?php if($prod->prod_status!=0) :?>
                                                                <tr>
                                                                    <td><small><?= $prod->prod_nombre; ?></small></td>
                                                                    <td><small><?= $prod->cate_nombre; ?></small></td>
                                                                    <td>
                                                                        <span class="avatar-product">
                                                                            <img class="rounded" src="<?= ASSET_URL."uploads/images/".$prod->prod_imagen; ?>" alt="" srcset="">
                                                                        </span>                                                                    
                                                                        </td>
                                                                    <td>
                                                                        <a href="#" data-id="<?= $prod->prod_id_pk; ?>" class=" btn btn-success edit-product">Edit</a>
                                                                        <a href="#" data-id="<?= $prod->prod_id_pk; ?>" class="btn btn-danger delete-product">Delete</a>
                                                                        <a href="inventory/<?= $prod->prod_id_pk; ?>" data-id="<?= $prod->prod_id_pk; ?>" class="btn btn-warning inventory-product">Inventory</a>
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" id="idProd" value="<?= $prod->prod_id_pk; ?>">
                                                                        <input type="hidden" id="nameProd" value="<?= $prod->prod_nombre; ?>">
                                                                        <input type="hidden" id="cateProd" value="<?= $prod->cate_id_fk; ?>">
                                                                        <input type="hidden" id="priceProd" value="<?= $prod->prod_precio; ?>">
                                                                    </td>
                                                                </tr>
                                                            <?php endif;?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#page-content-wrapper -->
            </div>
            <!-- /#wrapper -->
        </main>

        <!-- CUSTOM -->
        <input id="urlSelector" type="hidden" name="url" value="<?php echo SINGLE_URL; ?>">
                

        <!-- Scripts -->
        <script src="<?php echo ASSET_URL ?>js/libraries/jquery-plugins/jquery-3.2.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>        

        <!-- CUSTOM -->
        <input id="urlSelector" type="hidden" name="url" value="<?php echo SINGLE_URL; ?>">

        <script src="<?php echo ASSET_URL ?>js/Dashboard/productController.js">
            var URL_SINGLE = <?php echo SINGLE_URL ?>;
        </script>    
    </body>
</html>