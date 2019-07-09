<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login/CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	form {
		padding: 10px;
		font-size: 14px;
	}

	input {
		padding: 5px;
		margin: 8px 0;
		box-sizing: border-box;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		width: 50%;
	}
	</style>
</head>
<body>

    <div id="container">

		<h1>Login</h1>
		
		<?php echo validation_errors(); ?>

        <?php
        if ($this->session->flashdata('message')) {
            echo '
            <div class="alert alert-success>
                '.$this->session->flashdata("message").'
            </div>
            ';  
		}
		
        ?>

        <form method="post" action="<?php echo base_url(); ?>login">

        <label for="login_email">E-mail:</label><br/>
        <input type="email" name="emailaddress" value="<?php echo set_value('emailaddress')?>" placeholder="E-mail" id="email" ><br/>
        <span class="text-danger" ><?php echo form_error("emailaddress"); ?></span>

        <label for="login_password">Password:</label><br/>
        <input type="password" name="password" placeholder="Password" id="password"><br/>
        <span class="text-danger" ><?php echo form_error("password"); ?></span>


        <input name="login" type="submit" value="Log in" class="btn btn-primary"><br/>

        </form>
            
    </div>
</body>
</html>