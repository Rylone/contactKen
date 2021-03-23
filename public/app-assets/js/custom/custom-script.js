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

	// je fais ma requete a ajax pour appeler la fonction delete
	// var param = {
	// 	  id : $(this).data('ref')
	//   };
	//  postToApi("create", param);       

	console.log("j'ai cliqué sur mon bouton") ;
	console.log($('#first_name').val())
	e.preventDefault();
 });