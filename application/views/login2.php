<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Login Sistem Surat Masuk Berbasis SMS</title>

		<!-- ICON -->
		<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>images/favicon.png" />

		<link href="<?php echo base_url() ?>css/login-box.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div style="padding: 100px 0 0 250px;">
			<div id="login-box">
			<?php echo form_open('login/cek_login');?>
				<H2>Login</H2>
				<b>Sistem Surat Masuk Berbasis SMS</b>
				<br />
				<b>Kabupaten Buton Utara</b>
				<br />
				
				<div id="login-box-name" style="margin-top:20px;">Username:</div>
				<div id="login-box-field" style="margin-top:20px;"><input name="username" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
				<div id="login-box-name">Password:</div><div id="login-box-field"><input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
				<br />
				<input type="submit" name="Submit" value="" id="submit-button"/>
			</div>
		</div>
		<?php echo form_close();?>
	</body>
</html>
