<?php

    // configuration
    require("../includes/config.php"); 
    
    // if the user is already logged in
    if (empty($_SESSION["id"]))
    {
        redirect("/");
    }
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol.");
        }
        else if (empty($_POST["shares"]) || $_POST["shares"] <= 0 || 
        !((int) $_POST["shares"] == $_POST["shares"] && $_POST["shares"] > 0))
        {
            apologize("You must provide valid shares.");
        }
        
        $symbol = strtoupper($_POST["symbol"]);
        $query1 = CS50::query("SELECT shares FROM `portfolios` WHERE user_id=? AND symbol=?", 
        $_SESSION["id"], $symbol);
        if (!$query1)
        {
            apologize("Invalid data or some network problem occured.");
        }
        foreach($query1 as $row)
        {
            $share = $row["shares"];
        }
        if ($share < $_POST["shares"])
        {
            apologize("You don't have enough shares.");
        }
        $share = $share - $_POST["shares"];
        $query2 = CS50::query("UPDATE `portfolios` SET shares=? WHERE user_id=? AND symbol=?", 
        $share, $_SESSION["id"], $symbol);
        if (!$query2)
        {
            apologize("Invalid data or some network problem occured.");
        }
        $stock = lookup($symbol);
        $value = $stock["price"] * $_POST["shares"];
        $query3 = CS50::query("UPDATE `users` SET cash=cash+? WHERE id=?", 
        $value, $_SESSION["id"]);
        if (!$query3)
        {
            apologize("Invalid data or some network problem occured.");
        }
        
        $query = CS50::query("INSERT INTO `history`(user_id, action, symbol, shares, timestamp)
        VALUES(?,'SELL',?,?, NOW())", $_SESSION["id"], $symbol, $_POST["shares"]);
        
        // giving back the data
        $data = ["shares" => "{$_POST["shares"]}", "name" => "{$stock["name"]}", "share" => "{$share}"];
        
        // display result
        render("sell_display.php", ["title" => "Sell", "data" => $data]);
    }

?>
