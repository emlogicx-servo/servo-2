<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "exec": {
    "steps": [
      "Connections/servodb",
      {
        "name": "_query",
        "module": "dbupdater",
        "action": "custom",
        "output": true,
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "ALTER TABLE servo_product_discount AUTO_INCREMENT = 1;\n",
            "params": []
          }
        }
      }
    ],
    "catch": {
      "name": "_error",
      "module": "core",
      "action": "setvalue",
      "output": true,
      "options": {
        "value": "{{$_ERROR}}"
      }
    }
  }
}
JSON
);
?>