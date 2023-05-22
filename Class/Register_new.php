<?php
class Register_new extends Register{
    private $dbh;
    private $dbfile = "../datadb.db" ;

    function __construct () {
        parent::__construct() ;
        session_start() ;  
    }
    
    /* Zapis danych do bazy */
    function _save () {
        $this->dbh = dba_open( $this->dbfile, "c");
        if ( !dba_exists($this->data['login'], $this->dbh )) {
            $serialized_data = serialize($this->data) ;
            dba_insert($this->data['login'],$serialized_data, $this->dbh) ;
            $text = 'Registered successfully' ;
        } else {
            $text = 'Failed to register. There is user with those data' ;
        }   
        dba_close($this->dbh) ;
        echo '<p style="font-size:18px; font-weight: bold;">'.$text.'</p>';
    }
    
    function _login() {
        $email = $_POST['login'] ;
        $pass = $_POST['pass'] ;
        $access = false ;
        $this->dbh = dba_open( $this->dbfile, "r");
        if ( dba_exists( $email, $this->dbh ) ) {
            $serialized_data = dba_fetch($email, $this->dbh) ;
            $this->data = unserialize($serialized_data);
            if ($this->data ['pass'] == $pass ) {
                $_SESSION['auth'] = 'OK' ;
                $_SESSION['user'] = $email ;
                $access = true ;
            }
        }
        dba_close($this->dbh) ;
        $text = ( $access ? 'You are signed in' : 'Failed to log in' ) ;

        echo '<p style="font-size:18px; font-weight: bold;">'.$text.'</p>';
    }

    /* Sprawdzamy czy uzytkownik jest zalogowany */
    function _is_logged() {
        if ( isset ( $_SESSION['auth'] ) ) {
            $ret = $_SESSION['auth'] == 'OK' ? true : false ;
        }else { 
            $ret = false ;
        }
        return $ret ;
    }   

    function _logout() {
        unset($_SESSION);
        session_destroy();
        echo '<p style="font-size:18px; font-weight: bold;">Logged out</p>';
    }

    function _read () {
        $this->data['login'] = $_POST['login'] ;
        $this->data['pass'] = $_POST['pass'] ;
        }

    function _write () {
        echo "Wprowadzone dane <br/>" ;
        echo "Login: ". $this->data['login'] ." <br/>" ;
        echo "Hasło: ". $this->data['pass'] ." <br/>" ;
        }
}
?>