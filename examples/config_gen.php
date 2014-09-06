<?php
    
    include("../vendor/autoload.php");

    $f = new spidfire\FormAl("UserEdit");

    $f->input('basename')
      ->addValidator(new spidfire\Validators\MinLength(3))
      ->addValidator(new spidfire\Validators\PregMatch('/[a-z]{3,20}/'))
      ->label("De naam van de vereniging");

	$f->input('mysql_host')
	  ->defaultValue('localhost')
	  ->label('mysql_host');

	$f->input('mysql_database')
	  ->min(5)
	  ->label('mysql_database');

	$f->input('mysql_username')
	  ->min(5)
	  ->label('mysql_username');

	$f->input('mysql_password')
	  ->min(5)
	  ->label('mysql_password');

	$f->input('media_token')
	  ->defaultValue('TEST')
	  ->label('media_token');

	$f->input('media_token_secret')
	  ->defaultValue('ASDAUJUSJDJKEKLJSDJFLS')
	  ->label('media_token_secret');

	$f->input('ads_token')
	  ->defaultValue('TEST')
	  ->label('ads_token');

	$f->input('ads_token_secret')
	  ->defaultValue('ASDAUJUSJDJKEKLJSDJFLS')
	  ->label('ads_token_secret');

	$f->input('appname')
	  ->defaultValue('Almanapp Prototype')
	  ->label('appname');

	$f->input('appdesc')
	  ->defaultValue('De is de test almanapp van Alamanpp B.V.')
	  ->label('appdesc');

	$f->input('vereniging')
	  ->defaultValue('Groninger studenten mobile applicatie Bouw co-operatie')
	  ->label('vereniging');

	$f->input('vereniging_website')
	  ->defaultValue('http://almanapp.nl')
	  ->label('vereniging_website');

	$f->input('root_account')
	  ->defaultValue('grunalmanapp')
	  ->label('root_account');

	$f->input('plaats')
	  ->defaultValue('Groningen')
	  ->label('plaats');

	$f->input('contact')
	  ->defaultValue('Djurre de Boer <Almanapp Developer>')
	  ->label('contact');

	$f->input('contact_mobiel')
	  ->defaultValue('06-16289005')
	  ->label('contact_mobiel');

	$f->input('contact_email')
	  ->defaultValue('dev@djur.re')
	  ->label('contact_email');

	$f->input('ios_link')
	  ->defaultValue('')
	  ->label('ios_link');

	$f->input('android_link')
	  ->defaultValue('')
	  ->label('android_link');

	$f->input('phonegapbuild_id')
	  ->defaultValue('')
	  ->label('phonegapbuild_id');



    $s = $f->submit('Verzend met deze knop');

     if($s->isClicked()){
        if($f->hasNoErrors()){
	        echo "gegevens ontvangen!<br/>";
	        $export = $f->export();

	        $data = file_get_contents('config_gen_tpl.php');
	        foreach ($export as $key => $value) {
	        	$data = preg_replace("/\\{\s*".$key."\s*\\}/is", $value, $data);
	        }
	        echo "<textarea>".htmlentities($data)."</textarea>";
	    }
    }

    echo $f->render();
