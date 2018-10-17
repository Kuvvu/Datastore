# PHP Datastore

Simple Key/Value Datastore Class for PHP

## Installation

With composer
```
composer require kuvvu/datastore
```

## Usage

The Engine uses several Enginges witch are separated in different Engines:

- Memory Engine
- Filesystem Engine
- SQLite Engine
- MySQL Engine
- Restoo Engine

First create a new Enginge Instance for your desired Engine with the required parameters:

```php
$engine = new Engine();  // Memory Engine
```

Then create a new Database Instance with the Engine Object:


```php
$database = new Database(['engine' => $engine, $name = "awesomedatabasename"]);
```

You can then bulk access your data with the data variable:

```php
$mydata = $database->data;
```

or by key:

```php
$myvalue = $database->get('key');
```

or you can save new Data

```php
$database->set('key', 'value');
```

and of course remove them:


```php
$database->remove('key');
```

To delete a complete Database Instance an all of its data you can call:


```php
$database->destroy();
```


