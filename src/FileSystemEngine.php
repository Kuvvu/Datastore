<?php

namespace Datastore;

class FileSystemEngine extends Engine{

  public function save($values, $name){
    return (@file_put_contents($this->path."/".$name.".json", json_encode($values))) ? true : false;
  }

  public function load($name){
    $store = $this->path."/".$name.".json";
    if(!file_exists($store)){
      if(!file_exists($this->path)) mkdir($this->path, 0777, true);
      return [];
    } else {
      return json_decode(file_get_contents($store), true);
    }
  }

  public function delete($name){
    unlink($this->path."/".$name.".json");
  }

}
