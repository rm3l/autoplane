jQuery(document).ready(function(){
	
	/* overlay
	-------------------------------*/
	jQuery(".overlay").each(function(i , obj){
		ie_overlay(i , obj);
	});
	
	jQuery(".has-divider:last-child").each(function(i , obj){
		$(this).addClass("last-child");
	});
});
	
/* ie_overlay
-------------------------------*/
function ie_overlay(i, target){
	$(target).hover(
		function(){
			$(target).children(".overlay-icon").show();
			$(target).children(".overlay-color").stop(true , true).fadeTo(250 , 0.6);
		}
		,
		function(){
			$(target).children(".overlay-icon").hide();
			$(target).children(".overlay-color").stop(true , true).fadeTo(250 , 0);
		}
	);
	$(target).children(".overlay-icon").hide();
	$(target).children(".overlay-color").fadeTo(0 , 0);
}