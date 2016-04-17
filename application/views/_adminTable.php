<script>
    function doconfirm()
    {
        //var username = $("#playerName").val();
        //var whichPlayer = oForm.elements["whichPlayer"].value;
        var username = document.getElementById("whichPlayer").value;
        alert(username); 
        
        job = confirm('Are you sure to delete 'username' permanently?');
        if(job!=true)
        {
            return false;
        }
    }
</script>
<table class="{tableClass}">
    <tr>
        <th>Player Name</th>
        <th>Cash</th>
        <th>Action</th>
    </tr>
    {playerTable}
    <tr>
        <td>
            {username}
        </td>
        <td>
            {Peanuts} Peanuts
        </td>
        <td>
            <form method="post" action="administration/delete">
                <input type='hidden' name='whichPlayer' id='whichPlayer' value={username}>
                <button type='submit' name="action" onclick="return doconfirm()" formaction="administration/delete">Delete</button>
            </form>
        </td>
    </tr>
    {/playerTable}
</table>
