<?php

namespace Datastore;

class Engine{

  public function __construct($options = null){

    if (isset($options[ 'storage' ]))
		{
			$this->path = strtolower($options[ 'storage' ]);
		}

  }

  public function save($values, $name){
    return true;
  }

  public function load($name){
    return [];
  }

  public function delete($name){
    return true;
  }


}
