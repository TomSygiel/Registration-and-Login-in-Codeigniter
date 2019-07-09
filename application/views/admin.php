<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login/CodeIgniter</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
		width: 70%;
	}

    table {
        border-collapse: collapse;
        margin: 10px;
    }

    th, td {
        margin: 10px;
        text-align:center; 
        border-bottom:1px solid lightgray; 
        padding: 5px;
    }

    .user_img_frame {
        width: 20px;
        height: 20px;
        overflow: hidden;
        margin: 10px;
        padding: 5px;
    }

    .user_img {
        object-fit: cover;
        width: 100%;
        height: auto;
    }

	</style>
</head>
<body>

    <div id="container">
    
        <?php

        if(isset($user_data) && $user_data) {
            ?>

            <h1>Update user records</h1>

            <?php echo validation_errors(); ?>

             <?php
            if ($this->session->flashdata('message')) {
                echo '
                <div class="alert alert-success>
                '.$this->session->flashdata("message").'
                </div>
                ';   
            }

            echo isset($message) ? $message : '';

            ?>
            <?php echo form_open_multipart('admin/update_data'); ?>

                <label for="register_first_name">First name:</label><br/>
                <input type="text" name="first_name" value="<?php echo $user_data->first_name; ?>" placeholder="Username" id="first_name" ><br/>
                <span class="text-danger" ><?php echo form_error("first_name"); ?></span>

                <label for="register_surname">Surname:</label><br/>
                <input type="text" name="surname" value="<?php echo $user_data->surname; ?>" placeholder="Surname" id="surname" ><br/>
                <span class="text-danger" ><?php echo form_error("surname"); ?></span>

                <label for="register_email">E-mail:</label><br/>
                <input type="email" name="emailaddress" value="<?php echo $user_data->email; ?>" placeholder="E-mail" id="email" ><br/>
                <span class="text-danger" ><?php echo form_error("emailaddress"); ?></span>

                <label for="register_password">Password:</label><br/>
                <input type="password" name="password" value="<?php echo $user_data->password; ?>" placeholder="Password" id="password"><br/>
                <span class="text-danger" ><?php echo form_error("password"); ?></span>

                <label for="register_telephone">Phone number:</label><br/>
                <input type="tel" id="phone" name="phone" value="<?php echo $user_data->telephone; ?>" placeholder="1234567890">
                <span class="text-danger" ><?php echo form_error("phone"); ?></span>

                <input type="hidden" name="hidden_ID" value="<?php echo $user_data->ID; ?>"><br/>

                <input type="submit" name="update" value="Update" class="btn btn-primary"><br/>

            </form>

            <?php
        }
        
        ?>

    </div>
    <div id="container">

        <h1>User records</h1>

        <table>
            <tr>
                <th>Profile picture</th>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Telephone No.</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        <?php
        if (count($fetch_data) > 0) {
            foreach($fetch_data as $row) {
                // print_r($row);
            ?>
            <tr>
                <td class="user_img_frame">
                    <img class="user_img" src="<?= $row->profile_picture; ?>" alt="user_image"/>
                </td>
                <td><?php echo $row->ID; ?></td>
                <td><?php echo $row->first_name; ?></td>
                <td><?php echo $row->surname; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->telephone; ?></td>
                <td><a href="#" class="delete_data" id="<?php echo $row->ID; ?>">Delete</a></td>
                <td><a href="<?php echo base_url(); ?>admin/update_data/<?php echo $row->ID; ?>">Edit</a></td>
            </tr>
            <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="8">No data found</td>
            </tr>
        <?php
        }
        ?>
        </table>
    </div>
        
    <script>  
      $(document).ready(function(){  
           $('.delete_data').click(function(){  
                var id = $(this).attr("id");  
                if(confirm("Are you sure you want to delete this?")) {  
                    window.location="<?php echo base_url(); ?>admin/delete_data/"+id;
                } else {  
                    return false;  
                }  
           });  
      });  
    </script>  
</body>
</html>