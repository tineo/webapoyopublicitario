$(document).ready(function() {

	$(".case-study-item a").hover(function() {
		$(this).addClass("hover");
		$(this).children(".logo").fadeOut(200);
		if ($("#IE6").length == 0) { // Opacy effect for non-IE6 browsers.
			$(this).children(".cs-info").css('opacity', '0');
			$(this).children(".cs-info").animate({
				opacity : 1.0
			}, 0);
		} else {
			// $(this).children(".cs-info").css('background' , '#FFF');
			// $(this).children(".cs-info").animate({
			// 'background' : '#111'
			// },250)
		}
	}, function() {
		$(this).removeClass("hover");
		$(this).children(".logo").fadeIn(200);
	});

	var currentObjTarget;
	function setTarget(value) {
		currentObjTarget = value;
	}

	// $("#cs-item-screen-sony").show().hide(500);
	// $("#cs-item-screen-sony").hide("blind", { direction: "vertical" }, 1);

	//var count = 0;
	$(".case-study-item a.thumb").click(function() {
		
		/* la carga se hace aqui */
		var objTarget = $(this).parent().attr('id').substring(8);
		setTarget(objTarget);
		//alert("#cs-item-screen-" + objTarget);
		
		// $("#cs-item-screen-" + objTarget).show("blind", { direction:
		// "vertical" }, 500);
		$("#cs-item-screen-" + objTarget).show("blind", function() {
			
			
			
			//alert("st_gallery.php?trend="+objTarget);
			$("#cs-item-screen-"+objTarget+" .screen-body").load("st_gallery.php?trend="+objTarget, function(){
				//if( $('#cs-item-'+objTarget).is('.loaded') ){
					//$('#camera_'+objTarget).cameraResume();
				//}else{
					//alert(1);
				//$("#cs-item-screen-"+objTarget+" .screen-body").addClass("row");

	        
				
				
				
					$('#camera_'+objTarget).camera({
						height: '50%',
						alignment: 'left',
						loader: 'none',
						time: 1500,
						fx: 'curtainTopLeft,curtainTopRight,blindCurtainBottomRight',
						pagination : false,
						thumbnails : true
					});
				
					//$('#cs-item-'+objTarget).addClass("loaded");
					//$('#camera_'+objTarget).cameraResume();
					//$(".title-link").html($('#camera_'+objTarget).parent().parent().html());
				//}
			});
		});
	});

	/* Close */
	$(".screen a.close-cs-item-screen").click(function() {
		/* se cierra aqui */
		
		
		setTarget("undefined");
		var objTarget = $(this).parent().attr('id').substring(15);
		
		$("#cs-item-screen-"+objTarget+" .screen-body").html("");
		
		$(this).offsetParent(".screen").hide("blind");
		
		
		//alert('#camera_'+objTarget);
		//$('#camera_'+objTarget).cameraPause();
		//.cameraStop();
	});
	
	// filter items when filter link is clicked
	$('ul.cs-navi a').click(function(){
		$("ul.cs-navi a").removeClass("selected");
		$(this).addClass("selected");
	  var selector = $(this).attr('data-filter');
	  $("#case-study-list-container").isotope({ filter: selector });
		if(currentObjTarget!="undefined"){
			$("#cs-item-screen-"+currentObjTarget).hide("blind", { direction: "vertical" },  500);
			setTarget("undefined");
		}
	  return false;
	});
	
	
	
	//
	// initialize isotope
	var t=setTimeout('$("#case-study-list-container").isotope({ itemSelector : ".case-study-item", filter: ".Extemin2011"});',100);
	t;
	
	$("#cs-link-Extemin2011").addClass("selected");
	//	$("#cs-item-screen-ferreyros_09 .screen-body").load("_includes/portfolio-slides/viatorweb.html", function(){});
	
	//$("#cs-item-screen-ferreyros_11 .screen-body").load("st_gallery.php?trend="+objTarget, function(){});
	//$("#cs-item-screen-ferreyros_09 .screen-body").load("st_gallery.php?trend="+objTarget, function(){});
	//$("#cs-item-screen-ferreyros_09 .screen-body").load("st_gallery.php?trend="+objTarget, function(){});

}); // End of JQuery Functions.
