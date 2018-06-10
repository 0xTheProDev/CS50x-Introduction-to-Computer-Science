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
        render("change_form.php", ["title" => "Change Password"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["old_pass"]) || empty($_POST["new_pass"]) || empty($_POST["con_pass"]))
        {
            apologize("You must fill all the fields.");
        }
        else if ($_POST["new_pass"] != $_POST["con_pass"])
        {
            apologize("Password differs in confirmation.");
        }
        
        $query1 = CS50::query("SELECT hash FROM `users` WHERE id=?", $_SESSION["id"]);
        $row = $query1[0];
        if (password_verify($_POST["old_pass"], $row["hash"]))
        {
            $query2 = CS50::query("UPDATE `users` SET hash=?", password_hash($_POST["new_pass"], PASSWORD_DEFAULT));
            if (!$query2)
            {
                apologize("Some network problem occured.");
            }
        }
        else
        {
            apologize("Incorrect password.");
        }
        
        // render status
        render("change_stat.php", ["title" => "Change Password"]);
    }
    
?>
