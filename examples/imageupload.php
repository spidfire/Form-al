<?php
  echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    use spidfire\Utilities\HtmlBuilder;
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->imageupload('groupname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\NotNull())
      ->label("Naam van de group"); // label of this field

   

    $s = $f->submit('Verzend met deze knop');

    

    if($s->isClicked()){
        if($f->hasNoErrors()){
            echo "gegevens ontvangen!<br/>";
            echo "<pre>".json_encode($f->export(),JSON_PRETTY_PRINT)."</pre>";
        }
        echo $f->render(spidfire\FormAl::SHOW_ERRORS);
    }else{
        echo $f->render(spidfire\FormAl::HIDE_ERRORS);
    }

   
