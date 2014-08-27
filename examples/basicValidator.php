***REMOVED***
    
    use spidfire\Utilities\HtmlBuilder;
***REMOVED***

***REMOVED***

    $f->input('firstname') // useable name (like db name)
***REMOVED***
      ->label("Firstname"); // label of this field

    $f->input('lastname')
      ->min(3)
      ->label("LastName");

***REMOVED***



    $f->import(array(
      "firstname" => "Test123"
      ));
    
    

    if($s->isClicked()){
        echo "gegevens ontvangen!<br/><pre>";
        var_dump($f->export());
        echo "</pre>";
    ***REMOVED***


***REMOVED***

    