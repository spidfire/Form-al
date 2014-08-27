<?php
    use spidfire\Utilities\HtmlBuilder;
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->input('firstname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\MinLength(3))
      ->label("Firstname"); // label of this field

    $options = array(
                'Targaryen' => 'Targaryen (like the last name of Daenerys)',
                'Lanister' => 'Lanister (A Lanister always pays it\'s debts)',
                'Lesser houses' => array(
                    'Hordor' => 'Hodor (Hodor, Hodor Hodor Hodor, Hodor Hodor Hodor)',
                    'Karstark ' => 'Karstark (We are kin. Stark and Karstark.)',
                    'P' => 'Last name "P" (this should be too short)',
                )
            );
    $f->select('lastname')
      ->label("LastName")
      ->addValidator(new spidfire\Validators\MinLength(3))
      ->addValidator(new spidfire\Validators\PregMatch('/^.*e[nr]$/')) // will match Targaryen and Lanister
      ->options($options);

    $s = $f->submit('Verzend met deze knop');
    $reset = $f->submit('Reset Data');


    

    if($s->isClicked()){
        echo "gegevens ontvangen!<br/>";
        var_dump($f->export());
    }

    if($reset->isClicked()){
        $f->import(array());
        $_GET = array();
    }
    echo $f->render();
