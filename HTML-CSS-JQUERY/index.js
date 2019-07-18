$( "#form" ).submit(function( event ) {
	let name = $("#name");
	let lastName = $("#lastName")
	let language = $("#language option:selected").text();
	let grid = $("#grid");
	grid.append("<div>"+name.val()+"</div>"+"<div>"+lastName.val()+"</div>"+"<div>"+language+"</div>");
	
	name.val("");
	lastName.val("");
	$('#language option[value="JavaScript"]').prop('selected', true);
});