function add_question(){
	question = $('#questions').children().length+1;
	
	//Question container
	container = $('<div/>', {
		class: 'question'
    });
	$('#questions').append(container);
	
    //Question number
    $('<div/>', {
    	text: question,
    	class: 'question-number'
    }).appendTo(container);

    //Question input
    $('<input/>', {
    	name: 'questions[]',
    	class: 'question-input',
    	placeholder: 'Question'
    }).appendTo(container);
   
    //Answer labels
    $('<div/>', {
    	class: 'answer-labels',
    	html: 'Correct answer:<br />Other answers:'
    }).appendTo(container);
    
    //Answers container
    $('<div/>', {
    	class: 'answers'
    }).appendTo(container);

    //Delete button
    $('<button/>', {
    	type: 'button',
    	class: 'delete',
    	onclick: 'remove_question(this)',
    	html: '&times;',
    	tabindex: '-1'
    }).appendTo(container);
        
    //Answers
    add_answer(question);
    add_answer(question);
}

function remove_question(question_button){
	console.log('Removing question');
	$(question_button).parent().remove();
	renumber_questions();
}

function renumber_questions(){
	$('#questions').children().each(function(question){
		$(this).children('.answers').children().each(function(){
			$(this).children('input').attr('name','answers['+question+'][]');
		});
		question=question+1;
		$(this).children('div.question-number').html(question);
	});
}

function add_answer(question){
    $('<input/>', {
    	name: 'answers['+(question-1)+'][]',
    	onfocus: 'answer_focus(this)',
    	onblur: 'answer_blur(this)',
    	onkeyup: 'answer_change(this)'
    }).appendTo($('#questions').children().eq(question-1).children('.answers')); 
}

function adjust_answer_number_height(question){
	var a = $('#questions').children().eq(question-1).height();
    var b = $('#questions').children().eq(question-1).children('.question-number').height();   
    $('#questions').children().eq(question-1).children('.question-number').css({top: Math.ceil((a-b)/2)+'px'});
}

function answer_focus(answer){
	answers_num = $(answer).parent().children().length;
	answer_id = $(answer).index()+1;
	question = $(answer).parent().parent().index()+1;
	if(answer_id>1 && answer_id==answers_num){

	}
}

function answer_blur(answer){
	answers_num = $(answer).parent().children().length;
	answer_id = $(answer).index()+1;
	question = $(answer).parent().parent().index()+1;
	if(answer_id<=(answers_num-2) && answer_id>1 && !$(answer).val()){
		//Answer is not at the end but has just been blanked, remove it
		console.log('Removing answer '+(answer_id)+' from question '+question);
		$(answer).remove();
		adjust_answer_number_height(question);
	}
}

function answer_change(answer){
	answers_num = $(answer).parent().children().length;
	answer_id = $(answer).index()+1;
	if(answer_id==answers_num && answer_id>1 && $(answer).val()){
		//If this is currently the last answer, create another one if something is typed in this box
		console.log('Adding answer '+(answer_id+1)+' to question '+question);
		add_answer(question);
		adjust_answer_number_height(question);
	}else if(answer_id==(answers_num-1) && answer_id>1 && !$(answer).val()){
		//If this is currently the penulimate answer, remove the last one if this box is empty
		console.log('Removing answer '+(answer_id+1)+' from question '+question);
		$(answer).parent().children().eq(answer_id).remove();
		adjust_answer_number_height(question);
	}
}

function upload(){
	//When user clicks on for-show button, trigger click of actual file upload field
	$('form#start input#open-file').focus().trigger('click');
}

function set_field(field){
	value = opened[field];
	$('[name='+field+']').val(value);
}

function process_upload(){
	console.log("Beginning to open quiz called '"+opened.title+"'.");
	set_field('title');
	set_field('instructions');
	set_field('versions-num');
	for(var question=0; question<opened.questions.length; question++){
		add_question();
		$('#questions').children().eq(question).children('input.question-input').val(opened.questions[question]);
		for(answer=0; answer<opened.answers[question].length; answer++){
			if(opened.answers[question][answer]){
				if(answer>1){ add_answer(question+1);}
				$('#questions').children().eq(question).children('.answers').children().eq(answer).val(opened.answers[question][answer]);
			}
		}
		
		if(answer>2){ add_answer(question+1); }
		adjust_answer_number_height(question+1);
	}
}

$(window).on('beforeunload', function(){
	if($('input#title').length>0){
		return 'If you leave this page without saving your quiz, you will lose all your work. \n\nEven if you have exported it to RTF, you still will not be able to make any changes later using this tool unless you save a copy too. \n\nTo make a save, press \'save for later\', and a copy will be downloaded that you can continue working on.';
	}
});

$(document).ready(function(){
	$('form#form').submit(function() {
		$(window).off('beforeunload');
	});
	
	$('form#start input#open-file').on('change',function(){
		//A file has been selected, submit form
		$('form#start').trigger('submit');
	});
	
	$('button[icon]').each(function(){
		$(this).css('background-image', 'url("icons/'+$(this).attr("icon")+'.png")');
	});

});