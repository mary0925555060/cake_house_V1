<?php
require_once("../connection/database.php");
$sth = $db->query("SELECT * FROM product_category");
$categories = $sth->fetchAll(PDO::FETCH_ASSOC);

$sth2 = $db->query("SELECT * FROM product ");
$product = $sth2->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">

			<div class="header">
				<div>
					<h1>Products</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li class="active"><a href="#">蛋糕</a></li>
				</ol>
				<ul class="name">

          <li><a href="product_name.php">全部商品</a></li>
					<?php foreach ($categories as $row) { ?>
					<li><a href="product_name.php?product_categoryID=<?php echo $row['product_categoryID']?>"><?php echo $row['category']; ?></a></li>
					<?php } ?>
				</ul>
				<ul id="Products">
					<?php foreach ($product as $row){ ?>
					<li>
						<a href="product_content.php?productID=<?php echo $row["productID"];?>"><img src="../uploads/products/<?php echo $row['picture']; ?>" width="200" height="150" alt=""></a>
						<a href="product_content.php?productID=<?php echo $row["productID"];?>"><h2><?php echo $row["name"]; ?></h2></a>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
</body>
</html>
