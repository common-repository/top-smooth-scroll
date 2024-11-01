<style>
/* daq tss css */
#daq_tss_wrapper{
	z-index:9999999999;
}

#daq_tss_wrapper .small{
	width:40px; 
	height:40px; 
	text-align:center; 
	display: table;
}

#daq_tss_wrapper .medium{ 
	width:50px; 
	height:50px; 
	text-align:center; 
	display: table;
}

#daq_tss_wrapper .large{ 
	width:70px; 
	height:70px; 
	text-align:center; 
	display: table;
}

#daq_tss_wrapper span{
	display: table-cell; 
	vertical-align: middle;
}

#daq_tss_wrapper .button{
	background-color:<?php echo $daq_sttp_background_color;?>; 
	border-radius:<?php echo $daq_sttp_button_radius;?>px; 
	position:fixed; 
}

#daq_tss_wrapper .left .button{
	left:10px; 
	left:<?php echo $daq_sttp_button_margin_left;?>px !important; 
	bottom:10px; 
	bottom:<?php echo $daq_sttp_button_margin_bottom;?>px !important;
}
#daq_tss_wrapper .right .button{
	right:10px; 
	right:<?php echo $daq_sttp_button_margin_right;?>px !important; 
	bottom:10px; 
	bottom:<?php echo $daq_sttp_button_margin_bottom;?>px !important;
}

#daq_tss_wrapper .center .small{
	left:50%; 
	margin-left:-20px; 
	bottom:10px; 
	bottom:<?php echo $daq_sttp_button_margin_bottom;?>px !important;
}

#daq_tss_wrapper .center .medium{
	left:50%; 
	margin-left:-25px; 
	bottom:10px; 
	bottom:<?php echo $daq_sttp_button_margin_bottom;?>px !important;
}

#daq_tss_wrapper .center .large{
	left:50%; 
	margin-left:-35px; 
	bottom:10px; 
	bottom:<?php echo $daq_sttp_button_margin_bottom;?>px !important;
}

#daq_tss_wrapper .button:hover{
	background-color:<?php echo $daq_sttp_background_hover_color;?>;
}

#daq_tss_wrapper .small .fa{ 
	font-size:28px
}

#daq_tss_wrapper .medium .fa{
	font-size:38px
}

#daq_tss_wrapper .large .fa{ 
	font-size:58px
}

#daq_tss_wrapper a {
	display:block
}

#daq_tss_wrapper a .fa{ 
	color:<?php echo $daq_sttp_icon_color;?>; 
}

#daq_tss_wrapper .button:hover .fa{ 
	color:<?php echo $daq_sttp_icon_hover_color;?>
}

#daq_tss_wrapper .fa-angle-up{
	margin-top:-5px
}
</style>