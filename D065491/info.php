<?php include_once 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron">
  <div class="container">
    <p><STRONG>Information for lecturer</STRONG></p>
   <div class="clearfix">
<div class="h5"  align="center"><strong>welcome :</strong><strong> <?php print($userRow['user_name']); ?></strong></div>


       <div class="container">
  <h2>Please Read Here to use the system</h2>
  <p><strong>Note:</strong> The <strong>System</strong> is use to storing the question and random question</p>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Add Question and Related Info</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">Before you want to add new question you need to know something about the related data to be put on. Programming topic is where you will put on the topic related to programming. While level is referring to what level difficulty you want preset. Question and anwser you will put on for last two row. </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">View Question</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">In here when you want to add new question, you may looking back question and answer you have already put.Then you may <strong>Delete</strong> in the same page in the delete button provide.</div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Make Quiz</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body"> Make Quiz button you be able to make new quiz set. then you may also <strong>export the set question has been made. You will be re-direct to new tab only to use the quiz randomizer tool.</strong></div>
      </div>
    </div>
    </div>
  </div> 
</div>

</div>
</body>
</html>