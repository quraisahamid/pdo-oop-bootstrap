<?php
include_once 'dbconfigadd.php';
if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $topic = $_POST['topic'];
    $subject = $_POST['subject'];
    $question_text = $_POST['question_text'];
    $answer_text = $_POST['answer_text'];
    
    if($question->update($id,$topic,$subject,$question_text,$answer_text))
    {
        $msg = "<div class='alert alert-info'>
                <strong>Success</strong> Record was updated successfully <a href='lecturer.php'>HOME</a>!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                <strong>SORRY!</strong> ERROR while updating the record !
                </div>";
    }
}

if(isset($_GET['edit_id']))
{
    $id = $_GET['edit_id'];
    extract($question->getID($id)); 
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
    echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
     
     <form method='post'>
     <table class='table table-bordered'>
 
    <tr>
            <td>Programming Topic</td>
            <td><input type='text' name='topic' class='form-control' value="<?php echo $topic; ?>" required></td></td>
        </tr>
        <tr>
            <td>Programming Language</td>
            <td><input type='text' name='subject' class='form-control' value="<?php echo $subject; ?>" required></td></td>
        </tr>
 
 
        <tr>
            <td>Question</td>
            <td><input type='text' name='question_text' class='form-control' value="<?php echo $question_text; ?>" required></td></td>
        </tr>
 
        <tr>
            <td>Answer</td>
            <td><input type='text' name='answer_text' class='form-control' value="<?php echo $answer_text; ?>" required></td>
        </tr>
 
        
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>