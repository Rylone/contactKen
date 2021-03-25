/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
/* paremetrage de ma pagination */
var page = 1;
var idContact = null;
/* ---------------------- */

/******* fonction d'appel API ******/
function postToApi(url, dataParams)
{
	$.ajax({
		url : "http://contactken/api/" + url,
		type : "POST",
		data : dataParams,
		success:function(){
		   
	   	},
		error:function(){

	   	}
	})

}

$('.add-contact').on('click', function (e) {
	e.preventDefault();
	var param = $("#formContact").serialize();
	postToApi("create", param);
 });

 /**************************************** EXERCICES *****************************************************/
$(".one").on('click', function(e){
	// remove() => supprimé, hide() => caché, toggle => donne et enleve class
	$("p").addClass('select')
})

$("button.go").on('click', function(e){
	// remove() => supprimé, hide() => caché, toggle => donne et enleve class
	
})

/*****************************************************************/
$(".two").on('click', function(e){
	$("p").removeClass('select')
})
/****************************************************************** */
$(".btn4").on('click', function(e){
	console.log("j'ajoute à la fin");
	$('ul').append('<li>Hello</li>');
})
/****************************************************************** */
$(".tree").on('click', function(e){
	console.log("j'ajoute au début");
	$('ul').prepend('<li>Hello</li>');
})
/****************************************************************** */
$(".next").on('click', function(e){
	// si  page > pagetotale page sera egale à page totale
	page = page + 1;
	$(".waiting").show()
	// pagination(page)
})
$(".previous").on('click', function(e){
		// si  page < 1 page sera egale à 1
	 page = page - 1;
	 pagination(page)
})
/*******************************edit contact ************************************/
$(".up").on('click', function(e){
idContact = $(this).data('id');
var param = {
		id : $(this).data('id')
	};
		$.ajax({
		url : "http://contactken/api/edit",
		type : "POST",
		data : param,
		success:function(res){
			 $('#first_Name').val(res.response.first_Name);
			 $('#last_Name').val(res.response.last_Name);
			 $('#company').val(res.response.company);
			 $('#business').val(res.response.job);
			 $('#email').val(res.response.email);
			 $('#phone').val(res.response.phone);
			 $('#note').val(res.response.note);
	   	},
		error:function(){

	   	}
	})
})

$(".update-contact").on('click', function(e){
	//console.log( $(this).data('id'));
	console.log(idContact);
	var param =  "id="+idContact+"&"+ $("#formContact").serialize()
	console.log(param)
	postToApi("edit", param);
})

/****************************************************************** */
$(".newpreced").on('click', function(e){
	page = page - 1;
	pagination(page)

	console.log('ok')
})
$(".newnext").on('click', function(e){
	page = page + 1;
	pagination(page)
	console.log('ok')
})

/****************************************************************** */
function pagination(page)
{
	// $itemByPage = 10;
	// $limitDebut = 
	
	$.ajax({
		url : "http://contactken/api/index?page="+page,
		type : "POST",
		data : {},
		success:function(res){
			// faire une fonction pour foreach
			// envoyer nb totale en json pour stopper le next comme suit: totale => counttotale
			// si res/lenght <10 envoyé message ou desactiver pagination
			$('#listContact').html('');
			res.forEach(data=>{
				$('#listContact').append(
					`<tr class='up list-tr' data-id ="90">
					<td class="center-align contact-checkbox">
						<label class="checkbox-label">
							<input type="checkbox" name="foo" data-group ="ici" />
						<span></span>
						</label>
					</td>
					<td><span class="avatar-contact avatar-online"><img src="../../../app-assets/images/avatar/avatar-1.png"alt="avatar"></span></td>
					<td>${data.last_Name+' '+data.first_Name}</td>
					<td>${data.email}</td>
					<td></td>
					<td><span class="favorite" ><i  data-ref="90" data-name="English" class="material-icons"> star_border </i></span></td>
					<td><span class="trash" ><i  data-ref="90"  class="material-icons delete">delete_outline</i></span></td>
					</tr>`
				)
			})
	   	},
		error:function(){
			
	   	}
	})
}
function updateTr()
{
	return `<tr class='up list-tr' data-id ="90">
	<td class="center-align contact-checkbox">
	  <label class="checkbox-label">
		<input type="checkbox" name="foo" data-group ="ici" />
		<span></span>
	  </label>
	</td>
	<td><span class="avatar-contact avatar-online"><img src="../../../app-assets/images/avatar/avatar-1.png"
		  alt="avatar"></span></td>
	<td>English Palmer</td>
	<td>purus@sed.co.uk</td>
	<td></td>
	<td><span class="favorite" ><i  data-ref="90" data-name="English" class="material-icons"> star_border </i></span></td>
	<td><span class="trash" ><i  data-ref="90"  class="material-icons delete">delete_outline</i></span></td>
  </tr>`
}