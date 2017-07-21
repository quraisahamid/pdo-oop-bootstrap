<?php
include_once 'dbconfigadd.php';
if(isset($_POST['btn-save']))
{
    $topic = $_POST['topic'];
    $level = $_POST['level'];
    $question_text = $_POST['question_text'];
    $answer_text = $_POST['answer_text'];
     $user_name = $_POST['user_name'];

    
    if($question->create($topic,$level,$question_text,$answer_text,$user_name))
    {
        header("Location: add-data.php?inserted");
    }
    else
    {
        header("Location: add-data.php?failure");
    }
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
    <div class="alert alert-info">
    <strong>OK</strong> Question was inserted successfully <a href="lecturer.php">HOME</a>!
    </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
    <div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while inserting question !
    </div>
    </div>
    <?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>

</head>

<body>

<div class="clearfix"></div><br />


<div class="container">
<div class="clearfix">
<div class="h5"  align="center"><strong>welcome :</strong><strong> <?php print($userRow['user_name']); ?></strong></div>

    
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Programming Topic</td>
            <td><select name="topic" class="form-control" required>
                                            <option value="" disabled>Topic in PHP</option>
                                            <option value="Introduction">Introduction</option>
                                            <option value="Syntax">Syntax</option>
                                            <option value="Variable">Variable</option>
                                            <option value="Echo">Echo</option>
                                            <option value="Data Type">Data Type</option>
                                            <option value="Constant">Constant</option>
                                            <option value="Array">Array</option>
                                            <option value="Function">Function</option>
                                            <option value="Session and Cookies">Session and Cookies</option>
                                        </select></td>
        </tr>
         <tr>
            <td>Level</td>
        <td><select name="level" class="form-control" required>
                                            <option value="" disabled>Difficulty Level</option>
                                            <option value="Level 1">Level 1(knowledge)</option>
                                            <option value="Level 2">Level 2(comprehension)</option>
                                            <option value="Level 3">Level 3(application)</option>
                                        </select></td>
        </tr>
 
 
        <tr>
            <td>Question</td>
            <td><input type='text' name='question_text' class='form-control' placeholder="only text no numeric  eg: what is php? data" required></td>
        </tr>
 
        <tr>
            <td>Answer</td>
            <td><input type='text' name='answer_text' class='form-control' placeholder="only text no numeric eg: PHP:pre hypertext processor" required></td>
        </tr>
         <tr>
            <td>Username</td>
            <td><input type='text' name='user_name' class='form-control' placeholder="your username" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
            <span class="glyphicon glyphicon-plus"></span> Create New Question
            </button>  
            <a href="lecturer.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

</body>
</head>
</html>