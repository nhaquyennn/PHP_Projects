<?php
include('includes/db_connect.php');
$company_id = isset($_GET['company_id']) ? $_GET['company_id']: '';
$query = "select * from product";
if($company_id)
{
	$query .= " where company_id = $company_id";
}
$result = $connect->query($query); //Truy van san pham
$companies =  $connect->query("select * from company"); //Truy van cong ty
?>
<?php
$search_query = isset($_GET['search']) ? $_GET['search']: '';
$search_condition = '';
if($search_query)
{
	$search_condition = "and product_name like '%$search_query%'";
}
$query = "select * from product where 1=1 ";
if($company_id)
{
	$query .= "and company_id = $company_id";
}
$query .= $search_condition;
$result = $connect->query($query);
$companies =  $connect->query("select * from company"); //Truy van cong ty
?>	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="includes/style.css">
</head>

<body>
	<div id="container">
		<div id="header"></div>
		<div id="main">
			<div id="left">
				<h2 style="text-align: center">COMPANY</h2>
				<ul style="list-style: none">
					<li><a href="index.php">All Product</a></li>
					<?php while($company = $companies->fetch_assoc()): ?>
					<li>
						<a href="?company_id=<?php echo $company['company_id']?>"><?php echo $company['company_name']?></a>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<div id="right">
				<form method="get" action="index.php">
					<input type="text" name="search" placeholder="Search...">
					<button type="submit">Search</button>
				</form>
				
				<h2 style="text-align: center">PRODUCT</h2>
				<?php if($result->num_rows > 0): ?>
					<div style="display: flex; flex-wrap: wrap;">
						<?php while($product = $result->fetch_assoc()): ?>
						<div style="border: 1px solid black; width: 200px; height: 200px; text-align: center; margin-left: 10px; padding-top: 20px;">
							<a href="product.php?product_id=<?php echo $product['product_id'];?>">
								<img src="images/<?php echo $product['image']?>" height="100px;" width="100px;">
								<p><?php echo $product['product_name']?></p>
								<p><?php echo $product['product_price']?></p>
							</a>
						</div>
						<?php endwhile; ?>
					</div>

				<?php else: ?>
					<p>Khong co san pham</p>
				<?php endif;?>
			</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>