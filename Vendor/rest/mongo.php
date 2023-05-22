<?php
  
//require 'vendor/autoload.php' ;
  
class db {
    private $user = "0slawinski" ;
    private $pass = "pass0slawinski";
    private $host = "172.20.44.25";
    private $base = "0slawinski";
    private $coll = "parameters";
    private $conn;
    private $dbase;
    private $collection;
  
  
  
    function __construct() {
      //$this->conn = new Mongo("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");
      $this->conn = new MongoDB\Client("mongodb://{$this->user}:{$this->pass}@{$this->host}/{$this->base}");    
      //$this->dbase = $this->conn->selectDB($this->base);
      //$this->collection = $this->dbase->selectCollection($this->coll);
      $this->collection = $this->conn->{$this->base}->{$this->coll};
    }
  
    function select() {
      $cursor = $this->collection->find([],['projection' => ['_id' => 0]]);//wynik obejmuje wszystkie atrybuty oprócz _id
 
      $table = iterator_to_array($cursor);
      return $table ;
    }
  
    function insert($user) {
      $ret = $this->collection->insertOne($user) ;
      return $ret;
    }
  
}
?>