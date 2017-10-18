<?php
//限制存取頁面
require_once("../template/login_check.php");
require_once("../../connection/database.php");
$limit = 10;
//判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
//計算要從第幾筆開始S
$start_from = ($page-1) * $limit;
$sth = $db->query("SELECT * FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$all_news = $sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($all_news);

 ?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="..\css\admin.css" rel="stylesheet" type="text/css">
  </head><body>
    <div class="navbar navbar-default navbar-static-top">
      
        <?php require_once("../template/nav.php"); ?>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="text-left">最新消息管理</h1>
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
                <a href="#" class="active">最新消息管理</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <a href="add.php" class="btu btu-default">新增一筆</a>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>發佈日期</th>
                  <th>標題</th>
                  <th>編輯</th>
                  <th>刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($all_news as $row){ ?>
                <tr>
                  <td><?php echo $row['publishedDate']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><a href="edit.php?newsID=<?php echo $row['newsID'];?>">編輯</a></td>
                  <td><a href="delete.php?newsID=<?php echo $row['newsID'];?>" onclick="if(!confirm('是否刪除此筆資料？')){return false;};">刪除</a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <?php  if($totalRows > 0){
                $sth = $db->query("SELECT * FROM news ORDER BY PublishedDate DESC ");
                $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
                $total_pages = ceil($data_count / $limit);
               ?>
            <ul class="pagination">
              <?php   if($page > 1){ ?>
                <li>
                  <a href="list.php?page=<?php echo $page-1;?>">上一頁</a>
                </li>
                <?php }else{ ?>
                  <li>
                    <a href="#">上一頁</a>
                  </li>
                  <?php } ?>
              <?php for ($i=1; $i<=$total_pages; $i++) { ?>

              <li>
                <a href="list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
              <?php } ?>
              <?php if($page < $total_pages){ ?>
              <li>
                <a href="list.php?page=<?php echo $page+1;?>">下一頁</a>
              </li>
              <?php }else{ ?>
                <li>
                  <a href="#">下一頁</a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <footer class="section section-primary">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>聖保羅廚房</h1>
            <p contenteditable="true">版權所有 © 2016 &nbsp; St Paul Kitchen All Right Reserved.</p>
          </div>
        </div>
      </div>
    </footer>


</body></html>
