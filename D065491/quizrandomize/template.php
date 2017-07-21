<?php

function template_header(){
	echo '
		<!DOCTYPE HTML>
		<html>
		<head>
			<title>Quiz randomizer For Programing Question Bank System</title>
			<link rel="stylesheet" type="text/css" media="all" href="style.css" />
			<link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="style-narrow.css" />
			<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
			<script type="text/javascript" src="script.js"></script>

			<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
			<meta name="apple-mobile-web-app-capable" content="yes">
		</head>

		<body>
			<div id="page">
				<a><h2>Quiz maker For Programing Question Bank System</h2></a>
	';
}

function template_footer(){
	echo '
		</div>
		</body>
		</html>
		';
}

function template_welcome($error=''){
	template_header();
	echo '
		<div id="start">
			<div id="description">
				<strong>This tool creates randomized quizzes for you for current question and answer store in database.<p></strong> Enter as many questions as you like, each with as many possible answers as you
				like the tool will export a document containing different versions of that quiz.</p> In each quiz, the questions will be in a different order. The document exported is
				in <a href="http://en.wikipedia.org/wiki/Rich_text_format" target="_blank">Rich Text Format (RTF)</a> and is viewable (and editable) in Microsoft Word, Apple\'s
				Pages, OpenOffice and very many others.</p>
				<p><strong> Step to use it</strong></p>
				<p> For new using this quiz tool enter the new quiz</p>
				<p> If already have use it can either enter new quiz or open the current quiz you had made</p>
				<p> After enter new quiz please fill up all information needed for making quiz.When want to insert question and answer please manually copy and paste from listing question in the system.<a href="http://localhost/D065491/lecturer.php" target="_blank">View Question</a></p>
				<p>Hope you like the tool created for you.</p>
			</div>

			<form id="start" method="post" enctype="multipart/form-data">

				<div class="button">
					<button type="submit" name="start" class="start" id="button-new" value="new" icon="new">New quiz</button>
				</div>

				<div class="button">
					<button type="button" class="start" id="button-open" onclick="upload();" icon="open">Open existing quiz</button>
				</div>

				<input type="file" name="open-file" id="open-file" />
			</form>

		</div>
	';

	if($error){
		echo '<div class="error">'.$error.'</div>';
	}

	template_footer();
}

function template_form($error='',$script=''){
	template_header();

	if($script){
		echo $script;
	}

	if($error){
		echo '<div class="error">'.$error.'</div>';
	}

	echo '
		<form id="form" method="post" enctype="multipart/form-data">

			<div id="controls">

				<label for="title">Quiz title</label>
				<input name="title" id="title">

				<label for="instructions">Instructions</label>
				<textarea name="instructions" id="instructions"></textarea>

				<label for="versions-num">How many versions of the quiz?</label>
				<select name="versions-num" id="versions-num">

	';

	for($i=1; $i<=5; $i++){
		 echo '<option value="'.$i.'">'.$i.'</option>';
	}

	echo '
				</select>

				<label for="randomize-order">Randomize the order of questions</label>
				<input type="checkbox" name="randomize-order" id="randomize-order">

			</div>

			<div id="questions">
			</div>

			<button onclick="add_question()" type="button" class="add">
				<span class="icon plus">+</span>
				Add a question
			</button>

			<button type="submit" name="export" class="export" value="cancel" id="button-cancel" icon="cancel">Cancel</button>

			<div class="button">
				<span>If you want to carry on later,</span>
				<button type="submit" name="export" class="export" value="json" id="button-json" icon="save">Save quiz</button>
			</div>

			<div class="button">
				<span>If you\'re finished,</span>
				<button type="submit" name="export" class="export" value="rtf" id="button-rtf" icon="export">Export quiz</button>
			</div>

		</form>
	';

template_footer();
}
?>
