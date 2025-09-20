<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/nivo-slider.css" type="text/css" media="screen">	
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.nivo.slider.js"></script>
    <div class="slider-wrapper theme-default">
        <div id="banner_slider" class="nivoSlider">
            <!-- BEGIN: loop -->
		      	<img src="{silide.link}" data-thumb="{silide.link}" title="{silide.name}" width="{config.width}" height="{config.height}" />
		    <!-- END: loop -->
        </div>
        
    </div>
    
    
	<script type="text/javascript">
    $(function () {
        $('#banner_slider').nivoSlider();
    });
    </script>
<!-- END: main -->