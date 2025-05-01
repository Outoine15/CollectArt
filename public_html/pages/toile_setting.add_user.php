<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!isset($_SESSION["user"])) {
    header("Location: ../user/connUser.php");
}
include("../DBconnect/db_connect.php");
include("../crud/user.crud.php");
include("../crud/toile_participants.crud.php");

include("../headerfooter/header.php");
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $toile_id = $_SESSION["toile_id"];
    $invitee_data = select_user_by_id($conn, $id);
    insert_toile_participants($conn, $toile_id, $id);
    header("Location: toile_setting.php");
}
include("../headerfooter/footer.php");
include("../DBconnect/db_disconnect.php");
?>