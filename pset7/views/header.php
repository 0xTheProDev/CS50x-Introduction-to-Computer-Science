<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        
        <link href="/css/styles.css" rel="stylesheet"/>
        
        <meta content="initial-scale=1, width=device-width" name="viewport"/>
        
        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>C$50 Finance</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <div>
                    <a href="/"><img alt="C$50 Finance" src="/img/logo.png"/></a>
                </div>
                <?php if (!empty($_SESSION["id"])): ?>
                    <ul class="nav nav-pills">
                        <li>
                            <a class="btn btn-default" href="/"><span class="glyphicon glyphicon-home"></span></a>
                        </li>
                        <li>
                            <a class="btn btn-default" href="quote.php">Quote</a>
                        </li>
                        <li>
                            <a class="btn btn-default" href="buy.php">Buy</a>
                        </li>
                        <li>
                            <a class="btn btn-default" href="sell.php">Sell</a>
                        </li>
                        <li>
                            <a class="btn btn-default" href="history.php">History</a>
                        </li>
                        <li>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="glyphicon glyphicon-wrench"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <li><a href="change.php"><span class="glyphicon glyphicon-pencil"></span> Edit Password</a></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> <strong>Log Out</strong></a></li>
                              </ul>
                            </div>
                        </li>
                    </ul>
                <?php endif ?>
            </div>

            <div id="middle">
