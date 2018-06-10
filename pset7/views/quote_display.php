                <?php
                    
                    // getting respective array for symbol
                    $symbol = $_POST["symbol"];
                    $stock = lookup($symbol);
                    $name = $stock["name"];
                    $price = number_format($stock["price"], 2);
                    
                    // printing details
                    print("A share of {$name} ({$symbol}) costs <strong>\${$price}</strong>. \n");
                    
                ?>
