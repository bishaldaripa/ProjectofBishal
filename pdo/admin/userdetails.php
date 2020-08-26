<?php 
session_start();
 define("ROW_PER_PAGE",2); 
include_once "../includes/database.php";
 $search_keyword = '';
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $search_keyword = $_POST['search'];
    }
    $sql = 'SELECT * FROM accounts WHERE YourName LIKE :keyword ';
    
    
    $per_page_html = '';
    $page = 1;
    $start=0;
    if(!empty($_POST["page"])) {
        $page = $_POST["page"];
        $start=($page-1) * ROW_PER_PAGE;
    }
    $limit=" limit " . $start . "," . ROW_PER_PAGE;
    $pagination_statement = $connection->prepare($sql);
    $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    $pagination_statement->execute();

    $row_count = $pagination_statement->rowCount();
    if(!empty($row_count)){
        $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
        $page_count=ceil($row_count/ROW_PER_PAGE);//ceil is used to convert interger
        if($page_count>1) {
            for($i=1;$i<=$page_count;$i++){
                if($i==$page){
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                } else {
                    $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                }
            }
        }
        $per_page_html .= "</div>";
    }
    
    $query = $sql.$limit;
    $pdo_statement = $connection->prepare($query);
    $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
 ?> 


 
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="../css/userdetails_search.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark indigo mb-4">


  <a class="navbar-brand" href="#">Navbar</a>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <form class="form-inline ml-auto" action="" method="POST">
      <div class="md-form my-0">
        <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="search">
      </div>
      <button href="#!" class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit">Search</button>
    

  </div>
  

</nav>
	<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Editable table</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Job</th>
            <th class="text-center">Cpassword</th>
            <th class="text-center">Rpassword</th>
            <th class="text-center">image</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Remove</th>
          </tr>
        </thead>



	 <tbody>
          <tr>
            <?php
            foreach ($result as $res) {
              
            ?>
           
            <td class="pt-3-half" contenteditable="true"><?php echo $res->YourName ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->YourEmail ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->Phone ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->Job ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->Createpassword ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->Repeatpassword ?></td>
            <td class="pt-3-half" contenteditable="true"><?php echo $res->img_file ?></td>
            <td>
              <span class="table-remove"><a href="edit_userdetails.php?id=<?php echo $res->ID ?>" class="btn btn-primary btn-rounded btn-sm my-0">edit </a></span>
            </td>
            <td>
              <span class="table-remove"><a href="delete_userdetails.php?id=<?php echo $res->ID ?>" class="btn btn-primary btn-rounded btn-sm my-0">remove </a></span>
            </td>
            </tr>
            <?php
            }
            ?>
          </tbody>


</table>

 <?php echo $per_page_html; ?>
 </form>
</div>
</div>
</div>
</body>
</html>