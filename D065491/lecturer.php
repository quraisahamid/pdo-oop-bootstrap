
<?php include_once 'dbconfigadd.php'; ?>

<?php include_once 'header.php'; ?>

<?php

    require_once("session.php");
    
    require_once("class.user.php");
    $auth_user = new USER();
    
    
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
  

<!DOCTYPE html>
<html>
<head>
    <title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<style type="text/css">
   body { background: #62C8FB !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>
</title>
</head>
<body>
<div class="clearfix">
<div class="h5"  align="center"><strong>welcome :</strong><strong> <?php print($userRow['user_name']); ?></strong></div>

</div>
        

<div class="clearfix"></div>

<div class="clearfix"></div>


 <div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Question</a>
</div>



<div class="clearfix"></div><br />

<div id="question"  class="container" >
     <table class='table table-bordered table-responsive'>
     <tr>
     <th>Programming Topic</th>
     <th>Level</th>
     <th>Question</th>
     <th>Answer</th>
     <th>Contributor</th>
     <th>Date</th>
     <th colspan="2" align="center">Delete</th>
     </tr>
     <?php
        $query = "SELECT * FROM question ORDER BY  level ASC";       
        $records_per_page=6;
        $newquery = $question->paging($query,$records_per_page);
        $question->dataview($newquery);
     ?>
    <tr>
        <td colspan="7" align="center">
            <div class="pagination-wrap">
            <?php $question->paginglink($query,$records_per_page); ?>
            </div>
        </td>
    </tr>
 
</table>

       
</div>



</body>
</html>
