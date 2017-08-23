<?php

class Dashboard {

    public $pdo;

    public function __construct($params) {

        try {
            $this -> pdo = new PDO('sqlite: ' . $params);
        } catch(PDOException $e) {
            print "Unable to Connect !";
        }
    }
    
    function show_tables() {
        
        
    } 
    
    function row($sql) {
        
        $sql = $this->pdo->query($sql);
       return $sql->rowCount(); 
    }

}
