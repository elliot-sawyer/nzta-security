var components_json = [];
var component_tags = [];
var component_list = [];
var component_controls = [];
var url = '';

/**
 * Handle the on page ready event. We load
 * the questions into a variable then display the
 * first one
 * @returns
 */
$(document).ready(function() {	
	url = document.getElementById('url_prefix').value + '/load-components';
	$.getJSON(url,function(data,status) {
	  components_json = data;		
		load_component_tags();
		
		document.getElementById("selection").focus();
	},'json');
	
	$("#selection")[0].addEventListener("keydown", function(e){ handle_selection_enter(e); });
	$("#add-button")[0].addEventListener("click", function(){ add_selection_to_list(); });
});

/**
 * 
 * @returns
 */
function load_component_tags() {
  for (var i = 0; i < components_json.length; i++) {
    component_tags.push(components_json[i]['name']);
  }
  
  $( "#selection" ).autocomplete({
    source: component_tags
  });
}
 
/**
 * 
 * @returns
 */
function handle_selection_enter(event) {
  if (event.keyCode === 13) {
    add_selection_to_list();
  }
}

/**
 * 
 * @returns
 */
function add_selection_to_list() {
  $("#question-input-error")[0].innerHTML = '';
  var selection = $("#selection")[0].value;
  
  if(component_tags.indexOf(selection) < 0) {
    var error_text = 'Sorry, ' + selection + ' is not a known component. Please engage your Security Architect to have it added';
    $("#question-input-error")[0].innerHTML = `<div class="alert alert-danger" style="margin: 10px 10px 10px 10px"><strong>Whoops! Something went wrong!</strong><br><ul>${error_text}</ul></div>`;
    return;
  }
  
  if(component_list.indexOf(selection) >= 0) {
    var error_text = 'Sorry, ' + selection + ' is already in your list of components';
    $("#question-input-error")[0].innerHTML = `<div class="alert alert-danger" style="margin: 10px 10px 10px 10px"><strong>Whoops! Something went wrong!</strong><br><ul>${error_text}</ul></div>`;
    return;
  }
  
  component_list.push(selection);
  update_component_list();  
  
  url = document.getElementById('url_prefix').value + '/load-component-controls?name=' + selection;
  $.getJSON(url,function(data,status) {
    component_controls[selection] = data;   
    update_component_controls();
    document.getElementById('selection').value = '';
  },'json');
  
  document.getElementById("selection").focus();
  document.getElementById('selection').value = '';
}

/**
 * This function will update the question list on the side with
 * different icons and links depending on the progress that has been made
 * through the questionaire.
 * 
 */
function update_component_list() {
	var ql = $("#component-list")[0];	
	var i;
	var text = '';
	for (i = 0; i < component_list.length; i++) { 
    text += (`<li><span class="icon icon-primary fa-minus" style="color: #0000AA;"></span>`);    
    text += (`&nbsp;${component_list[i]}&nbsp;`);
    text += (`<a onclick="delete_selection(` + i + `)" class="clean-link">`);
    text += (`<span class="icon icon-primary fa-minus-square" style="color: #AA0000;"></span></a>`);
    
	}
	ql.innerHTML = text;	
}

/**
 * 
 * @param index
 * @returns
 */
function delete_selection(index) {
  for (var i = 0; i < component_controls.length; ++i) {
    if (component_controls[i] == component_list[index]) {
      component_controls.splice(i, 1);
      break;
    }
  }
  
  component_list.splice(index, 1);
  
  update_component_list();
  update_component_controls();
}

/**
 * 
 * @returns
 */
function update_component_controls() {
  var obj = $("#selected-components")[0]; 
  var i;
  var text = '';
  for (i = 0; i < component_list.length; i++) { 
    text += `<span class="icon icon-primary fa-minus" style="color: #0000AA;"></span>`;    
    text += `&nbsp;<span style="font-weight: bold">${component_list[i]}&nbsp;</span>`;
    text += `<a onclick="delete_selection(` + i + `)" class="clean-link">`;
    text += `<span class="icon icon-primary fa-minus-square" style="color: #AA0000;"></span></a><br/>`;
    
    for (j = 0; j < component_controls[component_list[i]].length; ++j) {
      text += `<input type="checkbox"/>&nbsp;`;
      text += component_controls[component_list[i]][j]['name'] + '<br/>';
    }
    
    text += `<br/>`;
    
  }
  obj.innerHTML = text;   
}
