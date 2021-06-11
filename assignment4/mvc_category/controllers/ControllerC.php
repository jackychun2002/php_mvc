<?php
    include_once "databaseC.php";

    class ControllerC{
        public function listCategory(){
            $sql_txt = "select * from categories";
            $dscategory = queryDB($sql_txt);
            include "views/listcategory.php";
        }

        public function saveCategory(){
            if ($id = $_POST["id"] == ""){
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                $count = $_POST["count"];
                $painted = $_POST["painted"];

                $sql_txt = "insert into categories (name, slug, count, painted) values ('$name','$slug','$count','$painted')";
                if (insertOrUpdateDB($sql_txt)){
                    header("location: ?route=listcategory");
                }else{
                    echo "ERROR";
                }
            }else{
                $id = $_POST["id"];
                $name = $_POST["name"];
                $slug = $_POST["slug"];
                $count = $_POST["count"];
                $painted = $_POST["painted"];

                $sql_txt = "update categories set name = '$name', slug = '$slug', count = '$count', painted = '$painted' where id = '$id'";
                if (insertOrUpdateDB($sql_txt)){
                    header("location: ?route=listcategory");
                }else{
                    echo "ERROR";
                }
            }
        }

        public function updateCategory(){
            if (!isset($_POST["id"])){
                $ct["id"] = "";
                $ct["name"] = "";
                $ct["slug"] = "";
                $ct["count"] = "";
                $ct["painted"] = "";
                $title = "Thêm mới";
                include "views/updatecategory.php";
            }else{
                $id = $_POST["id"];
                $sql_txt = "select * from categories";
                $dscategory = queryDB($sql_txt);
                foreach ($dscategory as $item){
                    if ($item["id"] == $id){
                        $ct["id"] = $item["id"];
                        $ct["name"] = $item["name"];
                        $ct["slug"] = $item["slug"];
                        $ct["count"] = $item["count"];
                        $ct["painted"] = $item["painted"];
                        $title = "Sửa thông tin";
                        include "views/updatecategory.php";
                    }
                }
            }
        }

        public function deleteCategory(){
            $id = $_POST["id"];

            $sql_txt = "delete from categories where id = '$id'";

            if (insertOrUpdateDB($sql_txt)){
                header("location: ?route=listcategory");
            }else{
                echo "ERROR";
            }
        }
    }
