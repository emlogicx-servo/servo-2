<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "po_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "deletePOItems",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_purchase_orders",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "po_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.po_id}}",
                "data": {
                  "column": "po_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "DELETE\nFROM servo_purchase_orders\nWHERE po_id = :P1 /* {{$_POST.po_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.po_id}}"
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