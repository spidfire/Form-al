***REMOVED***
echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
echo "<link href='http://getbootstrap.com/dist/css/bootstrap.min.css' rel='stylesheet'>";
  include ("../vendor/autoload.php");

$f = new spidfire\FormAl("UserEdit");

$f->input('input')
->label("Text input");


$f->textarea('textarea')
->label("Textarea");

$f->checkbox('checkbox')
  ->label("Checkbox");

$options = array(
    'Targaryen' => 'Targaryen (like the last name of Daenerys)', 
    'Lanister' => 'Lanister (A Lanister always pays it\'s debts)', 
    'Lesser houses' => array(
        'Hordor' => 'Hodor (Hodor, Hodor Hodor Hodor, Hodor Hodor Hodor)', 
        'Karstark ' => 'Karstark (We are kin. Stark and Karstark.)', 
        ));
$f->select('select')
  ->label("Select box")
  ->options($options);

$f->radio('radio')
  ->label("Radio buttons")
  ->options($options);

$f->datepicker('datepicker')
  ->label("Datepicker");

$options = array();
$lines = file('names.txt',FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
foreach ($lines as $key => $value) {
  $options[$key+3] = $value;
***REMOVED***
    $f->autocompete('autocomplete')
      ->label("Autocomplete")
      ->options($options);

$s = $f->submit('Verzend met deze knop');

if ($s->isClicked()) {
    echo "gegevens ontvangen!<br/>";
    var_dump($f->export());
***REMOVED***

echo $f->render();
