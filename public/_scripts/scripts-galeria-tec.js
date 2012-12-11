
$(document).ready(function() {
/*
$("#cs-item-screen-viatorweb .scrollable .items").load("_includes/portfolio-slides/sony.html", function(){
	$("#cs-item-screen-viatormobile .scrollable .items").load("_includes/portfolio-slides/viatormobile.html", function(){
			$("#cs-item-screen-cbs .scrollable .items").load("_includes/portfolio-slides/cbs.html");
	});
});
*/
	$(".case-study-item a").hover(function(){
		$(this).addClass("hover");
		$(this).children(".logo").fadeOut(200);
		if($("#IE6").length == 0){ // Opacy effect for non-IE6 browsers.
			$(this).children(".cs-info").css('opacity' , '0');
			$(this).children(".cs-info").animate({
				opacity: 1.0
			},0);
		}else{

		}
	},function(){
		$(this).removeClass("hover");
		$(this).children(".logo").fadeIn(200);
	});

	$(".project-images a.prev").mouseover(function(){
		$(this).addClass("hover");
	});
	$(".project-images a.prev").mouseout(function(){
		$(this).removeClass("hover");
	});

	$(".project-images a.next").mouseover(function(){
		$(this).addClass("hover");
	});
	$(".project-images a.next").mouseout(function(){
		$(this).removeClass("hover");
	});

	var currentObjTarget;
	function setTarget(value){
			currentObjTarget = value;
	}

	var cargados = [];
	$(".case-study-item a.thumb").click(function(){
		
		/* la carga se hace aqui */
		var objTarget = $(this).parent().attr('id').substring(8) ;
		setTarget(objTarget);
		// $("#cs-item-screen-" + objTarget).show("blind", { direction:
		// "vertical" }, 500);
		$("#cs-item-screen-" + objTarget).show("blind", { direction: "vertical" },  500,
			function(){
				if($.inArray(objTarget, cargados)){
				//}else{
					/*Inicializo el Camera*/
						$('#slide-'+objTarget).camera({
							height: '400px',
							loader: 'bar',
							pagination: false,
							thumbnails: true,
							time: 4000,
							transPeriod: 1000
						});
						
						cargados.push(objTarget);
				}else{
					$('#slide-'+objTarget).cameraResume();
				}
			}
		);
	});

	/* Close */
	$(".screen a.close-cs-item-screen").click(function(){
		/* se cierra aqui */
		setTarget("undefined");
		$('#camera_wrap_2').cameraPause();
		$(this).offsetParent(".screen").hide("blind", { direction: "vertical" },  500);
	});

	/* Next : Fade */

	$(".tools-top a.next").click(function(){
		var objNumber = parseFloat($(this).offsetParent(".screen").attr('id').substring(15));
		var nextNumber = objNumber + 1;
		$(".screen").css("z-index","1000");
		$("#cs-item-screen-"+objNumber).css("z-index","1100");
		$("#cs-item-screen-"+nextNumber).show(0, function(){
			$("#cs-item-screen-"+objNumber).fadeOut(500);
		});
	});
	/* prev : Fade */
	$(".tools-top a.prev").click(function(){
		var objNumber = parseFloat($(this).offsetParent(".screen").attr('id').substring(15));
		var prevNumber = objNumber - 1;
		$(".screen").css("z-index","1000");
		$("#cs-item-screen-"+objNumber).css("z-index","1100");
		$("#cs-item-screen-"+prevNumber).show(0, function(){
			$("#cs-item-screen-"+objNumber).fadeOut(500);
		});
	});


	$("ul.cs-navi a").click(function(){
	});


/* //////////////// SCROLLABLE11 */
$("div.scrollable").scrollable({ 
	size: 1, 
// items: '#thumbs',
// hoverClass: 'hover'
// hoverClass: ''
	speed:700,
	easing: 'easeOutQuart'
});

}); // End of JQuery Functions.
