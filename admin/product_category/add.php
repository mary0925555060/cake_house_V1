<?php
 require_once("../../connection/database.php");
 if (isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
    //圖片上傳
   if(isset($_FILES['picture']['category']) && $_FILES['picture']['category'] != null){
     if (!file_exists('../../uploads/products')) mkdir('../../uploads/products', 0755, true);//取得檔名
     $path = $_FILES['picture']['category'];
     //取得副檔名
     $ext = pathinfo($path, PATHINFO_EXTENSION);
     //重新命名, 2位數加時間
     $filecategory = rand(10,100).date('His').".".$ext;
     move_uploaded_file($_FILES['picture']['tmp_category'],"../../uploads/products/".$filecategory);   // 搬移上傳檔案
 }
   $sql= "INSERT INTO product_category(category , picture , createdDate , updatedDate) VALUES ( :category , :picture , :createdDate , :updatedDate)";
     $sth = $db ->prepare($sql);
     $sth ->bindParam(":category",$_POST['category'], PDO::PARAM_STR);
     $sth ->bindParam(":picture", $filecategory, PDO::PARAM_STR);
     $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
     $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
     $sth -> execute();

     header('Location: list.php');
 }
  ?>
<html><head>
    <meta charset="utf-8">
    <meta category="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/validator.min.js"></script>
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
            <h1 class="text-left">產品分類管理</h1>
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
                <a href="#">產品分類管理</a>
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
            <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="post">
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="category" class="control-label">分類名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="category" name=""="category" required>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="text" name="createdDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
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
