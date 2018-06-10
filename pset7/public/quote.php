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
        render("quote_form.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide a symbol.");
        }
        
        // display stock update
        render("quote_display.php", ["title" => "Quote"]);
    }

?>
