		<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/bootstrap.min.js" data-show="after" defer></script>
		<script type="text/javascript" data-show="after">
			$('#bttop').click(function(){
				$('body,html').animate({scrollTop:0},800);
			});
		</script>
		<!-- Zalo chat -->
		<div class="zalo-button-wrapper">
		<div class="zalo-chat-widget" data-oaid="1673754847450530709" data-welcome-message="Chúng tôi rất vui lòng hỗ trợ Bạn tìm được sản phẩm phù hợp với nhu cầu!" data-autopopup="0" data-width="350" data-height="420"></div>
        <script>
			window.addEventListener('load', function() {
				setTimeout(function() {
					var script = document.createElement('script');
					script.src = 'https://sp.zalo.me/plugins/sdk.js';
					script.async = true;
					document.body.appendChild(script);
				}, 1500);
			});
		</script>
         <span class="zalo-label">Lien he ngay</span>
        </div>
	</body>
</html>
