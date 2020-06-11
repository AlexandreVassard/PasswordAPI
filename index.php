<?php
if (isset($_GET['api'])) {
    $quantity = 1;
    $length = 24;
    $args = ['include_lower_chars', 'include_upper_chars'];

    if (isset($_GET['quantity']) && !empty($_GET['quantity']) && $_GET['quantity'] > 0 && $_GET['quantity'] < 30) {
        $quantity = $_GET['quantity'];
    }

    if (isset($_GET['length']) && !empty($_GET['length']) && $_GET['length'] < 30 && $_GET['length'] > 5) {
        $length = $_GET['length'];
    }

    if (isset($_GET['args']) && !empty($_GET['args'])) {
        $args = explode(',', $_GET['args']);
    }

    require 'Password.php';

    $password = new Password($quantity, $length, $args);
    echo $password->getJSON();

} else {

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Générateur de mots de passe</title>
    <link rel="icon" type="icone/ico" href="images/icone.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Générateur de mots de passe</h3>
        </div>
    </header>
    <main role="main" class="inner cover">
        <?php
            require 'Password.php';
            $password = new Password();
            echo '<span class="user-select-all">' . $password->showPassword() . '</span>';
        ?>
    </main>
    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>Cover template for <a target="_blank" href="https://getbootstrap.com/">Bootstrap</a>, by <a target="_blank" href="https://twitter.com/mdo">@mdo</a>. API from <a target="_blank" href="http://www.devoutils.fr/">Devoutils.fr</a> by Alexandre VASSARD.</p>
        </div>
    </footer>
</div>
</body>
</html>
<?php
}
?>