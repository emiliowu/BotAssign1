<div id="container">
    <div id="dropdown">
        <h2 class="text">Player: {username}</h2>
        Select a player to view
        <select onchange="window.location.href = this.value">
            <option>Player Name</option>
            {playerDropdown}
        </select>     
    </div>

    <div id="playerTransactions">
        <h2 class="text">Buy/Sell Bots Pieces:</h2>
        <form method='post' name='playerActions' id='playerActionsForm'>
            <input class='buttonPlayer' type='submit' name='buy' value='Buy'>
            <input class='buttonPlayer' type='submit' name='sell' value='Sell'>
        </form>
    </div>

    <div id="playerActivies">
        <h2 class="text">Recent Activities:</h2>
        <table>
            <tr>
                <th>Transaction</th>
                <th>Series</th>
                <th>Date and Time</th>
            </tr>
            <tr>  
                {transactions}
            </tr>
        </table>
    </div>

    <div id="playerHoldings">
        <h2 class="text">Current Holdings:</h2>
        <table>
            <tr>
                <th></th>
                <th>Series 11a</th>
                <th>Series 11b</th>
                <th>Series 11c</th>
                <th>Series 13c</th>
                <th>Series 13d</th>
                <th>Series 26h</th>
            </tr>
            <tr>
                <th>Head</th>
                <td>{11ah}</td>
                <td>{11bh}</td>
                <td>{11ch}</td>
                <td>{13ch}</td>
                <td>{13dh}</td>
                <td>{26hh}</td>
            </tr>
            <tr>
                <th>Body</th>
                <td>{11ab}</td>
                <td>{11bb}</td>
                <td>{11cb}</td>
                <td>{13cb}</td>
                <td>{13db}</td>
                <td>{26hb}</td>
            </tr>
            <tr>
                <th>Leg</th>
                <td>{11al}</td>
                <td>{11bl}</td>
                <td>{11cl}</td>
                <td>{13cl}</td>
                <td>{13dl}</td>
                <td>{26hl}</td>
            </tr>
        </table>
    </div>
</div>
