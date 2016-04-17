<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="title">
    <h1>Bot Assembly</h1>
</div>
<div>
    {playerCards}
</div>
<div id="assemblyRightContainer">
    <table>
        <tr><td>Head<select class="buttonAssemble" >{selectHeads}</select></td></tr>
        <tr><td><br/><br/></td></tr>
        <tr><td>Body<select class="buttonAssemble" >{selectBody}</select></td></tr>
        <tr><td><br/><br/></td></tr>
        <tr><td>Legs<select class="buttonAssemble" >{selectLegs}</select></td></tr>
        <tr><td><br/><br/></td></tr>
        <tr><td><input class="buttonAssemble" type="submit" name='btn_submit' value='Assemble'/></td></tr>            
        <tr><td><h5 id="previewH5"><br/>Preview</h5></td></tr>
        <tr><td><img src="../../assets/images/11c-0.jpeg"</td></tr>
        <tr><td><img src="../../assets/images/11c-1.jpeg"</td></tr>
        <tr><td><img src="../../assets/images/11c-2.jpeg"</td></tr>
    </table>
</div>
