<?php
$exports = <<<'JSON'
{
  "name": "servodb",
  "module": "dbconnector",
  "action": "connect",
  "options": {
    "server": "mysql",
    "databaseType": "MySQL",
    "connectionString": "mysql:host=localhost;dbname=servodb;user=root;password=root;sslverify=false",
    "meta": false
  }
}
JSON;
?>