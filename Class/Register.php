<?php
class Register {
protected $data = array() ;
function __construct () {
}
 
function _read () {
$this->data['login'] = $_POST['login'] ;
$this->data['pass'] = $_POST['pass'] ;
}
 
function _write () {
echo "Wprowadzone dane<br/>" ;
echo "Login: ". $this->data['login'] ." <br/>" ;
echo "Hasło: ". $this->data['pass'] ." <br/>" ;
}
}
?>