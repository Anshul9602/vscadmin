</div>
    <!-- Required vendors -->
    <script src="<?= base_url('vendor/global/global.min.js') ?>"></script>
	<script src="<?= base_url('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('vendor/chart-js/chart.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/custom.min.js') ?>"></script>
	<script src="<?= base_url('js/deznav-init.js') ?>"></script>
	<!-- Apex Chart -->
	<script src="<?= base_url('vendor/apexchart/apexchart.js') ?>"></script>
	
    <!-- Vectormap -->
	<!-- Chart piety plugin files -->
    <script src="<?= base_url('vendor/peity/jquery.peity.min.js') ?>"></script>
	
    <!-- Chartist -->
    <script src="<?= base_url('vendor/chartist/js/chartist.min.js') ?>"></script>
	
	<!-- Dashboard 1 -->
	<script src="<?= base_url('js/dashboard/dashboard-1.js') ?>"></script>
	<!-- Svganimation scripts -->
	<script src="<?= base_url('vendor/svganimation/vivus.min.js') ?>"></script>
    <script src="<?= base_url('vendor/svganimation/svg.animation.js') ?>"></script>
    
	 <!-- Datatable -->
	 <script src="<?= base_url('vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('js/plugins-init/datatables.init.js') ?>"></script>
	<script>
	function getUrlParams(dParam) {
		var dPageURL = window.location.search.substring(1),
			dURLVariables = dPageURL.split('&'),
			dParameterName,
			i;

		for (i = 0; i < dURLVariables.length; i++) {
			dParameterName = dURLVariables[i].split('=');

			if (dParameterName[0] === dParam) {
				return dParameterName[1] === undefined ? true : decodeURIComponent(dParameterName[1]);
			}
		}
	}
	
	(function($) {
		"use strict"

		var direction =  getUrlParams('dir');
		if(direction != 'rtl')
		{direction = 'ltr'; }
		
		var dezSettingsOptions = {
			typography: "roboto",
			version: "light",
			layout: "vertical",
			headerBg: "color_1",
			navheaderBg: "color_3",
			sidebarBg: "color_1",
			sidebarStyle: "full",
			sidebarPosition: "fixed",
			headerPosition: "fixed",
			containerLayout: "wide",
			direction: direction
		};
		
		new dezSettings(dezSettingsOptions); 

		jQuery(window).on('resize',function(){
			
			var sidebar = 'full';
			var screenWidth = jQuery(window).width();
			if(screenWidth < 600){
				sidebar = 'overlay';
			}else if(screenWidth > 600  && screenWidth < 1199){
				sidebar = 'mini';
			}
			
			dezSettingsOptions.sidebarStyle = sidebar;
			
			new dezSettings(dezSettingsOptions); 
		});
		
	})(jQuery);
	</script>

</body>
</html>
