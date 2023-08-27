<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "delete_po_item",
  "module": "dbupdater",
  "action": "delete",
  "options": {
    "connection": "servodb",
    "sql": {
      "type": "delete",
      "table": "servo_purchase_order_items",
      "wheres": {
        "condition": "AND",
        "rules": [
          {
            "id": "po_item_id",
            "type": "double",
            "operator": "equal",
            "value": "{{$_POST.po_item_id}}",
            "data": {
              "column": "po_item_id"
            },
            "operation": "="
          }
        ]
      },
      "query": "DELETE\nFROM servo_purchase_order_items\nWHERE po_item_id = :P1 /* {{$_POST.po_item_id}} */",
      "params": [
        {
          "operator": "equal",
          "type": "expression",
          "name": ":P1",
          "value": "{{$_POST.po_item_id}}"
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