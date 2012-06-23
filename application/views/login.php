<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!--
<html>
--><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>images/favicon.png" />

<title>
Sistem Surat Masuk - Login
</title>
    <link href="<?php echo base_url() ?>css/default.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>css/login-box.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-1.7.2.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
    base_url = "http://localhost/surat-masuk/";

    $('#txtUser').focus();

    $('#txtUser').keypress(function(e){
        if (e.which == 13) {
            $('#txtPassword').focus();
        }
    });

    $('#txtPassword').keypress(function(e){
        if (e.which == 13) {
            $("#btnLogin").click();
        }
    });

    $('#btnLogin').click(function(){
        user = $('#txtUser').val();
        password = $('#txtPassword').val();
       
        if ($.trim(user) == '') {
            alert('User harus diisi');
            $('#txtUser').focus();
            return false;
        }

        if ($.trim(password) == '') {
            alert('Password harus diisi.');
            $('#txtPassword').focus();
            return false;
        }

        $('#harap-tunggu').show();
        $.post(base_url + '/index.php/login/cek_login',
            {user: user, 
             password: password
            },
            function(data) {
                if (data.result == 'true') {
                    window.location = base_url + 'index.php';
                } else {
                    alert('User atau password yang anda masukkan salah.');
                    $('#txtPassword').val('');
                    $('#txtUser').select();
                    $('#txtUser').focus();
                    $('#harap-tunggu').hide();
                }
            }, 'json'
        );        
    });
    
});
</script>
</head>
<body>
<div id="wrapper">



<!-- <div style="padding: 100px 0 0 250px;"> -->
<br>
<br>

<table align="center">
    <tbody>
		<tr>
			<td>
				<div id="login-box">
					<H2>Login</H2>
					<b>Sistem Surat Masuk Berbasis SMS</b>
					<br />
					<b>Kabupaten Buton Utara</b>
					<br />
					<div id="login-box-name" style="margin-top:20px;">User</div>
					<div id="login-box-field" style="margin-top:20px;">
						<input id="txtUser" class="form-login" title="Username" size="30" maxlength="2048">
					</div>

					<div id="login-box-name">Password</div>
					<div id="login-box-field">
						<input id="txtPassword" class="form-login" title="Password" size="30" maxlength="2048" type="password">
					</div>
					<a href="#" id="btnLogin"><img src="<?php echo base_url() ?>images/login-btn.png" style="margin-left: 90px;" height="42" width="103"></a>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<table style="display: none;" id="harap-tunggu" align="center" border="0" width="365px">
    <tbody><tr>
        <td valign="middle">
            <center>
            <img src="<?php echo base_url() ?>images/load.gif" height="16" width="16">
            <span class="text-box">Harap tunggu...</span>
            </center>
        </td>
    </tr>
</tbody></table>

</div>
</body>
</html>
