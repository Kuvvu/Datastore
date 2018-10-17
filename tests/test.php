<?php

require '../vendor/autoload.php';

use Datastore\Database;
use Datastore\SQLiteEngine;

$engine = new SQLiteEngine(['storage' => '../tests/storage']);
$db = new Database(['engine' => $engine, 'name'=>'testDatabase']);

$db->set('test', 123455);
$db->set('test1', array(5,6));

var_dump($db->data);

$db->destroy();
