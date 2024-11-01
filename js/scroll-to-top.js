jQuery(document).ready(function(){
var doc_height = jQuery(document).height();
var height_half = doc_height /5;
jQuery(window).scroll(function() {
  
   if(jQuery(this).scrollTop()>= height_half) {
       jQuery('#daq_tss_wrapper').slideDown(300);
       jQuery('#daq_tss_wrapper').click(function(){
       	jQuery('html , body').animate({scrollTop:0},300);
       	throw '';
       	return false;
       jQuery("#daq_tss_wrapper").slideUp(700);
       });
   }
    else{
   jQuery('#daq_tss_wrapper').slideUp(300); }

});

});
