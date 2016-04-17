<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="registerTitle">
    <h1>Register for an Account</h1>
</div>


<div id="registrationForm">
    <table id='banner'>
    <tr>
        <td width="55%">
            <p>{registerMsg}</p>
            <form name='loginForm' id='registerForm' method='POST' enctype='multipart/form-data'>
                <label for='newUsername' style='display:{registerForm}'>Username: </label>    
                <input type='text' name='newUsername' id='newUsername' size='15' style='display:{registerForm}'>
                <br/>
                <br/>
                <label for='newPassword' style='display:{registerForm}'>Password: </label>    
                <input type='password' name='newPassword' id='newPassword' size='15' style='display:{registerForm}'>
                <br/>
                <br/>
                <input type="file" name="userfile" size="20" />
                <br/>
                <br/>
                <input type='hidden' name='regDo' value='{regDo}'>
                <input type='submit' value='{register}'>
            </form>
            <p id="acctExist">{resultMsg}</p> <!-- resultMsg should display a message if the username already exists in the database -->
        </td>
        <td>
            <form action='registration/do_upload' method='post' enctype='multipart/form-data'>
                select image to upload as your avatar.
                <br />
                <input type="file" name="userfile" size="20" />
                <br /><br />
                <input type="submit" value="upload" />
            </form>
        </td>
    </tr>
</table>
</div>

