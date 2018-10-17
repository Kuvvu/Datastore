<?php

namespace Datastore;

class Database{

  /**
   * Datastorage Class - Simple Key->Value Storage
   *
   *
   * @array Array with Options
   * @return Database Object
  */

  protected $engine;
  protected $name;

  public function __construct($options = null){

    if (!is_array($options)) return false;
    if (isset($options[ 'engine' ]))
		{
			$this->engine = $options[ 'engine' ];
		}
    if (isset($options[ 'name' ]))
		{
			$this->name = $options[ 'name' ];
		}
    $this->data = $this->engine->load($this->name);

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
    return $this->engine->save($this->data, $this->name);
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
    return $this->engine->save($this->data, $this->name);
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
    return $this->engine->save($this->data, $this->name);
  }

  /**
   * Destroy: Deletes Storage and Files
   *
   *
   * @return void;
  */

  public function destroy(){
    $this->data = null;
    return $this->engine->delete($this->name);
  }

}
