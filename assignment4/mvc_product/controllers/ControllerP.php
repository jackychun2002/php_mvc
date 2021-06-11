<?php
    session_start();
    if (!$_SESSION["cart"]){
        $_SESSION["cart"] = [];
    }
    include_once "databaseP.php";

    class ControllerP{
        public function home(){
            include "views/home.php";
        }

        public function listProduct(){
            $sql_txt = "select * from products";
            $dssp = queryDB($sql_txt);
            include "views/listproduct.php";
        }

        public function editProduct(){
            if (!isset($_POST["id"])){
                $pr["id"] = "";
                $pr["name"] = "";
                $pr["price"] = "";
                $pr["painted"] = "";
                $pr["ncc"] = "";
                $title = "Thêm mới";
                include "views/editproduct.php";
            }else{
                $id = $_POST["id"];
                $sql_txt = "select * from products";
                $dssp = queryDB($sql_txt);
                foreach ($dssp as $item){
                    if ($item["id"] == $id){
                        $pr["id"] = $item["id"];
                        $pr["name"] = $item["name"];
                        $pr["price"] = $item["price"];
                        $pr["painted"] = $item["painted"];
                        $pr["ncc"] = $item["ncc"];
                        $title = "Sửa Thông Tin";
                        include "views/editproduct.php";
                    }
                }
            }
        }

        public function saveProduct(){
            if ($id = $_POST["id"] == ""){
                $name = $_POST["name"];
                $price = $_POST["price"];
                $painted = $_POST["painted"];
                $ncc = $_POST["ncc"];

                $sql_txt = "insert into products (name, price, painted, ncc) values ('$name', '$price', '$painted', '$ncc')";

                if (insertOrUpdateDB($sql_txt)){
                    header("location: ?route=listproduct");
                }else{
                    echo "ERROR";
                }
            }else{
                $id = $_POST["id"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                $painted = $_POST["painted"];
                $ncc = $_POST["ncc"];

                $sql_txt = "update products set name = '$name', price = '$price', painted = '$painted', ncc = '$ncc' where id = '$id'";
                if (insertOrUpdateDB($sql_txt)){
                    header("Location: ?route=listproduct");
                }else{
                    echo "ERROR";
                }
            }
        }

        public function deleteProduct(){
            $id = $_POST["id"];

            $sql_txt = "delete from products where id = '$id'";

            if (insertOrUpdateDB($sql_txt)){
                header("Location: ?route=listproduct");
            }else{
                echo "ERROR";
            }
        }

        public function listCart(){
            include "views/listcart.php";
        }

        public function addCart(){
            $cart = [];
            if(isset($_SESSION["cart"])){
                $cart = $_SESSION["cart"];
            }

            $id = $_POST["id"];
            $sql_txt = "select * from products where id = '$id'";
            $ds = queryDB($sql_txt);
            if (count($ds)>0){
                $sp =$ds[0];
                $sp["qty"] = 1;
                if ($this->checkCart($cart, $sp)){
                    foreach ($cart as $key=>$item){
                        if ($item["id"] == $sp["id"]){
                            $cart[$key]["qty"]++;
                        }
                    }
                }else{
                    $cart[] = $sp;
                }
                $_SESSION["cart"] = $cart;
                header("location: ?route=listproduct");
            }else{
                echo "Sản phẩm không tồn tại";
            }
        }

        public function checkCart($cart, $sp){
            foreach ($cart as $item){
                if ($item["id"] == $sp["id"]){
                    return true;
                }
            }
            return false;
        }

        public function createOrder(){
            $customer = $_POST["customer"];
            $tel = $_POST["tel"];
            $address = $_POST["address"];

            $cart = isset($_SESSION["cart"])?$_SESSION["cart"]:[];

            if (count($cart)>0){
                $total = 0;
                foreach ($cart as $item){
                    $total += $item["qty"] * $item["price"];
                }
                try {
                    $sql_oders = "insert into oders (grandtotal, customer, tel, address) values ('$total','$customer','$tel','$address')";
                    $conn = connectDB();
                    $order_id = 0;
                    if ($conn->query($sql_oders) === true){
                        $order_id = $conn->insert_id;
                    }
                    if ($order_id > 0){
                        $sql_item = "insert into order_products (order_id, product_id, qty, price) values ";
                        $values = [];
                        foreach ($cart as $item){
                            $sp_id = $item["id"];
                            $qty = $item["qty"];
                            $price = $item["price"];
                            $values[] = "($order_id, $sp_id, $qty, $price)";
                        }
                        $v = implode(",",$values);
                        $sql_item.= $v;
                        insertOrUpdateDB($sql_item);
                        $_SESSION["cart"] = [];
                        echo "Tạo đơn thành công";
                    }
                }catch (Exception $e){
                    var_dump($e);
                }
            }else{
                echo "Không có sản phẩm trong giỏ hàng";
            }
        }
    }
