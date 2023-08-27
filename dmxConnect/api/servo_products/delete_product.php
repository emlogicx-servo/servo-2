<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "query_delete_product",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
      "table": "servo_products",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "product_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.product_id}}",
            "data": {
              "column": "product_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_products\nWHERE product_id = :P1 /* {{$_POST.product_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.product_id}}"
        }
      ]
    }
  },
  "meta": [
    {
      "name": "affected",
      "type": "number"
    }
  ]
}
JSON
);
?>