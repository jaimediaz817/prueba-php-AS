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
                            <a class="active" href="<?php echo SINGLE_URL; ?>Dashboard/index">Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Dashboard/product">Products</a>
                        </li>
                        <li>
                            <a href="inventory">Inventory</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Dashboard/showProducts">Show Products</a>
                        </li>
                        <li>
                            <a href="#">Reports</a>
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
                                <p>Crud of Categories</p>
                                <div class="container mx-0 px-0">
                                    <div class="row">
                                        <div class="col-6">

                                            <div class="card">
                                                <h5 class="card-header">New Category</h5>
                                                <div class="card-body">
                                                    <form class="form" id="formCategory">
                                                        <div class="form-group">
                                                            <label for="categoryName">Name:</label>
                                                            <input type="text" name="categoryname" id="categoryName">
                                                        </div>
                                                        <div class="form-group">
                                                            <a href="#" class="btn btn-primary" id="saveCategory">Save Category</a>
                                                            <a href="#" class="btn btn-success" id="editCategory">Edit Category</a>
                                                        </div>
                                                    </form>
                                                    <div class="alert alert-success d-none" role="alert">
                                                        The category has been saved correctly
                                                    </div>
                                                    <div class="alert alert-warning d-none" role="alert">                               
                                                        Enter a category name
                                                    </div>                                                
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                        <?php if(empty($this->categoriesList)) :?>
                                            <div>Array vacio</div>
                                        <?php else: ?>
                                            <table class="table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($this->categoriesList as $val) :?>
                                                        <tr>
                                                            <td><?= $val->cate_id_pk ?></td>
                                                            <td><?= $val->cate_nombre ?></td>
                                                            <td>
                                                                <a href="#" data-id="<?= $val->cate_id_pk;?>" class=" btn btn-success edit-category">Edit</a>
                                                                <a href="#" data-id="<?= $val->cate_id_pk;?>" class="btn btn-danger delete-category">Delete</a>
                                                            </td>
                                                        </tr>
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

        <script src="<?php echo ASSET_URL ?>js/Dashboard/dashboardController.js">
            var URL_SINGLE = <?php echo SINGLE_URL ?>;
        </script>    
    </body>
</html>