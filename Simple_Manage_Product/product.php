<?php
include('includes/db_connect.php');
$product_id = $_GET['product_id'];
$product = $connect->query("select product.*, company_name from product join company on product.company_id = company.company_id where product_id = $product_id")->fetch_assoc();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="940" height="464" border="1" align="center">
  <tbody>
    <tr>
      <td height="22" colspan="2" style="text-align: center">CHI TIẾT SẢN PHẨM</td>
    </tr>
    <tr>
      <td width="289" style="text-align: center">Công ty</td>
      <td width="495" style="text-align: center"><?php echo $product['company_name']; ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Tên sản phẩm</td>
      <td style="text-align: center"><?php echo $product['product_name']; ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Mô tả</td>
      <td style="text-align: center"><?php echo $product['product_description']; ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Giá</td>
      <td style="text-align: center"><?php echo $product['product_price']; ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Giảm giá </td>
      <td style="text-align: center"><?php echo $product['product_discount']; ?></td>
    </tr>
    <tr>
      <td style="text-align: center">Hình ảnh</td>
      <td style="text-align: center"><img src="images/<?php echo $product['image']; ?>" height="200px;" width="200px;"></td>
    </tr>
  </tbody>
</table>
<p style="text-align: center"><a href="index.php">Trang chủ</a></p>
</body>
</html>