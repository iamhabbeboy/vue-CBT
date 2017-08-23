<?php
/**
 * Created by PhpStorm.
 * User: Azeez Abiodun
 * Date: 6/8/2015
 * Time: 11:28 AM
 * Framework Title: simplePDO....
 * By: <elitecode>
 */

namespace connect;


class Mysql {

      public static $mysql;
      var$mysqlData,
         $mysqlRow;

       public function __construct() {

           try {
               self::$mysql = new \PDO("mysql:host=localhost;dbname=megafuse", "root", "root");
               self::$mysql->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

           }catch (\PDOException $e) {

               echo "Unable to Connect to Server ".$e->getMessage();
           }
       }


    public function stringSecurity($string) {

        $string = ((!filter_var($string, FILTER_SANITIZE_STRING)) ? 'invalid character': '');
        return $string;
    }


    /**
     * @param $table
     * @param $fields
     * @return mixed
     * this method allows user to save record to MySQL PDO with ease...
     *  constructor->save('table_name', array('field'=>'value'));
     */

    public function insert($table, $fields)
    {
        $newFields = count($fields);


        if ($newFields >= 0) {

            $string = '';
            $question = array();
            $val = array();
            foreach ($fields as $key => $value) {

                $string .=$key.', ';
                array_push($question, $key);
                array_push($val, $value);
            }

            $fb = array($fields);
            $tbFields = substr($string, 0, strlen($string) -2);
            //$tbValues = substr($values, 0, strlen($values) -2);
            $questionField = self::convert2Question($question);


            try {

                $query = self::$mysql->prepare("INSERT INTO ".$table."(".$tbFields.") VALUES(".$questionField.")");
                $query->execute($val);

                return $query->rowCount();

            } catch(\PDOException $e) {

                echo 'Error '.$e->getMessage();
            }
        }
    }

    public function fetchAll($table, $options, $fn) {

        if($options and is_array($options)) {

            try{
         $mysql_query = self::$mysql->query("SELECT * FROM ".$table);

            $rows = $mysql_query->rowCount();
            $record = $mysql_query->fetchAll();

            return $fn($rows, $record);
        } catch(\PDOException $e) {

                echo $e->getMessage();
            }

        } else {

            echo 'Error occured !';
        }
    }

    public function fetch($table, $hashRecord, $fn) {


        if(empty($hashRecord)) {

            echo 'not found !';

        } elseif(is_array($hashRecord)) {

            $valKey = '';
            $valValue = array();
            $question = array();
            $symbols = array('&', '|', '%', '<', '>');
            $symbols_meaning = array(' AND ', ' OR ', ' LIKE ', ' < ', ' > ');

             foreach($hashRecord as $key => $value):

                 if(is_array($value)):

                      foreach($value as $k => $v):


                          endforeach;
                     else:

                    $valKey .= str_replace($symbols, $symbols_meaning, $key).'=? ';
                    array_push($valValue, $value);
                    array_push($question, $key);

                      endif;
                 endforeach;

                $tbFields = substr($valKey, 0, strlen($valKey) -1);

            try {

                $this->mysqlData = self::$mysql->prepare("SELECT * FROM " . $table . " WHERE ".$tbFields);
                $this->mysqlData->execute($valValue);

                $this->mysqlRow = $this->mysqlData->rowCount();
                $record = $this->mysqlData->fetchAll();

            }catch (\PDOException $e) {

                echo 'Error '.$e->getMessage();
            }
        }

        return $fn( $this->mysqlRow, $record );
    }


    public function row() {

        return $this->mysqlRow;
    }


    public function getrow($table, $hashRecord, $fn) {

        if(empty($hashRecord)) {

            echo 'not found !';

        } elseif(is_array($hashRecord)) {

            $valKey = '';
            $valValue = array();
            $question = array();
            $symbols = array('&', '|', '%', '<', '>');
            $symbols_meaning = array(' AND ', ' OR ', ' LIKE ', ' < ', ' > ');

            foreach($hashRecord as $key => $value):

                if(is_array($value)):

                    foreach($value as $k => $v):


                    endforeach;
                else:

                    $valKey .= str_replace($symbols, $symbols_meaning, $key).'=? ';
                    array_push($valValue, $value);
                    array_push($question, $key);

                endif;
            endforeach;

            $tbFields = substr($valKey, 0, strlen($valKey) -1);

            try {

                $sql = self::$mysql->prepare("SELECT * FROM " . $table . " WHERE ".$tbFields);
                $sql->execute($valValue);

                $row = $sql->rowCount();
                //$record = $this->mysqlData->fetchAll();

            }catch (\PDOException $e) {

                echo 'Error '.$e->getMessage();
            }
        }

        return $fn($row);
    }



    private function moveRow($row) {

        return $row;
    }


    private function convert2Question($string) {

        $stringLen = count($string);

        if($stringLen > 0) {

            $joinStr = '';
            for($i=0; $i< $stringLen; $i+=1 ) {

                $joinStr .='?,';
            }

            return substr($joinStr, 0, strlen($joinStr) -1);
        }

    }

	public function testting_stuff($name, $age) {

		if(!$age) {

			echo "Only name is supplied and age is not ".$name;
		}
	}
}
