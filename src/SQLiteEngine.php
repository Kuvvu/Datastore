<?php

namespace Datastore;

use Medoo\Medoo;

class SQLiteEngine extends Engine{

  public function save($values, $name){
    if(!file_exists($this->path)) mkdir($this->path, 0777, true);
    $db = new Medoo([
    	'database_type' => 'sqlite',
    	'database_file' => $this->path ."/".$name.".db"
    ]);
    $db->query( "CREATE TABLE IF NOT EXISTS 'storage' ('key' varchar(256) DEFAULT NULL, 'value' varchar(1024) DEFAULT NULL);" );
    foreach ($values as $key => $value) {
      if($db->count('storage', ['key' => $key]) == 0){
        $db->insert('storage', ['key' => $key, 'value' => (is_array($value)?json_encode($value):$value)]);
      } else {
        $db->update('storage', ['key' => $key, 'value' => (is_array($value)?json_encode($value):$value)], ['key' => $key]);
      }
    }
    return ( $db->error()[1] ) ? false : true;
  }

  public function load($name){
    $arr = [];
    if(!file_exists($this->path ."/".$name.".db")){
      return $arr;
    } else {
      $db = new Medoo([
      	'database_type' => 'sqlite',
      	'database_file' => $this->path ."/".$name.".db"
      ]);
      foreach ($db->select('storage',['key','value']) as $row) {
        $arr[$row['key']] = $row['value'];
      }
      return $arr;
    }
  }

  public function delete($name){
    unlink($this->path."/".$name.".db");
  }

}
