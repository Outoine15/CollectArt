<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["admin_id"])){
    header("Location: ../main/index.php");
}
include("../DBconnect/db_connect.php");
include("../crud/user.crud.php");
include("../crud/toile.crud.php");
if ((($_SESSION["user"]) || isset($_SESSION["admin_id"])) && isset($_GET["action"]) && isset($_GET["id"])) {
    $id = $_GET["id"];
    $action = $_GET["action"];
    if (!isset($_SESSION["admin_id"])) {
        if ($_SESSION["user"] == $id) {
            if ($action = "delete") {
                remove_user($conn,$id);
            }
        }
    } else if(isset($_SESSION["admin_id"])){
        remove_user($conn,$id);
    }
}

function remove_user($conn,$id)
{
    delete_toile_creator($conn, $id);
    delete_user($conn, $id);



    unset($_SESSION["user"]);

}
include("../DBconnect/db_disconnect.php");
header("Location: ../main/index.php");
?>