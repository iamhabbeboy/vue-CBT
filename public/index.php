<?php
/**
 * Created by PhpStorm.
 * User: Azeez Abiodun
 * Date: 7/7/2015
 * Time: 1:39 PM
 */

require ('../db/Model.php');
//header('location: ../index.php');

$db = new Model();

// $query = $db->find_by_id('admin', array('id' => 1));
// 
 // print $query->rowCount();

 $sql = $db -> update_by_fields('admin', array('admin' => 'megafuse', 'pass' => 'admin', '->id' => 1));
 
  print $sql->rowCount();
