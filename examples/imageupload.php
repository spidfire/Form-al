***REMOVED***
  echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
    use spidfire\Utilities\HtmlBuilder;
***REMOVED***

***REMOVED***

    $f->imageupload('groupname') // useable name (like db name)
      ->addValidator(new spidfire\Validators\NotNull())
      ->label("Naam van de group"); // label of this field

   

***REMOVED***

    

    if($s->isClicked()){
***REMOVED***
            echo "gegevens ontvangen!<br/>";
            echo "<pre>".json_encode($f->export(),JSON_PRETTY_PRINT)."</pre>";
        ***REMOVED***
        echo $f->render(spidfire\FormAl::SHOW_ERRORS);
    ***REMOVED***else{
        echo $f->render(spidfire\FormAl::HIDE_ERRORS);
    ***REMOVED***

   
