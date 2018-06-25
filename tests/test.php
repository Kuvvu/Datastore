<?php

require '../vendor/autoload.php';
use Datastore\Database;

$db = new Database(['name'=>'testDatabase']);

$db->set("1", array(1,2,3,4,5,6,7,8,9,0));
$db->set("3", [
  'test1' => 1,
  'test2' => 2
]);

var_dump($db->data);

$db->get("1");
$db->remove("1");

var_dump($db->data);
