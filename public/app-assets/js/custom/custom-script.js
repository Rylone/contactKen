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
/****************************************************************** */
function pagination(page)
{
	$.ajax({
		url : "http://contactken/api/index?page="+page,
		type : "POST",
		data : {},
		success:function(res){
			// faire une fonction pour foreach
			// envoyer nb totale en json pour stopper le next comme suit: totale => counttotale
// si res/lenght <10 envoyé message ou desactiver pagination
		   console.log(res)
		   res.forEach(data=>{
			$('.ul').prepend('<li>'+ data.first_Name +'</li>');
			   console.log(data.first_Name)
		   })
	   	},
		error:function(){

	   	}
	})
}