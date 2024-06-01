<?php
session_start();
include '../includes/db_connect.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
$product_id = $_GET['product_id'];
$product = $connect->query("select * from product where product_id = $product_id")->fetch_assoc();
$companies = $connect->query("select * from company");
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$company_id = $_POST['company_id'];
	$name = $_POST['txtname'];
	$price = $_POST['txtprice'];
	$dis = $_POST['txtdis'];
	$des = $_POST['txtdes'];
	$connect->query("update product set product_name = '$name', product_price = $price, product_description = '$des', product_discount = $dis, company_id = $company_id where product_id = $product_id");
	echo '"<script>alert("Cap nhat san pham thanh cong"); window.location.href = "index.php";</script>";';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post" enctype="multipart/form-data">	
<table width="982" height="323" border="1" align="center">
  <tbody>
    <tr>
      <td height="22" colspan="2" style="text-align: center"><strong>CẬP NHẬT SẢN PHẨM</strong></td>
    </tr>
    <tr>
      <td width="289" style="text-align: center">Công ty</td>
      <td width="495" style="text-align: center">
		  <select name="company_id" id="company_id">
			  <?php while($company = $companies->fetch_assoc()):?>
			  <option value="<?php echo $company['company_id'] ?>" <?php if($product['company_id'] == $company['company_id']) echo 'selected' ;?>> 
				  <?php echo $company['company_name']; ?>
			  </option>
			  <?php endwhile; ?>
      	  </select>
	  </td>
    </tr>
    <tr>
      <td style="text-align: center">Tên sản phẩm</td>
      <td style="text-align: center"><input type="text" name="txtname" id="txtname" value="<?php echo $product['product_name']?>"></td>
    </tr>
    <tr>
      <td style="text-align: center">Mô tả</td>
      <td style="text-align: center"><input type="text" name="txtdes" id="txtdes" value="<?php echo $product['product_description']?>"></td>
    </tr>
    <tr>
      <td style="text-align: center">Giá</td>
      <td style="text-align: center"><input type="text" name="txtprice" id="txtprice" value="<?php echo $product['product_price']?>"></td>
    </tr>
    <tr>
      <td style="text-align: center">Giảm giá </td>
      <td style="text-align: center"><input type="text" name="txtdis" id="txtdis" value="<?php echo $product['product_discount']?>"></td>
    </tr>
    <tr>
      <td height="40" style="text-align: center">Hình ảnh</td>
      <td style="text-align: center"><img src="../images/<?php echo $product['image']?>" height="200px;" width="200px;"></td>
    </tr>
    <tr>
      <td height="40" colspan="2" style="text-align: center"><input type="submit" name="submit" id="submit" value="Cập nhật sản phẩm"></td>
    </tr>
  </tbody>
</table>
</form>
</body>
</html>