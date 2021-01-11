<?php
     echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");
    
    $options = array(
        "bier" => array(
            "Tarwebier" => "Tarwebier",
            "Bruine Ale" => "Bruine Ale",
            "Vlaams oud bruin" => "Vlaams oud bruin",
            "Amber" => "Amber",
            "Blonde Ale" => "Blonde Ale",
            "Porter en Stout" => "Porter en Stout",
            "Gerstewijn" => "Gerstewijn",
            "Trappist" => "Trappist",
            "Abdijbier" => "Abdijbier"
        ),
        "Cheese" => array(
            "Abondance" => "Abondance",
            "Banon" => "Banon",
            "Beaufort" => "Beaufort",
            "Bleu d'Auvergne" => "Bleu d'Auvergne",
            "Bleu des Causses" => "Bleu des Causses",
            "Bleu du Haut Jura" => "Bleu du Haut Jura",
            "Bleu de Gex" => "Bleu de Gex",
            "Bleu de Septmoncel" => "Bleu de Septmoncel",
            "Bleu du Vercors-Sassenage" => "Bleu du Vercors-Sassenage",
            "Brie de Meaux" => "Brie de Meaux",
            "Brie de Melun" => "Brie de Melun",
            "Brocciu " => "Brocciu ",
            "Camembert de Normandie" => "Camembert de Normandie",
            "Cantal" => "Cantal",
            "Fourme de Cantal" => "Fourme de Cantal",
            "Chabichou du Poitou" => "Chabichou du Poitou"
        ),
    );
    $f->selectsteps('link')
        ->label("Gelinkte pagina")
        ->setValue("")
        ->options($options);

    $s = $f->submit('Verzend met deze knop');

    if($s->isClicked()){
        echo "gegevens ontvangen!<br/>";
        var_dump($f->export());
    }

    echo $f->render();
