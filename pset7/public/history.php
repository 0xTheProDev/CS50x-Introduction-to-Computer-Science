<?php

    // configuration
    require("../includes/config.php"); 
    
    // if the user is not logged in
    if (empty($_SESSION["id"]))
    {
        redirect("/");
    }
    
    // query database for user
    $rows = CS50::query("SELECT * FROM `history` WHERE user_id = ? 
    ORDER BY timestamp DESC", $_SESSION["id"]);
    
    // getiing data in list
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "date" => $row["timestamp"],
                "name" => $stock["name"],
                "symbol" => $row["symbol"],
                "action" => $row["action"],
                "shares" => $row["shares"],
                "price" => $stock["price"] * $row["shares"]
            ];
        }
    }

    // render portfolio
    render("history.php", ["positions" => $positions, "title" => "History"]);

?>
