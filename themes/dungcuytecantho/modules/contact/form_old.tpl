<!-- BEGIN: main -->
<div class="page">
    <div class="nv-fullbg">
    	<!-- BEGIN: error -->
    	<div class="alert alert-danger fade in">
    		<em data-dismiss="alert" aria-hidden="true" class="fa fa-times fa-fix fa-pointer pull-right fa-lg">&nbsp;</em>
    		{CONTENT.error}
    	</div>
    	<!-- END: error -->
    	<!-- BEGIN: form -->
    	<div class="row">
    	    <div class="col-12 col-md-7">
    	        <div class="alert alert-info">
            		{LANG.note}
            	</div>
    	    </div>
    	    <div class="col-12 col-md-5">
            	        <form id="fcontact" method="post" action="{ACTION_FILE}" onsubmit="return sendcontact('{NV_GFX_NUM}');">
            		<div class="form-group">
            			<label for="ftitle">{LANG.title}</label>
            			<input type="text" maxlength="255" class="form-control" value="{CONTENT.ftitle}" id="ftitle" name="ftitle" placeholder="{LANG.title}"/>
            		</div>
            		<!-- BEGIN: iguest -->
            		<div class="form-group">
            			<label for="fname">{LANG.fullname}</label>
            			<input type="text" maxlength="100" value="{CONTENT.fname}" id="fname" name="fname" class="form-control" placeholder="{LANG.fullname}"/>
            		</div>
            		<div class="form-group">
            			<label for="femail_iavim">{LANG.email}</label>
            			<input type="text" maxlength="60" value="{CONTENT.femail}" id="femail_iavim" name="femail" class="form-control" placeholder="{LANG.email}"/>
            		</div>
            		<!-- END: iguest -->
            		<!-- BEGIN: iuser -->
            		<div class="form-group">
            			<label for="fname">{LANG.fullname}</label>
            			<input type="text" maxlength="100" value="{CONTENT.fname}" id="fname" name="fname" class="form-control" disabled="disabled" />
            		</div>
            		<div class="form-group">
            			<label for="femail_iavim">{LANG.email}</label>
            			<input type="text" maxlength="60" value="{CONTENT.femail}" id="femail_iavim" name="femail" class="form-control" disabled="disabled" />
            		</div>
            		<!-- END: iuser -->
            		<div class="form-group">
            			<label for="fphone">{LANG.phone}</label>
            			<input type="text" maxlength="60" value="{CONTENT.fphone}" id="fphone" name="fphone" class="form-control" />
            		</div>
            		<div class="form-group">
            			<label for="fpart">{LANG.part}</label>
            			<select class="form-control" id="fpart" name="fpart">
            				<!-- BEGIN: select_option_loop -->
            				<option value="{SELECT_VALUE}" {SELECTED}>{SELECT_NAME}</option>
            				<!-- END: select_option_loop -->
            			</select>
            		</div>
            		<div class="form-group">
            			<label for="fcon">{LANG.content}</label>
            			<textarea cols="8" id="fcon" name="fcon" class="form-control" onkeyup="return nv_ismaxlength(this, 1000);">{CONTENT.fcon}</textarea>
            		</div>
            		<div class="form-group">
            			<label for="fcode_iavim" class="m-bottom">{LANG.captcha}</label>
            			<img height="22" src="{NV_BASE_SITEURL}index.php?scaptcha=captcha&t={NV_CURRENTTIME}" alt="{LANG.captcha}" id="vimg" />
            			&nbsp;<em class="fa fa-pointer fa-refresh fa-lg" onclick="nv_change_captcha('vimg','fcode_iavim');">&nbsp;</em>
            			<input type="text" maxlength="6" value="" id="fcode_iavim" name="fcode" class="form-control" />
            		</div>
            		<div class="text-center form-group">
            			<input type="hidden" name="checkss" value="{CHECKSS}" />
            			<input type="reset" value="{LANG.reset}" class="btn btn-primary" />
            			<input type="submit" value="{LANG.sendcontact}" id="btsend" name="btsend" class="btn btn-primary" />
            		</div>
            	</form>
    	    </div>
    	</div>
        <!-- END: form -->
    	
    
   
        <div class="col-12 col-sm-12 col-md-8">
            <div class="panel-body">
               <div id="googleMap" style="width: 660px; height: 480px;">Google Map</div>
					<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                    <script type="text/javascript">
                    var gmap = new google.maps.LatLng(10.0032547,105.7429245,16);
                    var marker;
                    function initialize()
                    {
                        var mapProp = {
                             center:new google.maps.LatLng(10.0032547,105.7429245,16),
                             zoom:16,
                            mapTypeId:google.maps.MapTypeId.ROADMAP
                        };
                     
                        var map=new google.maps.Map(document.getElementById("googleMap")
                        ,mapProp);
                     
                      var styles = [
                        {
                          featureType: 'road.arterial',
                          elementType: 'all',
                          stylers: [
                            { hue: '#fff' },
                            { saturation: 100 },
                            { lightness: -48 },
                            { visibility: 'on' }
                          ]
                        },{
                          featureType: 'road',
                          elementType: 'all',
                          stylers: [
                     
                          ]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry.fill',
                            stylers: [
                                { color: '#adc9b8' }
                            ]
                        },{
                            featureType: 'landscape.natural',
                            elementType: 'all',
                            stylers: [
                                { hue: '#809f80' },
                                { lightness: -35 }
                            ]
                        }
                      ];
                     
                      var styledMapType = new google.maps.StyledMapType(styles);
                      map.mapTypes.set('Styled', styledMapType);
                     
                      marker = new google.maps.Marker({
                        map:map,
                        draggable:true,
                        animation: google.maps.Animation.DROP,
                        position: gmap
                      });
                      google.maps.event.addListener(marker, 'click', toggleBounce);
                    }
                     
                    function toggleBounce() {
                     
                      if (marker.getAnimation() !== null) {
                        marker.setAnimation(null);
                      } else {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                      }
                    }
                     
                    google.maps.event.addDomListener(window, 'load', initialize);
                    </script>
            </div>
        </div>
    </div>
</div>
<!-- END: main -->