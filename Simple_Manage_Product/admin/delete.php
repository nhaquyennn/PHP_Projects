<?php
session_start();
include('../includes/db_connect.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
    exit();
}
$product_id = $_GET['product_id'];
    if ($connect->query("DELETE FROM product WHERE product_id = $product_id")) 
	{
        echo ("<script>alert('Xóa thành công'); window.location.href = 'panel.php';</script>");
    } else 
	{
        echo ("<script>alert('Xóa thất bại'); window.location.href = 'panel.php';</script>");
    }

?>
