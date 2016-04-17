<table id='banner' width="100%">
    <tr>
        <td id="bannerLogo" width="10%">
            <img id="bannerLogoImage" src = "../../assets/images/r2d2.jpg" alt = "Banner Image"/>
        </td>
        <td id='headerinfo' colspan="2" width="10%">
            <h2 id="siteTitle">Bot Collector Game</h2>
        </td>
        <td width="80%">
            <p>{welcomeMsg}</p>
            <br/>
            <form name='loginForm' id='loginForm' method='POST'>
                <br/>
                <label for='username' style='display:{loginForm}'>Username: </label>    
                <input type='text' name='username' id='username' size='15' style='display:{loginForm}'>
                <br/>
                <label for='password' style='display:{loginForm}'>Password: </label>    
                <input type='password' name='password' id='password' size='15' style='display:{loginForm}'>
                <br/>
                <input type='hidden' name='do' value='{loginDo}'>
                <input type='submit' value='{login}'>
            </form>
            Secret Token: {token} ...shhhhh!
        </td>
        <td>
            {avatarImg}
        </td>
    </tr>
</table>
