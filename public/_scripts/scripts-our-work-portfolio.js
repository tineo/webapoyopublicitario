$(document).ready(function() {

	jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
	}

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
		
		
		var objTarget = $(this).parent().attr('id').substring(8);
		console.log(objTarget);
		
		setTarget(objTarget);
		
		
		
		//$("#cs-item-screen-" + objTarget).show("blind", function() {
			/*<div class="ui-overlay">
<div class="ui-widget-overlay"></div>
<div class="ui-widget-shadow ui-corner-all" style="width: 302px; height: 152px; position: absolute; left: 50px; top: 30px;"></div>
</div>*/	
			/*var galy = '<div class="ui-overlay"><div class="ui-widget-overlay"></div>
						<div class="ui-widget-shadow ui-corner-all" style="width: 302px; height: 152px; position: absolute; left: 50px; top: 30px;"></div>
						</div>';
			*/
		
			/*var overlay = jQuery('<div id="overlay"> </div>');
			overlay.appendTo(document.body);
			*/

			$.ajax({
				url: "gallery",
				data: {
					trend : objTarget
				}
			}).done(function(data){
				var galeria = '<div class="camera_wrap camera_magenta_skin" id="camera">';
				$("#galeriatittle").text( (data.images[0].desc).split(",")[0] );
				$.each(data.images,function(index,value){
					galeria += '<div data-thumb="/'+value.thumbs+'" data-src="/'+value.url+'">';
					galeria += '<div class="camera_caption fadeFromBottom">'+value.desc+'</div></div>';
					//console.log(value.desc);
					//console.log(value.url);
				});
				galeria += '</div>';

				var capa = $('<div />')/*.css({'z-index':'100','position':'absolute'})*/;
				$('<div />').append(galeria).appendTo(capa);
				capa.appendTo("#galeria");

				$("#close-gallery").show();

				$('#camera').camera({
						/*width: '100%',
						height: '100%',/*
						alignment: 'left',*/
						loader: 'none',
						time: 1500,
						fx: 'curtainTopLeft,curtainTopRight,blindCurtainBottomRight',
						pagination : false,
						thumbnails : true,

						onStartLoading: function() {
											
							//console.log($(".camera_target .cameraSlide.cameracurrent"));
							//console.log($(".cameraContent > div").filter($(".cameracurrent")).length );
							//console.log($(".cameracurrent > div").text());
							var desc = $(".cameracurrent > div").text();
							var ti = desc.split(",")[0];
							console.log(desc.split(",")[0]);
							if(ti != "" ){
								$("#galeriatittle").text(ti);
							}
						}
				});	
				console.log(" cameracurrent :" + $(".cameracurrent > div").text());
				
				$('#case-study-list-container').hide();

			});
			
					
		//});
		
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

		$("#galeria").html("");
		$('#close-gallery').hide();
		$('#case-study-list-container').fadeIn(1500).isotope();

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
	
	$('#close-gallery').click(function(){
		$("#galeriatittle").text("");
		console.log("close");
		$("#galeria").html("");
		$('#case-study-list-container').fadeIn(1500).isotope();
		$('#close-gallery').hide();

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
