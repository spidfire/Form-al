<?php
    
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->input('firstname') // useable name (like db name)
      ->label("Firstname"); // label of this field

    $f->input('lastname')
      ->label("LastName");

    $s = $f->submit('Verzend met deze knop');

    if($s->isSubmitted()){
        echo "gegevens ontvangen!<br/>";
        var_dump($f->export());
    }

    echo $f->render();
