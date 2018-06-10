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
        render("buy_form.php", ["title" => "Buy"]);
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
        $stock = lookup($symbol);
        $price = $_POST["shares"] * $stock["price"];
        $query1 = CS50::query("SELECT cash FROM `users` WHERE id=?", $_SESSION["id"]);
        if (!$query1)
        {
            apologize("Invalid data or some network problem occured.");
        }
        foreach($query1 as $row)
        {
            $cash = $row["cash"];
        }
        if ($cash < $price)
        {
            apologize("You don't have enough cash.");
        }
        $query2 = CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE
        KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $symbol, $_POST["shares"]);
        if (!$query2)
        {
            apologize("Invalid data or some network problem occured.");
        }
        $cash = $cash - $price;
        $query3 = CS50::query("UPDATE `users` SET cash=? WHERE id=?", 
        $cash, $_SESSION["id"]);
        if (!$query3)
        {
            apologize("Invalid data or some network problem occured.");
        }
        
        $query = CS50::query("INSERT INTO `history`(user_id, action, symbol, shares, timestamp)
        VALUES(?,'BUY',?,?, NOW())", $_SESSION["id"], $symbol, $_POST["shares"]);
        
        // giving back the data
        $data = ["shares" => "{$_POST["shares"]}", "name" => "{$stock["name"]}", "cash" => "{$cash}"];
        
        // display result
        render("buy_display.php", ["title" => "Buy", "data" => $data]);
    }

?>
