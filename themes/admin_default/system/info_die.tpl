<!-- BEGIN: main -->
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={SITE_CHARSET}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>{PAGE_TITLE}</title>
		<style type="text/css">
			body {
				margin: 0;
				padding: 0;
				background: #f6f7f9;
				color: #333;
				font: 14px/1.5 Arial, Helvetica, sans-serif;
			}
			.wrap {
				max-width: 720px;
				margin: 40px auto;
				background: #fff;
				border: 1px solid #e2e6ea;
				border-radius: 6px;
				box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
				padding: 24px 28px 28px 28px;
			}
			.logo {
				text-align: center;
				margin-bottom: 16px;
			}
			.title {
				font-size: 20px;
				color: #c00;
				margin: 0 0 10px 0;
				text-align: center;
			}
			.content {
				text-align: center;
				margin-bottom: 20px;
			}
			.links {
				text-align: center;
			}
			.links a {
				display: inline-block;
				margin: 0 6px;
				padding: 8px 14px;
				border-radius: 4px;
				text-decoration: none;
				border: 1px solid #cfd6dd;
				color: #333;
				background: #fafbfc;
			}
			.links a:hover {
				color: #c00;
				border-color: #c00;
			}
		</style>
	</head>
	<body>
		<div class="wrap">
			<div class="logo">
				<!-- BEGIN: image -->
				<a href="{HOME_LINK}" title="{SITE_NAME}">
					<img src="{LOGO}" width="{WIDTH}" height="{HEIGHT}" alt="{SITE_NAME}" />
				</a>
				<!-- END: image -->
				<!-- BEGIN: swf -->
				<object width="{WIDTH}" height="{HEIGHT}">
					<param name="movie" value="{LOGO}" />
					<param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<embed src="{LOGO}" quality="high" wmode="transparent" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash"></embed>
				</object>
				<!-- END: swf -->
			</div>
			<h1 class="title">{INFO_TITLE}</h1>
			<div class="content">{INFO_CONTENT}</div>
			<div class="links">
				<!-- BEGIN: adminlink -->
				<a href="{ADMIN_LINK}">{GO_ADMINPAGE}</a>
				<!-- END: adminlink -->
				<!-- BEGIN: sitelink -->
				<a href="{SITE_LINK}">{GO_SITEPAGE}</a>
				<!-- END: sitelink -->
			</div>
		</div>
	</body>
</html>
<!-- END: main -->