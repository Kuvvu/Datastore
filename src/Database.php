<?php

namespace Datastore;

class Database{

  /**
   * Datastorage Class - Simple Key->Value Storage
   *
   *
   * @name String name of Storage
   * @return Database Object
  */

  protected $store;
  protected $path = "storage/";

  public function __construct($options = null){

    if (!is_array($options)) return false;
    if (isset($options[ 'path' ]))
		{
			$this->path = strtolower($options[ 'path' ]);
		}
    if (isset($options[ 'name' ]))
		{
			$this->store = $this->path.strtolower($options[ 'name' ]).".json";
		}

    if(!file_exists($this->store)){
      if(!file_exists($this->path)) mkdir($this->path, 0777, true);
      $this->data = [];
    } else {
      $this->data  = json_decode(file_get_contents($this->store), true);
    }

  }

  private function save(){
    return (@file_put_contents($this->store, json_encode($this->data))) ? true : false;
  }

  /**
   * Get: Get Value of Key
   *
   *
   * @key key or false -> returns complete storage on false
   * @return key value or complete storage.
  */

  public function get($key = false){
    return ($key) ? $this->data[$key] : $this->data;
  }

  /**
   * Set: Set Value of Key
   *
   *
   * @key name of key
   * @value value for key
   * @return boolean true if data is updated or Error Message.
  */

  public function set($key, $value){
    $this->data[$key] = $value;
    return $this->save();
  }

  /**
   * Bulk: Bulk Update of complete storage
   *
   *
   * @array Array of Data
   * @return boolean true if data is updated or Error Message.
  */

  public function bulk($array){
    $this->data = $array;
    return $this->save();
  }

  /**
   * Remove: Remove Key from Storage
   *
   *
   * @key name of key
   * @return boolean true if data is updated or Error Message.
  */

  public function remove($key){
    unset($this->data[$key]);
    return $this->save();
  }

  /**
   * Destroy: Deletes Storage and Files
   *
   *
   * @return void;
  */

  public function destroy(){
    $this->data = null;
    unlink($this->store);
  }

}
