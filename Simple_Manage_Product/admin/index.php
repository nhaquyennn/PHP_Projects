<?php
session_start();
include('../includes/db_connect.php');
if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
	exit();
}
$product_list = $connect->query("select product.*, company_name from product join company on product.company_id = company.company_id");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p style="text-align: center">Admin Panel</p>
<p style="text-align: center"><a href="add.php">Thêm sản phẩm</a></p>
<table width="858" height="196" border="1" align="center">
  <tbody>
    <tr>
      <td style="text-align: center">STT</td>
      <td style="text-align: center">Công ty</td>
      <td style="text-align: center">Tên sản phẩm</td>
      <td style="text-align: center">Giá </td>
      <td style="text-align: center">Giảm giá</td>
      <td style="text-align: center">Mô tả </td>
      <td style="text-align: center">Hình ảnh</td>
      <td style="text-align: center">Hành động</td>
    </tr>
	<?php $count++; ?>
	<?php while($product = $product_list->fetch_assoc()):?>
    <tr>
      <td style="text-align: center"><?php echo $count; ?></td>
      <td style="text-align: center"><?php echo $product['company_name']; ?></td>
      <td style="text-align: center"><?php echo $product['product_name']; ?></td>
      <td style="text-align: center"><?php echo $product['product_price']; ?></td>
      <td style="text-align: center"><?php echo $product['product_discount']; ?></td>
      <td style="text-align: center"><?php echo $product['product_description']; ?></td>
      <td style="text-align: center"><img src="../images/<?php echo $product['image']; ?>" height="200px;" width="200px;"></td>
      <td style="text-align: center"><a href="update.php?product_id=<?php echo $product['product_id']; ?>">Sửa</a> | <a href="delete.php?product_id=<?php echo $product['product_id']; ?>">Xóa</a></td>
    </tr>
	<?php $count++; ?>
	<?php endwhile;?>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>