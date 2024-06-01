<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Kiểm tra các trường được nhập đầy đủ
	if(empty($_POST['txtname']) || empty($_POST['txtdes']) || empty($_POST['txtdis']) || empty($_POST['txtprice']) || empty($_POST['company_id']))
	{
		echo 'echo "<script>alert("Vui long nhap day du thong tin"); window.location.href = "add.php";</script>";';
	}
	//Kiểm tra hình ảnh có được up lên hay 
	if(!isset($_FILES['fileField']) || $_FILES['fileField']['error'] == UPLOAD_ERR_NO_FILE)
	{
		echo 'echo "<script>alert("Vui long upload hinh anh"); window.location.href = "add.php";</script>";';
	}
	//Xử lý hình ảnh
	$file_name = $_FILES['fileField']['name'];
	$tmp_name = $_FILES['fileField']['tmp_name'];

	$new_name = pathinfo($file_name,PATHINFO_FILENAME). "_".time(). pathinfo($file_name,PATHINFO_EXTENSION);
	$file_destination = "../images/".$new_name;
	if(move_uploaded_file($tmp_name,$file_destination))
	{
		$company_id = $_POST['company_id'];
		$name = $_POST['txtname'];
		$price = $_POST['txtprice'];
		$dis = $_POST['txtdis'];
		$des = $_POST['txtdes'];
		$image = $_POST['fileField'];
	    $connect->query("INSERT INTO product (product_name, company_id, product_description, product_price, product_discount, image) VALUES ('$name', $company_id, '$des', $price, $dis, '$new_name')");
		echo '"<script>alert("Them san pham thanh cong"); window.location.href = "index.php";</script>";';
	}
	else
	{
		echo '"<script>alert("Co loi xay ra khi upload hinh anh"); window.location.href = "add.php";</script>";';
	}
}
$companies = $connect->query("select * from company");
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
      <td height="22" colspan="2" style="text-align: center"><strong>THÊM SẢN PHẨM</strong></td>
    </tr>
    <tr>
      <td width="289" style="text-align: center">Công ty</td>
      <td width="495" style="text-align: center">
		  <select name="company_id" id="company_id">
			  <?php while($company = $companies->fetch_assoc()):?>
			  <option value="<?php echo $company['company_id']; ?>">
				  <?php echo $company['company_name']; ?>
			  </option>
			  <?php endwhile; ?>
      	  </select>
	  </td>
    </tr>
    <tr>
      <td style="text-align: center">Tên sản phẩm</td>
      <td style="text-align: center"><input type="text" name="txtname" id="txtname"></td>
    </tr>
    <tr>
      <td style="text-align: center">Mô tả</td>
      <td style="text-align: center"><input type="text" name="txtdes" id="txtdes"></td>
    </tr>
    <tr>
      <td style="text-align: center">Giá</td>
      <td style="text-align: center"><input type="text" name="txtprice" id="txtprice"></td>
    </tr>
    <tr>
      <td style="text-align: center">Giảm giá </td>
      <td style="text-align: center"><input type="text" name="txtdis" id="txtdis"></td>
    </tr>
    <tr>
      <td height="40" style="text-align: center">Hình ảnh</td>
      <td style="text-align: center"><input type="file" name="fileField" id="fileField"></td>
    </tr>
    <tr>
      <td height="40" colspan="2" style="text-align: center"><input type="submit" name="submit" id="submit" value="Thêm sản phẩm"></td>
    </tr>
  </tbody>
</table>
</form>
</body>
</html>