<?php
//namespace camaleon\viewControllers;

use camaleon\mvc\ControllerBase;

//   M O D E L S
use camaleon\models\CategoryModel;
use camaleon\models\ProductModel;
use camaleon\models\InventoryModel;

//   S E S S I O N
use camaleon\helpers\SessionApp;

//   E M A I L
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class DashboardController extends ControllerBase {

    // Category default
    public function index($params=null) {
        $category = new CategoryModel();
        $categoriesList = $category->selectAllCategories();

        //header("Location: ". SINGLE_URL . "Dashboard/index");

        $this->view->categoriesList = $categoriesList;
        $this->view->renderView($this, "index", "Home | Dashboard - Category");
    }

    // actions CRUD - Category
    public function saveCategory($params=null) {
        $response;
        if ($_POST) {
            $categoryName = $_POST["categoryname"];

            $category = new CategoryModel();
            $category->name = $categoryName;
            $res = $category->create();
            if ($res) {
                $response = array('res'=>'success');
            } else {
                $response = array('res'=>'fail');
            }            
        }
        echo(json_encode($response));
    }

    // actions CRUD - Category
    public function editCategory($params=null) {
        $response;
        if ($_POST) {
            $categoryId = $_POST["id"];
            $categoryName = $_POST["categoryname"];

            $category = new CategoryModel();
            $category->id = $categoryId;
            $category->name = $categoryName;
            $res = $category->update();

            if ($res) {
                $response = array('res'=>'success');
            } else {
                $response = array('res'=>'fail');
            }            
        }
        echo(json_encode($response));
    }

    public function deleteCategory($params=null) {
        $response;
        if ($_POST) {
            $categoryId = $_POST["id"];
            $category = new CategoryModel();
            $category->id = $categoryId;
            $res = $category->delete();
            if ($res) {
                $response = array('res'=>'success');
            } else {
                $response = array('res'=>'fail');
            }            
        }
        echo(json_encode($response));
    }


    //--------------------------------------------------------------------------
    // Products
    public function showProducts($params=null) {
        // Get All
        $category = new CategoryModel();
        $product = new ProductModel();

        $categoriesList = $category->selectAllCategories();
        $products = $product->selectAllProducts();
        $arrTmp = [];

        $inventory = new InventoryModel();

        foreach($products as $prod) {
            $id = $prod->prod_id_pk;
            $res = $inventory->selectAllMovementsByProduct($id);
            $diffInventory = $this->diffInventory($res, $inventory, $id);
            
            $arrTmp[$prod->prod_id_pk] = $diffInventory;
        }        

        $this->view->arrTmp = $arrTmp;
        $this->view->categoriesList = $categoriesList;
        $this->view->products = $products;
        $this->view->renderView($this, "showProducts", "Home | Product");
    }

    //  Show products
    public function product($params=null) {
        // Get All
        $category = new CategoryModel();
        $product = new ProductModel();

        $categoriesList = $category->selectAllCategories();
        $products = $product->selectAllProducts();
        
        $this->view->categoriesList = $categoriesList;
        $this->view->products = $products;
        $this->view->renderView($this, "product", "Home | Product");
    }

    // Add
    public function addProductRequest($params=null) {

        $uploadStatus = 0;
        $textAction = "";
        $countProductInitial = 0;

        $file = $_FILES['imageInputFile'];
        $fileName = $file['name'];
        $mimeType = $file['type'];

        // formats Img
        if ($mimeType == "image/jpg" || $mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/gif") {
            // Copy Image to folder
            if (!is_dir('assets/uploads/images')) {
                mkdir('assets/uploads/images', 0777, true);
            }
            $moveImageStatus = move_uploaded_file($file['tmp_name'], 'assets/uploads/images/'.$fileName);

            $product = new ProductModel();
            $inventory = new InventoryModel();

            $product->name       = $_POST['nameProd'];
            $product->category   = $_POST['categoryProd'];
            $product->price      = $_POST['priceProd'];
            $countProductInitial = $_POST['quantityProd'];

            if ($moveImageStatus) {
                $product->pathImgage = $fileName;
            } else {
                $product->pathImgage = "noImage.png";
            }

            // Save Product            
            $uploadStatus = 1;            
            $res = $product->create();

            if ($res) {
                $textAction = "success";
                $lastId = $product->getLastId();
                $idTmp = $lastId[0];
                // Inventory
                $inventory->idProduct = $idTmp;
                $inventory->type = 'add';
                $inventory->quantity = $countProductInitial;
                $res = $inventory->generateMovement();

            } else {
                $textAction = "failAdd";
            }

        } else {
            // validate Format
            $uploadStatus = 0;
            $textAction = "fail";
        }

        // Response
        echo(json_encode(array(
            "res"=> $textAction,
            "uploadStatus"=> $uploadStatus
        )));
    }

    // Edit Product 
    public function editProductRequest($params=null) {
        $uploadStatus = 0;
        $textAction = "";
        $countProductInitial = 0;

        $file = $_FILES['imageInputFile'];
        $fileName = $file['name'];
        $mimeType = $file['type'];

        // formats Img
        if ($mimeType == "image/jpg" || $mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/gif") {
            // Copy Image to folder
            if (!is_dir('assets/uploads/images')) {
                mkdir('assets/uploads/images', 0777, true);
            }
            $moveImageStatus = move_uploaded_file($file['tmp_name'], 'assets/uploads/images/'.$fileName);

            $product = new ProductModel();
            $product->id         = $_POST['idProduct'];
            $product->name       = $_POST['nameProd'];
            $product->category   = $_POST['categoryProd'];
            $product->price      = $_POST['priceProd'];
            $countProductInitial = $_POST['quantityProd'];

            if ($moveImageStatus) {
                $product->pathImgage = $fileName;
            } else {
                $product->pathImgage = "noImage.png";
            }

            // Save Product            
            $uploadStatus = 1;            
            $res = $product->update();
            if ($res) {
                $textAction = "success";
            } else {
                $textAction = "failEdit";
            }

        } else {
            // validate Format
            $uploadStatus = 0;
            $textAction = "fail";
        }

        // Response
        echo(json_encode(array(
            "res"=> $textAction,
            "uploadStatus"=> $uploadStatus
        )));
    }

    // Delete Product (Logical Erasing)
    public function deleteProductRequest($params=null) {
        $textAction = "";

        $idProduct = $_POST['id'];
        $product = new ProductModel();
        $product->id = $idProduct;
        $res = $product->update();

        if($res) {
            $textAction = "success";
        } else {
            $textAction = "failDelete";
        }

        // response
        echo json_encode(array("res"=> $textAction));
    }

    // Show All
    public function showAllProducts () {

    }

    //---------------------------------------------------------------------------
    //    I N V E N T O R Y 

    public function inventory($params=null) {

        $ex = explode(",", $params);
        $arr = array();
        $cont=0;
        $nameGeneralProd = "";
        foreach($ex as $index => $va) {
            $cont++;
            //echo "<br>recorrido<br>". $index . $va;
            array_push($arr, $va);
        }
        $idProductParam = $arr[0];

        $inventory = new InventoryModel();
        $res = $inventory->selectAllMovementsByProduct($idProductParam);        

        $totalsAdd = 0;
        $totalsRemove = 0;

        if(!empty($res)) {
            $nameGeneralProd = $res[0]->prod_nombre;
            //$this->calculateIventory($res);
            $sumAdd = $inventory->selectMovAddProduct($idProductParam, 'add');
            $sumRemove = $inventory->selectMovAddProduct($idProductParam, 'remove');

            if(!empty($sumAdd)) {
                $totalsAdd = $sumAdd[0]->addTotals;
                if ($totalsAdd == null) {
                    $totalsAdd = 0;
                }
            }

            if(!empty($sumRemove)) {
                $totalsRemove = $sumRemove[0]->addTotals;
                if ($totalsRemove == null) {
                    $totalsRemove = 0;
                }
            }
        }

        // Render view
        $this->view->nameProd = $nameGeneralProd;
        $this->view->currentProdInventory = ($totalsAdd - $totalsRemove);
        $this->view->list = $res;
        $this->view->renderView($this, "inventory", "Inventory | Product");
    }

    public function calculateIventory($arr) {
        $addContainer = array();
        $removeContainer = array();

        foreach($arr as $val) {
            $varTmp = $val;

            if($val->movi_tipo == "add") {
                array_push($addContainer, $val->movi_cantidad);
            } else if($val->movi_tipo == "remove") {
                array_push($removeContainer, $val->movi_cantidad);
            }
            $var = 0;
        }


        if(!empty($addContainer)) {

        }

        if(!empty($removeContainer)) {
            
        }

        return true;
    }

    // Quantities Product
    public function updateQuantities($params=null){        
        $removeFlag = true;
        $textRequest = "";

        if($_POST) {
            $prodId = $_POST['prodId'];
            $quantity = $_POST['quantity'];
            $typeAction = $_POST['typeAction'];

            $inventory = new InventoryModel();
            $res = $inventory->selectAllMovementsByProduct($prodId);

            $diffInventory = $this->diffInventory($res, $inventory, $prodId);
            $baseCalc = 0;

            if ($typeAction == "add") {
                // add
                $inventory->idProduct = $prodId;
                $inventory->quantity = $quantity;
                $inventory->type = $typeAction;

                $res = $inventory->generateMovement(); 
                if ($res) {
                    $removeFlag = true;
                    $textRequest = "success";
                }

            } else if($typeAction == "remove") {
                $baseCalc = ($diffInventory - $quantity);

                if ($baseCalc < 0) {
                    $removeFlag = false;
                    $textRequest = "fail";
                } else {
                    // add
                    $inventory->idProduct = $prodId;
                    $inventory->quantity = $quantity;
                    $inventory->type = $typeAction;
                    $res = $inventory->generateMovement();

                    if ($res) {
                        $removeFlag = true;
                        $textRequest = "success";
                    }
                }
            }
        }

        echo json_encode(array(
            "res"=>$textRequest,
            "removeFlag"=> $removeFlag
        ));
    }   


    public function diffInventory($res, $inventory, $idProductParam) {

        if(!empty($res)) {
            //$this->calculateIventory($res);
            $totalReturnDiff = 0;
            $sumAdd = $inventory->selectMovAddProduct($idProductParam, 'add');
            $sumRemove = $inventory->selectMovAddProduct($idProductParam, 'remove');

            if(!empty($sumAdd)) {
                $totalsAdd = $sumAdd[0]->addTotals;
                if ($totalsAdd == null) {
                    $totalsAdd = 0;
                }
            }

            if(!empty($sumRemove)) {
                $totalsRemove = $sumRemove[0]->addTotals;
                if ($totalsRemove == null) {
                    $totalsRemove = 0;
                }
            }
            $totalReturnDiff = ($totalsAdd - $totalsRemove);
        }    
        return $totalReturnDiff;
    }


    public function searchProduct($params=null) {

        //getById
        $prod = new ProductModel();
        $res = $prod->selectAllProducts();

        $this->view->listProd = $res;
        $this->view->renderView($this, "searchProduct", "Search Product | Dashboard - Category");
    }

}