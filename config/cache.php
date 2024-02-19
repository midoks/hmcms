<?php
return array (
  'default' => 'file',
  'stores' => 
  array (
    'file' => 
    array (
      'type' => 'File',
      'path' => '',
      'prefix' => '',
      'expire' => 0,
      'tag_prefix' => 'tag:',
      'serialize' => 
      array (
      ),
    ),
    'master' => 
    array (
      'type' => 'redis',
      'host' => '127.0.0.1',
      'port' => '6379',
      'password' => '',
      'persistent' => false,
    ),
    'slave' => 
    array (
      'type' => 'redis',
      'host' => '127.0.0.1',
      'port' => '6380',
      'password' => 'Z7ga0nJv3P',
      'persistent' => false,
    ),
  ),
  'use_redis' => true,
  'prefix' => 'ghxbcdelxgohrf12mt',
);