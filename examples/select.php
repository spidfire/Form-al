***REMOVED***
    use spidfire\Utilities\HtmlBuilder;
***REMOVED***

***REMOVED***

    $f->input('firstname') // useable name (like db name)
***REMOVED***
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
***REMOVED***
      ->addValidator(new spidfire\Validators\PregMatch('/^.*e[nr]$/')) // will match Targaryen and Lanister
      ->options($options);

***REMOVED***
    $reset = $f->submit('Reset Data');


    

    if($s->isClicked()){
        echo "gegevens ontvangen!<br/>";
        var_dump($f->export());
    ***REMOVED***

    if($reset->isClicked()){
        $f->import(array());
        $_GET = array();
    ***REMOVED***
***REMOVED***
