var current_question = -1;
var questions = '';

var url = '';

/**
 * Handle the on page ready event. We load
 * the questions into a variable then display the
 * first one
 * @returns
 */
$(document).ready(function() {	
	url = document.getElementById('url_prefix').value + '/load-questions';
	$.getJSON(url,function(data,status) {
		questions = data;
		update_question_list();		
		load_next_question();
	},'json');
});

/**
 * This function will update the question list on the side with
 * different icons and links depending on the progress that has been made
 * through the questionaire.
 * 
 */
function update_question_list() {
	var ql = $("#question-list")[0];	
	var i;
	var text = '';
	for (i = 0; i < questions.length; i++) { 
		if (i < current_question) {
	    text += (`<li><span class="icon icon-primary fa-check" style="color: #00AA00;"></span>`);
      text += (`<a onclick="load_question(` + i + `)" class="clean-link">`);
      text += (`&nbsp;${questions[i].title}</a>`);
      
		} else if ((typeof questions[i]['answers'] !== 'undefined') || (typeof questions[i]['answer'] !== 'undefined')) {
		  text += (`<li><span class="icon icon-primary fa-info-circle" style="color: #0000AA;"></span>`);
      text += (`<a onclick="load_question(` + i + `)" class="clean-link">`);
      text += (`&nbsp;${questions[i].title}</a>`);
      
		} else {
		  text += (`<li><span class="icon icon-primary fa-minus" style="color: #AA0000;"></span>`);
		  text += (`&nbsp;${questions[i].title}`);
		}
	}
	ql.innerHTML = text;	
}

function load_question(index) {
  current_question = index-1;
  load_next_question();
}

function load_next_question(chosen_answer) {	
	var question_text = '';
	var question_description = '';
	var answer_action = '';
	var inputs = $("#question-input")[0];
	var answers = $("#answers")[0];
	
	// Clear any errors
	$("#question-input-error")[0].innerHTML = '';
	$("#question-message")[0].innerHTML = '';
	
	/**
	 * Handle reading and storing the answers from the user
	 */
	
	if (chosen_answer) {
	  if (!questions[current_question])
	    questions[current_question] = new Object();
		questions[current_question]['question'] 	= questions[current_question]['question'];
		questions[current_question]['description'] = questions[current_question]['description'];
			 
		if (questions[current_question]['inputs']) {		
			// loop the inputs and get their values
			questions[current_question]['answers'] = {};
			var missing_fields = [];
			var answer  = {}
			questions[current_question]['inputs'].forEach(function(element) {
				var name 	= element['name'].replace(new RegExp(' ', 'g'), '_');
				element['answer'] = $('#' + name).val();
				if (element['answer'] == '') {
				  missing_fields.push(element['name']);
				}		
			});
			if (missing_fields.length > 0) {
			  var error_text = '';
        missing_fields.forEach(function(value) { 
          error_text += '<li>&raquo;&raquo; Please enter a value for ' + value;
        });
        $("#question-input-error")[0].innerHTML = `<div class="alert alert-danger" style="margin: 10px 10px 10px 10px"><strong>Whoops! Something went wrong!</strong><br><ul>${error_text}</ul></div>`;
        return;
			}
			
			questions[current_question]['answers'] = answer;
			answer_action = 'continue';				
		} else {
			var answer_text = questions[current_question]['actions'][chosen_answer]['text'];
			answer_action = questions[current_question]['actions'][chosen_answer]['action'];
			questions[current_question]['answer'] = answer_text;
		}
		
		// Save Answers back to database
	  /**
	   * Update our stored values
	   */
	  var xhr = new XMLHttpRequest();
	  var url = document.getElementById('url_prefix').value + '/save-answers';
	  xhr.open("POST", url, true);
	  xhr.setRequestHeader("Content-Type", "application/json");
	  xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById('_token').value);  
	  xhr.onreadystatechange = function () {
	      if (xhr.readyState === 4 && xhr.status === 200) { 
	        var myArr = JSON.parse(this.responseText);
	      }
	  };
	  var data = JSON.stringify(questions);
	  xhr.send(data);		
	}
	
	// Debug answers JSON
	$("#answers_debug")[0].innerHTML = 'Answers: <pre>' +  JSON.stringify(questions, null, 4) + '</pre>';
	
	/**
	 * Process the answer, if it's a message or create_task etc
	 */
	if (answer_action == 'message') {
		inputs.innerHTML = '';
		answers.innerHTML = '';
		$("#question-message")[0].innerHTML = questions[current_question]['actions'][chosen_answer]['message'];
		return;
	}
	
	/**
	 * Increment the question index, handling the "goto" action
	 */
	if (answer_action != 'goto') {
		current_question += 1;
		if (questions.length == current_question) {
			return display_done();
		}
	} else {
		var answer_target = questions[current_question]['actions'][chosen_answer]['target'];
		while (questions.length != current_question && questions[current_question]['id'] != answer_target)
			current_question += 1;
	}
	
	/**
	 * Update the question list on the left with progress
	 */	
	update_question_list();
	
	/**
	 * Display the question and description
	 */
	$("#question-text")[0].innerText = questions[current_question]['question']; 
	$("#question-description")[0].innerText = questions[current_question]['description'];	
	
	/**
	 * Display the input fields
	 */
	if (questions[current_question]['inputs']) {
		var output_text = '';
		questions[current_question]['inputs'].forEach(function(element) {
			var name 	= element['name'].replace(new RegExp(' ', 'g'), '_');
			var type    = element['type'];
			var text_types = [ 'text', 'numeric', 'date' ];
			var answer 	= element['answer'] ? element['answer'] : ''; 
			
			output_text += `<div class="row" style="margin-top: 0px;">`; 
			output_text += `<div class="col-sm-2 control-label">${element['name']}</div>`;
			output_text += `<div class="col-sm-6 wow">`;
			if (text_types.indexOf(type) >= 0) {
				output_text += `<input type="text" class="form-control" id="${name}" name="${name}" value="${answer}" required/>`;
				// text_box.addEventListener("keydown", function(e){ handle_enter(e); });
			} else if (type == 'email') {
			  output_text += `<input type="email" class="form-control" id="${name}" name="${name}" value="${answer}" required/>`;			
			} else if (type == 'textarea')
				output_text += `<textarea id="${name}" name="${name}" rows="10" cols="80" style="padding: 6px 12px;" required>${answer}</textarea>`;				
			output_text += `</div>`;
			output_text += `</div>`;	
		});
		
		inputs.innerHTML = output_text; 
	} else
		inputs.innerHTML = '';
	
	/**
	 * Display the answer options for the user
	 * 
	 */	
	answers.innerHTML = '';
	var previous_answer = questions[current_question]['answer'] ? questions[current_question]['answer'] : '';
	if (!questions[current_question]['actions']) {
	  if (previous_answer != '')
	    answers.innerHTML = `<div class="col-sm-6"><input type="button" class="btn btn-xs btn-primary-variant-1" style="background-color: green;" value="Continue" onclick="load_next_question(1);"/></div>`;	    
	  else
	    answers.innerHTML = `<div class="col-sm-6"><input type="button" class="btn btn-xs btn-primary-variant-1" value="Continue" onclick="load_next_question(1);"/></div>`;
	    
	} else {
		var output_text = '';
		questions[current_question]['actions'].forEach(function(element, index) {
		  if (previous_answer == element['text'])
		    output_text += `<div class="col-sm-4"><input type="button" class="btn btn-xs btn-primary-variant-1" style="background-color: green;" value="${element['text']}" onclick="load_next_question('${index}');"/></div>`;
		  else
		    output_text += `<div class="col-sm-4"><input type="button" class="btn btn-xs btn-primary-variant-1" value="${element['text']}" onclick="load_next_question('${index}');"/></div>`;
		});
		answers.innerHTML = output_text;
	}
}

function handle_enter(event) {	
    if (event.which == '13') {
    	event.preventDefault();    	
    }
}

function display_done() {
	$("#question-text")[0].innerText = "Finished"; 
	$("#question-description")[0].innerText = "Please click 'Submit' to review responses before sending request to Security Team and Business Owner";
	
	// clear the form fields
	$("#question-input")[0].innerHTML = '';
	$("#answers")[0].innerHTML = '';
	$("#question-input-error")[0].innerHTML = '';
	
	$("#answers")[0].innerHTML = `<div class="col-sm-6"><input type="button" class="btn btn-xs btn-primary-variant-1" value="Submit" onclick="submit_answers();"/></div>`;
		
	update_question_list();
}

function submit_answers() {
	window.location.href = document.getElementById('url_prefix').value + "/review-answers";	
}
