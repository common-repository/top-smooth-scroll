jQuery(document).ready(function( $ ) {
	
	// Smooth Scroll Starts
	$('a[href*="#"]').click(function(event){
		 event.preventDefault();
		 //calculate destination place
		 var dest=0;
		 if($(this.hash).offset().top > $(document).height()-$(window).height()){
			  dest=$(document).height()-$(window).height();
		 }else{
			  dest=$(this.hash).offset().top -50;
		 }
		 //go to destination
		 $('html,body').animate({scrollTop:dest}, 1000,'swing');
	 });
	// Smooth Scroll Ends
	
});