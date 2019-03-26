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
                            <a href="<?php echo SINGLE_URL; ?>/Dashboard/product">Products</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Dashboard/searchProduct">Inventory</a>
                        </li>
                        <li>
                            <a href="showProducts" class="">Show Products</a>
                        </li>
                        <li>
                            <a href="<?php echo SINGLE_URL; ?>Dashboard/reports" class="active">Reports</a>
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
                                <p>Report Products - inventory</p>
                                <div class="container mx-0 px-0">
                                    <div class="row">

                                        <div class="col-12 pl-0">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="">
                                                        <span> Click a Link for generate Report Inventory - All products</span>
                                                        <a href="javascript:;" class="btn btn-primary" id="generateReport">Generate Report</a>
                                                    </form>                                                    
                                                </div>

                                                <div id="tableRender">
                                                </div>

                                                <form action="<?php echo SINGLE_URL; ?>Dashboard/pdf" method="post">
                                                    <input type="hidden" name="html" value="" id="htmlId">
                                                    <button type="submit">PDF</button>
                                                </form>
                                            </div>
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