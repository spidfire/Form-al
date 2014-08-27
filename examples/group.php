***REMOVED***
  echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    use spidfire\Utilities\HtmlBuilder;
***REMOVED***

***REMOVED***

    $f->input('groupname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\NotNull())
      ->label("Naam van de group"); // label of this field

    $options = array();
    $lines = file('names.txt',FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    foreach ($lines as $key => $value) {
      $options[$key+3] = $value;
    ***REMOVED***
    $f->autocompete('lastname')
      ->label("LastName")
      ->options($options);

***REMOVED***

    

    if($s->isClicked()){
***REMOVED***
            echo "gegevens ontvangen!<br/>";
            var_dump($f->export());            
        ***REMOVED***
        echo $f->render(spidfire\FormAl::SHOW_ERRORS);
    ***REMOVED***else{
        echo $f->render(spidfire\FormAl::HIDE_ERRORS);
    ***REMOVED***

   
