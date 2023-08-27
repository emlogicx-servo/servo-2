<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "get_last_insert",
  "module": "dbupdater",
  "action": "custom",
  "options": {
    "connection": "servodb",
    "sql": {
      "query": "select last_insert_id()",
      "params": []
    }
  },
  "output": true,
  "meta": [
    {
      "name": "last_insert_id()",
      "type": "text"
    }
  ]
}
JSON
);
?>