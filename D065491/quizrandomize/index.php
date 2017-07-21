<?php

	//echo "Post:";echo "<pre>";print_r($_POST);echo "</pre>";echo "<hr>";echo "Files:";echo "<pre>";print_r($_FILES);echo "</pre>"; //Uncomment for debug
	ERROR_REPORTING( E_ALL ^ E_WARNING ^ E_NOTICE);

	require_once('template.php');

	$version = "2.2.1"; //Version of the tool

	function filename($ext){
		if($_POST['title']){
			return str_replace(' ','-',strtolower($_POST['title'])).'.'.$ext;
		}else{
			return 'untitled.'.$ext;
		}

	}

	if($_POST['export']=='json'){
		//We're exporting to a .quiz file

		//Add and remove information from $_POST prior to exporting to JSON
		$creator=array(
		    "creator" => array(
		    	"name" => "Quiz Randomizer",
		    	"version" => $version
		    )
		);
		unset($_POST['export']);

		//Export a JSON file
		header('Content-type: application/quiz');
		header('Content-Disposition: attachment; filename="'.filename('quiz').'"');

		echo json_encode(array_merge($creator,$_POST));

		die;
	}

	if($_POST['export']=='rtf'){
		//We're exporting to RTF

		$questions = $_POST['questions'];
		$answers = $_POST['answers'];
		$versions_num=$_POST['versions-num'];

		//Error checking
		$actual_questions = 0;
		$answer_quantities = array();
		$empty_alternate_answers=false;
		$empty_correct_answers=false;
		foreach($questions as $question_num => $question){
			if($question){
				$actual_questions++;
				$answer_quantities[$question_num]=0;
				if(!$answers[$question_num][0]){ $empty_correct_answers=true; }
				foreach ($answers[$question_num] as $answer_num => $answer){
					if($answer){ $answer_quantities[$question_num]++; }
				}
			}
		}

		foreach($answer_quantities as $answer_quantity){
			if($answer_quantity<2){ $empty_alternate_answers=true; break; }
		}

		if($actual_questions==0){
			$error = 'You need to include at least one question before you can export.';
		}

		if($empty_correct_answers==true){
			$error = 'One or more of your questions did not a correct answer.';
		}

		if($empty_alternate_answers==true){
			$error = 'One or more of your questions did not have enough answers.';
		}

		if(!$_POST['title']){
			$error = 'Please give your quiz a title before exporting.';
		}

		if(!$error){
			header('Content-type: application/rtf');
			header('Content-Disposition: attachment; filename="'.filename('rtf').'"');

			echo '{\rtf1\brkfrm\ansi{\fonttbl\f0\fswiss Times New Roman;}';

			function letter($number){
				$letters = range('a', 'z');
				return $letters[$number-1];
			}

			function shuffle_assoc(&$array) {
			    $rand = array();
			    $keys = array_keys($array);
			    shuffle($keys);
			    foreach($keys as $key) {
			      $rand[$key] = $array[$key];
			      unset($array[$key]);
			    }
			    $array = $rand;
	    	}

	    	$correct_answers=array();

			for($quiz=1; $quiz<=$versions_num; $quiz++){

				echo '
	\pard\fs40 '.$_POST['title'].' - Version '.$quiz.' \qc
	\fs24\par\par '.$_POST['instructions'].' \ql\par\par';

				if ($_POST['randomize-order']) {
					shuffle_assoc($questions);
				}

				$question_index = 1; foreach($questions as $question_num => $question){
					if($question){
						echo '
	{\keepn {\b '.$question_index.'. '.$question.'} \par';

						shuffle_assoc($answers[$question_num]);
						$answer_index=1; foreach($answers[$question_num] as $answer_num => $answer){
							if($answer){
								if($answer_num==0){ $correct_answers[$question_index][$quiz]=letter($answer_index); }
								echo '
	\li400 '.letter($answer_index).')	'.$answer.' \par';
								$answer_index++;
							}
						}
					$question_index++;
					echo '
	} \par';
					}
				}
				echo '
	\page';
			}

			//Answer key
			echo '
	\pard\fs40 '.$_POST['title'].' - Answer key \qc
	\fs24\par\par\par\par ';

			echo '{\b			';
			for($i=1; $i<=$versions_num; $i++){
				echo 'Version {'.$i.'}	';
			}
			echo '} \ql \par\par';

			foreach($correct_answers as $question => $question_correct_answers){
				echo '{\b Question '.$question.'.}';
				foreach($question_correct_answers as $correct_answer){
				echo '		'.$correct_answer;
				}
				echo ' \par\par ';
			}

			echo '}';

			die;
		}else{

			$script = '
				<script type="text/javascript">
					var opened = jQuery.parseJSON(\''.json_encode($_POST).'\');
					$(document).ready(function(){
						process_upload(opened);
					});
				</script>
			';
			template_form($error,$script);
			die;
		}
	}

	if($_FILES['open-file']){
		//We're starting a new quiz or opening an old one

		if(!$_POST['start']=='new'){
			//We're opening a file to begin editing

			if ($_FILES['open-file']['error'] > 0){
				$error = 'Sorry, there was an error opening your quiz: '.$_FILES["file"]["error"];
			}else{
				$ext = pathinfo($_FILES['open-file']['name'], PATHINFO_EXTENSION);
				if($ext!='quiz'){
					$error = 'Sorry, the file you opened is in the wrong format.';
					if($ext=='rtf'){
						$error .= ' You cannot import RTF files back into Quiz Randomizer � you need to have the .quiz file.';
					}
				}else{
					$opened_raw = file_get_contents($_FILES['open-file']['tmp_name']);
					$opened = json_decode($opened_raw);
					if($opened->creator->name!='Quiz Randomizer'){
						$error = 'Sorry, we currently do not support opening files that were not made by Quiz Randomizer itself.';
					}else if(($opened->creator->version)>$version){
						$error = 'This file was created by a newer version of Quiz Randomizer (v'.$opened->creator->version.') and cannot be opened by this version (v'.$version.').';
					}
				}
			}

			if($error){
				template_welcome($error);
			}else{
				$script = '
					<script type="text/javascript">
						var opened = jQuery.parseJSON(\''.$opened_raw.'\');
						$(document).ready(function(){
							process_upload(opened);
						});
					</script>
				';
				template_form($error,$script);
			}
		}else{
			//We're starting a new quiz
			template_form();
		}

	}else{
	//We haven't started a quiz yet
		template_welcome();
	}
 
?>
