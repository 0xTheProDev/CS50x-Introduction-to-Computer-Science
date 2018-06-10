<?php

    // configuration
    require("../includes/config.php"); 
    
    // query database for user
    $rows = CS50::query("SELECT symbol,shares FROM `portfolios` WHERE user_id = ? 
    ORDER BY shares DESC", $_SESSION["id"]);
    
    // getiing data in list
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => number_format($row["shares"] * $stock["price"], 2)
            ];
        }
    }

    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio"]);

?>
