<?php

/*
try {
    $db = new PDO('sqlite:./cbt.db');

	$sql = $db->exec("CREATE TABLE IF NOT EXISTS tb_question (
    id              INTEGER      PRIMARY KEY AUTOINCREMENT,
    answer          CHAR,
    question        TEXT,
    A               TEXT,
    B               TEXT,
    C               TEXT,
    D               TEXT,
    date_registered VARCHAR (20) 
    ");
    
} catch(Exception $e) {
    print "Error occured !";
}
 * 
 */
 
//print var_dump($argv);
class sqlite {
    
    public $pdo;
    function __construct() {
        $args = func_get_args();
        print $this->create_table($args);
    }
    
    private function create_table($a) {
        
        $string = 'CREATE TABLE IF NOT EXISTS '.$a[0][2].'(id integer primary key auto_increment ';
        $db = '';
        
        foreach($a as $key => $value ) {
            
            foreach($value as $k => $v){
                if($k == 0 ) {
  
                }else if($k == 1) {
                    
                    $db .= $v;
                    
                } else {
                        $string .= $v.' ';
                    
                }
            }
        }
  
        $table = str_replace(array('[',']', '.'), array('(', ')', ' '), $string).')';
       $this->create_engine($db, $table);
     
    } 
    
    private function create_engine($db, $table) {
            
        try{
            
            $this->pdo = new PDO('sqlite: '.$db);
           $this->pdo->exec($table);
           print "Table created successfully !";
             
        }catch(PDOException $e) {
           print "Unable to Create Database !"; 
        }
    }
    
    
}

new sqlite($argv);


