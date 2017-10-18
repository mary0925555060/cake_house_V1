<?php
require_once("../../connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){

    //取得檔名
    $path = $_FILES['picture']['name'];
    //取得副檔名
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    //重新命名, 2位數加時間
    $filename = rand(10,100).date('His').".".$ext;
    move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/products/".$filename);   // 搬移上傳檔案
  }else{
    $filename = $_POST['picture1'];
  }


  $sql= "UPDATE product SET picture =:picture,
            name = :name,
            price = :price,
            remain = :remain,
            description = :description,
            undatedDate = :undatedDate WHERE productID=:productID";
  $sth = $db ->prepare($sql);

  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":remain", $_POST['remain'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":undatedDate", $_POST['undatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":productID", $_POST['productID'], PDO::PARAM_INT);
  $sth -> execute();

  header("Location: list.php?product_categoryID=".$_POST['product_categoryID']);
}
$sth = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
$product = $sth->fetch(PDO::FETCH_ASSOC);

 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/validator.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
    <div class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sweet House</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#">頁面管理</a>
            </li>
            <li class="active">
              <a href="#">最新消息管理</a>
            </li>
            <li>
              <a href="#">產品管理</a>
            </li>
            <li>
              <a href="#">訂單管理</a>
            </li>
            <li>
              <a href="#">會員管理</a>
            </li>
            <li>
              <a href="#">登出</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">產品管理</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li>
                <a href="#">主控台</a>
              </li>
              <li>
                <a href="#">產品管理</a>
              </li>
              <li class="active">新增一筆</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <div class="col-sm-2">
                      <label for="picture" class="control-label">產品圖片</label>
                    </div>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="picture" name="picture" data-error="Bruh, that email address is invalid">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-2">
                        <label for="name" class="control-label">產品名稱</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="name" class="form-control" id="name" name="name" data-error="Bruh, that email address is invalid" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                          <label for="price" class="control-label">價格</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="price" name="price" data-error="Bruh, that email address is invalid" required>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-2">
                            <label for="remain" class="control-label">保存期限</label>
                          </div>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="remain" name="remain" data-error="Bruh, that email address is invalid" required>
                            <div class="help-block with-errors"></div>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                              <label for="description" class="control-label">商品說明</label>
                            </div>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="description" name="description" data-error="Bruh, that email address is invalid" required>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2 text-right">
                    <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
                    <input type="hidden" name="MM_update" value="UPDATE">
                    <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
                    <button type="submit" class="btn btn-primary">送出</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>Sweet House</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>

</body></html>