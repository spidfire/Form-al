<?php
    
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->input('firstname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\MinLength(3))
      ->label("Firstname"); // label of this field

    $f->input('lastname')
      ->min(3)
      ->label("LastName");

    $s = $f->submit('Verzend met deze knop');



    echo $f->render();

    if($s->isSubmitted()){
        echo "gegevens ontvangen!<br/><pre>";
        var_dump($f->export());
        echo "</pre>";
    }