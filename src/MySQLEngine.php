<?php

namespace Datastore;

use Medoo\Medoo;

class MySQLEngine extends Engine{

  public function save($values, $name){
    if(!file_exists($this->path)) mkdir($this->path, 0777, true);
    $db = new Medoo([
      'charset' => 'utf8',
      'database_type' => 'mysql',
      'database_name' => $values['MYSQL_DATABASE'],
      'server'        => $values['MYSQL_SERVER'],
      'username'      => $values['MYSQL_USER'],
      'password'      => $values['MYSQL_PASSWORD']
    ]);
    $db->query( "CREATE TABLE IF NOT EXISTS $name ('key' varchar(256) DEFAULT NULL, 'value' varchar(1024) DEFAULT NULL);" );
    foreach ($values as $key => $value) {
      if($db->count($name, ['key' => $key]) == 0){
        $db->insert($name, ['key' => $key, 'value' => (is_array($value)?json_encode($value):$value)]);
      } else {
        $db->update($name, ['key' => $key, 'value' => (is_array($value)?json_encode($value):$value)], ['key' => $key]);
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
        'charset' => 'utf8',
        'database_type' => 'mysql',
        'database_name' => $values['MYSQL_DATABASE'],
        'server'        => $values['MYSQL_SERVER'],
        'username'      => $values['MYSQL_USER'],
        'password'      => $values['MYSQL_PASSWORD']
      ]);
      foreach ($db->select($name,['key','value']) as $row) {
        $arr[$row['key']] = $row['value'];
      }
      return $arr;
    }
  }

  public function delete($name){
    unlink($this->path."/".$name.".db");
  }

}
