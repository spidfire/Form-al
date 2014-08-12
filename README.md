Form-al RFC
=======

Form engine for php
    
    ***REMOVED***
    $f = new Form("UserEdit");

    $f->input('name')
      ->label("Naam")
      ->minlen(2)
      ->empty(true)
      ->nospecialchars();

    $f->select('gender')
      ->label("Geslacht")
      ->values(array("m" => "Man", "f" => "Female"))  // (k = key, v = value, l = sublist name) can be [kv,kv] OR {k => v***REMOVED*** OR {l => {k => v***REMOVED******REMOVED*** OR  {l => [kv]***REMOVED***


    $f->hidden('insertTime')
      ->onInsert(time())
      ->noUpdate();

    $f->hidden('updateTime')
      ->onInsert(time())
      ->onUpdate(time());

    $f->datepicker('birthdate')
      ->label('Geboortedatum')
      ->default(date('d-M-Y H:i:m'))
      ->

    if(isset($_GET['id'])){
        //update
        if($f->submitted()){    
            $data = $f->export();
            DB::update('user',$data,"id=%d",$_GET['id']);
        ***REMOVED***

        $user = DB::queryFirstRow("select * from user where id = %d");
        $f->import($user);
    ***REMOVED***else{
        //insert
        if($f->submitted()){    
            $data = $f->export();
            DB::insert('user',$data);
            CORE::redirect("user/".DB::insertId());
        ***REMOVED***
    ***REMOVED***



    $pageVars['errors'] = $f->errors();
    $pageVars['form'] = $f->html();
