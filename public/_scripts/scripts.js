
function goToByScroll(id, height){
	if(height){
		$('html,body').animate({scrollTop: $("#"+id).offset().top-+height},1000, 'easeInOut');
	} else{
		$('html,body').animate({scrollTop: $("#"+id).offset().top-55},1000, 'easeInOut');
	}
}


$(document).ready(function() {


/* ////////////// BACKGROUND ROTATE */
/*
function bgRotate(){
//	setInterval('$("#bg1").fadeOut(1000);$("#bg2").fadeIn(1000);',3000);
	//Set the opacity of all images to 0
	$('ul#bg-rotator li').css({opacity: 0.0});
	
	//Get the first image and display it (gets set to full opacity)
	$('ul#bg-rotator li:first').css({opacity: 1.0});
		
	//Call the bg-rotator function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval(rotate(), 2000);
}


function rotate() {	

	//Get the first image
	var current = ($('ul#bg-rotator li.show')?  $('ul#bg-rotator li.show') : $('ul#bg-rotator li:first'));

	//Get next image, when it reaches the end, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('ul#bg-rotator li:first') :current.next()) : $('ul#bg-rotator li:first'));	

	//Set the fade in effect for the next image, the show class has higher z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);
	alert(next.attr("class"));
	//Hide the current image
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');
	
};

//Running
bgRotate();

*/


/* ////////////// SET UP THE PAGE HEIGHT */
//$("body").css("padding-bottom", eval($(window).height()*0.7));



/*	var randomImages=["_images/body-bg-1.jpg", "_images/body-bg-2.jpg", "_images/body-bg-3.jpg" , "_images/body-bg-4.jpg", "_images/body-bg-5.jpg"]
  var rndNum = Math.floor(Math.random() * randomImages.length);
  $("body").css({
		"background" : "url(" + randomImages[rndNum] + ") 0 0 no-repeat", 
		"background-color" : "#121315" 
	});
*/

/* ////////////// PAGE CALL FUNCTIONS  */

if(window.location.hash){
	if(window.location.hash == "#get-directions"){
		$("#get-directions-content").load("_includes/content-directions.html", function(){
			$("a.get-directions").hide();
			$("a.hide-directions").show();
////////			$.scrollTo($("#get-directions-content").offset().top-290, 1000, {easing:'easeInOut'} );
			goToByScroll('get-directions-content', 290);
			$("#navi-top a.contact").addClass("selected");
		 });
	}else if(
					 window.location.hash == "#our-work" || 
					 window.location.hash == "#our-services" || 
					 window.location.hash == "#about-us" || 
					 window.location.hash == "#resources"
					 ){
//		$.scrollTo($("#page"));
//////////		$.scrollTo($(window.location.hash+"-obj").offset().top-70, 1000, {easing:'easeInOut'} );
		var objName = window.location.hash.substring(1) ;
		goToByScroll(objName+'-obj');
		$("#navi-top a." + objName).addClass("selected");
		if (objName=="our-work"){
			$("#portfolio .contents").hide();
			//$("#portfolio-obj .title-link a").addClass("selectedtitle");
			$("#portfolio-obj .contents").load("_includes/content-portfolio.html", function(){
				$("#portfolio-obj .contents").show("blind", 300);
/////////				$.scrollTo($("#portfolio-obj").offset().top-70, 1000, {easing:'easeInOut'} );
				goToByScroll('portfolio');
	//			$("#navi-top a."+menuName).addClass("selected");
			});
		};
	}else if(
					window.location.hash == "#portfolio" || 
					window.location.hash == "#our-clients" || 
					window.location.hash == "#strategy" || 
					window.location.hash == "#lifestyle-research" || 
					window.location.hash == "#usability-testing" || 
					window.location.hash == "#interaction-design" || 
					window.location.hash == "#the-company" || 
					window.location.hash == "#our-approach" || 
					window.location.hash == "#our-team" || 
					window.location.hash == "#news" || 
					window.location.hash == "#jobs" || 
					window.location.hash == "#book-and-video" || 
					window.location.hash == "#downloads" || 
					window.location.hash == "#links" || 
					window.location.hash == "#contact" 
					){
		var objName = window.location.hash.substring(1) ;
		$("#"+objName+" .contents").hide();
		//$("#"+objName+"-obj .title-link a").addClass("selectedtitle");
		$("#"+objName+"-obj .contents").load("_includes/content-"+objName+".html", function(){
			$("#"+objName+"-obj .contents").show("blind", 300);
////////////			$.scrollTo($("#"+objName+"-obj").offset().top-70, 1000, {easing:'easeInOut'} );
			goToByScroll(objName+'-obj');
//			$("#navi-top a."+menuName).addClass("selected");
		});
	}
}



/* ////////////// IE6 SCROLL FOLLOW FOR NAVI */
/*
$("#IE6 #header").scrollFollow({
    speed: 100,
    offset: 100,
		easing: 'linear'
   });
*/
//http://kitchen.net-perspective.com/open-source/scroll-follow/


/* ////////////// SCROLL*/
//$(window)._scrollable();

/*$("#header a#logo").click(function(){
///////////////////////$.scrollTo($("#page").offset().top-70, 1000, {easing:'easeInOut'} );
	goToByScroll('page');
	$("#navi-top a").removeClass("selected");
	$(this).addClass("selected");
	$(".title-link a").removeClass("selected");
});*/

	/* CORE FUNCTION*/
	function scrollToMenu(menuName){
/////////////////		$.scrollTo($("#"+menuName+"-obj").offset().top-70, 1000, {easing:'easeInOut'} );
		goToByScroll(menuName+'-obj');
		$("#navi-top a").removeClass("selected");
		$("a."+menuName).addClass("selected");
		$(".title-link a").removeClass("selected");
	}

$("#navi-top a.our-work").click(function(){scrollToMenu("our-work"); toggleMenuOurServices("portfolio","our-work","no-close")});
$("#navi-top a.our-services").click(function(){scrollToMenu("our-services")});
$("#navi-top a.about-us").click(function(){scrollToMenu("about-us")});
$("#navi-top a.resources").click(function(){scrollToMenu("resources")});

$("#navi-top a.contact").click(function(){
	$(".title-link a").removeClass("selectedtitle");
	scrollToMenu("contact");
	$("#contact-obj-link a").addClass("selectedtitle");
});
$("#contact-obj-link a").click(function(){
	$(".title-link a").removeClass("selectedtitle");
	scrollToMenu("contact");
	$("#contact-obj-link a").addClass("selectedtitle") 
});

/* ////////////// TITLE LINK TREATMENT */

//	$(".title-link a.selectedtitle").hide();	
//	$(".title-link a.not").hide();
	$(".contents").hide();
	
	/* CORE FUNCTION*/
	function toggleMenuOurServices(objName,menuName, closeBoolean){
		var obj = "#"+objName+"-obj";
		$(".title-link a").not($(obj+" .title-link a")).removeClass("selectedtitle");
		if(!$(obj+" .title-link a").hasClass("selectedtitle") && $(obj+" .contents").is(':hidden')){
			$(obj+" .title-link a").addClass("selectedtitle");
		}else{
			$(obj+" .title-link a").removeClass("selectedtitle")
		};
		if($(obj+" .contents").is(':hidden')){
			$(obj+" .contents").load("_includes/content-"+objName+".html", function(){
				$(obj+" .contents").show('blind', 300);
/////////				$.scrollTo($(obj).offset().top-70, 1000, {easing:'easeInOut'} );
				scrollobj = obj.substring(1);
				goToByScroll(scrollobj);
				$("#navi-top a").removeClass("selected");
				$("#navi-top a."+menuName).addClass("selected");
		 });
		}else{
			if(!closeBoolean){
				$(obj+" .contents").hide('blind', 300);
			}
		}
	}


/// v4 
/*
	function toggleMenuOurServices(objName,menuName){
		var obj = "#"+objName+"-obj";
//		$(".title-link a").not($(obj+" .title-link a")).removeClass("selectedtitle");
		$(".title-link a").not($(obj+" .title-link a")).removeClass("selectedtitle");
		if(!$(obj+" .title-link a").hasClass("selectedtitle") && !$(obj+" .contents").is(':hidden') && $(obj+" .contents").html() == ""){
			$(obj+" .title-link a").addClass("selectedtitle");
			$(obj+" .contents").load("_includes/content-"+objName+".html", function(){
				$(obj+" .contents .contents-innerHTML").show('blind', 300);
				$.scrollTo($(obj).offset().top-70, 1000, {easing:'easeInOut'} );
				$("#navi-top a").removeClass("selected");
				$("#navi-top a."+menuName).addClass("selected");
			});
		}else if($(obj+" .title-link a").hasClass("selectedtitle") && !$(obj+" .contents").is(':hidden')){
			$(obj+" .title-link a").removeClass("selectedtitle");
			$(obj+" .contents").hide('blind', 300);
		}else if(!$(obj+" .title-link a").hasClass("selectedtitle") && $(obj+" .contents").is(':hidden')){
			$(obj+" .title-link a").addClass("selectedtitle");
			$(obj+" .contents").show('blind', 300);
			$.scrollTo($(obj).offset().top-70, 1000, {easing:'easeInOut'} );
		}else if(!$(obj+" .title-link a").hasClass("selectedtitle") && !$(obj+" .contents").is(':hidden') && !($(obj+" .contents").html() == "")){
			$(obj+" .title-link a").addClass("selectedtitle");
			$.scrollTo($(obj).offset().top-70, 1000, {easing:'easeInOut'} );
		}
	}

*/





/* ////////////// GET DIRECTIONS */
	$("a.get-directions").click(function(){
		$("#get-directions-content").show('blind', 300);
		$(this).hide();
		$("a.hide-directions").show()
		$("#get-directions-content").load("_includes/content-directions.html");
		$.scrollTo($("a.get-directions").offset().top+200, 1000, {easing:'easeInOut'} );
	});

	$("a.hide-directions").click(function(){
		$("#get-directions-content").hide('blind', 300);
		$(this).hide();
		$("a.get-directions").show()
	});


	
}); //End of JQuery Functions.

