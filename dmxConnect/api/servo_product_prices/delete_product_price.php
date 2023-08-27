<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "query_delete_product_price",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
      "table": "servo_product_price",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "product_price_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.product_price_id}}",
            "data": {
              "column": "product_price_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_product_price\nWHERE product_price_id = :P1 /* {{$_POST.product_price_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.product_price_id}}"
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