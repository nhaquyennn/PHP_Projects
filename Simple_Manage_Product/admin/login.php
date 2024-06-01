<?php
session_start();
include('../includes/db_connect.php');
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$username = $_POST['txt_username'];
	$pass = $_POST['txt_password'];
	$result = $connect->query("select * from admin_for_remake where username = '$username' and password = '$pass'");
	if($result && $result->num_rows > 0)
	{
		$admin = $result->fetch_assoc();
		$_SESSION['admin'] = $admin['admin_id'];
		header("location: index.php");
		exit();
	}
	else
	{
		$error = 'Invalid username or password';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<form method="post">
<table width="850" height="231" border="1" align="center">
  <tbody>
    <tr>
      <td colspan="2" style="text-align: center"><strong>ĐĂNG NHẬP ADMIN</strong></td>
    </tr>
    <tr>
      <td style="text-align: center">Username</td>
      <td style="text-align: center"><input type="text" name="txt_username" id="txt_username"></td>
    </tr>
    <tr>
      <td style="text-align: center">Password</td>
      <td style="text-align: center"><input type="text" name="txt_password" id="txt_password"></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center"><input type="submit" name="login_btn" id="login_btn" value="Đăng nhập"></td>
    </tr>
  </tbody>
</table>
</form>
<?php if(isset($error)): ?>
	<p style="text-align: center"><?php echo $error; ?></p>
<?php endif; ?>
</body>
</html>