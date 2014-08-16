***REMOVED***
    
***REMOVED***

***REMOVED***

    $f->input('firstname') // useable name (like db name)
***REMOVED***
      ->label("Firstname"); // label of this field

    $f->input('lastname')
      ->min(3)
      ->label("LastName");

***REMOVED***



***REMOVED***

    if($s->isSubmitted()){
        echo "gegevens ontvangen!<br/><pre>";
        var_dump($f->export());
        echo "</pre>";
    ***REMOVED***