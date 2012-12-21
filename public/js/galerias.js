jQuery(function(){
	jQuery('#main-slider').camera({
		loader: 'bar',
		thumbnails: true,
		pagination: false,
		time: 4000,
		transPeriod: 1000,
	});
	jQuery('#main-slider').noConflict();
	
	
	//alert($(".camera_thumbs_cont div ul").css("width"));
});