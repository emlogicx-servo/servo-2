<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "uom_multiple_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_product_uom",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_product_uom_multiples",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "uom_multiple_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.uom_multiple_id}}",
                "data": {
                  "column": "uom_multiple_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "uom_multiple_id",
          "query": "delete from `servo_product_uom_multiples` where `uom_multiple_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.uom_multiple_id}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ],
      "output": true
    }
  }
}
JSON
);
?>