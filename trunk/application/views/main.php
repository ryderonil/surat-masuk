<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Sistem Informasi Pendataan & Kerjasama</title>
		
		<!-- ICON -->
		<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>images/favicon.ico" />
		
		<!-- Link CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/flexigrid.css" media="screen, tv, projection" title="Default" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>form_attribute/view.css" media="screen, tv, projection" title="Default" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/button.css" media="screen, tv, projection" title="Default" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/main.css" media="screen, tv, projection" title="Default" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/accordion.css" media="screen, tv, projection" title="Default" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datepicker.css" media="screen, tv, projection" title="Default" />	

		<!-- JAVASCRIPT -->
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.ui.all.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.layout.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/flexigrid.pack.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>form_attribute/view.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>form_attribute/calendar.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.bgiframe.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.tooltip.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.dimensions.js"></script>
		<script type="text/javascript">
			<!-- <MENU_KANAN>
			//  Developed by Roshan Bhattarai 
			//  Visit http://roshanbh.com.np for this script and more.
			//  This notice MUST stay intact for legal use
			-->
			$(document).ready(function()
			{
				//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
				$("#firstpane p.menu_head").click(function()
				{
					$(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
				});
				//slides the element with class "menu_body" when mouse is over the paragraph
				$("#secondpane p.menu_head").mouseover(function()
				{
					 $(this).css({backgroundImage:"url(<?php echo base_url() ?>images/main/down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
					 $(this).siblings().css({backgroundImage:"url(<?php echo base_url() ?>images/main/left.png)"});
				});
			});
			$('#status a').tooltip({
				track: true,
				delay: 0,
				showURL: false,
				showBody: " - ",
				fade: 250
			});
		</script>
		<script type="text/javascript">
			<!-- <BORDER_LAYOUT> -->
			var outerLayout; 
			$(document).ready(function () { 
				outerLayout = $('body').layout({ 
					center__paneSelector:	".outer-center" 
				,	west__paneSelector:		".outer-west" 
				,	west__size:				185 
				,	spacing_open:			10 
				,	spacing_closed:			10
				,	north__spacing_open:	0
				,	south__spacing_open:	0
				,	resizable:				false
				,	togglerTip_open:		"Tutup"
				,	togglerTip_closed:		"Buka"
				,	sliderTip:				"Buka Slide"
				}); 
			}); 
		</script> 
		
		<?if (isset($added_js)){echo $added_js;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_1)){echo $added_js_1;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_2)){echo $added_js_2;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_3)){echo $added_js_3;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_4)){echo $added_js_4;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_5)){echo $added_js_5;}?> <!-- attach js flexigrid (jika ada) -->
		
	</head>

	<body>
		<div class="ui-layout-north">
			<div class="top_panel_left"></div>
			<div class="top_panel_right"></div>
		</div>
		
		<div class="outer-center">
			<div class="content_panel"><?php echo $content;?></div>
		</div> 

		<div class="outer-west">
			<div class="leftmenu_panel"><?php $this->load->view('menu_kiri');?></div>
		</div>
		
		<div class="ui-layout-south">
			<div class="footer_panel"><div style="padding:10px 0 0 10px;">© 2011 Research & Development Team.</div></div>
		</div> 
	</div> 
	</body>
</html>
