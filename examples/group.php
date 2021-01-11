<?php
  echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    use spidfire\Utilities\HtmlBuilder;
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->input('groupname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\NotNull())
      ->label("Naam van de group"); // label of this field

    $options = array();
    $lines = file('names.txt',FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    foreach ($lines as $key => $value) {
      $options[$key+3] = $value;
    }
    $f->autocompete('lastname')
      ->label("LastName")
      ->options($options);

    $s = $f->submit('Verzend met deze knop');

    

    if($s->isClicked()){
        if($f->hasNoErrors()){
            echo "gegevens ontvangen!<br/>";
            var_dump($f->export());            
        }
        echo $f->render(spidfire\FormAl::SHOW_ERRORS);
    }else{
        echo $f->render(spidfire\FormAl::HIDE_ERRORS);
    }

   
