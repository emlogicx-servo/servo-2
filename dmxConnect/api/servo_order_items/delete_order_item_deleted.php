<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "order_item_delete_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_order_item_deleted",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_order_item_deletes",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "order_item_delete_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.order_item_delete_id}}",
                "data": {
                  "column": "order_item_delete_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "order_item_delete_id",
          "query": "DELETE\nFROM servo_order_item_deletes\nWHERE order_item_delete_id = :P1 /* {{$_POST.order_item_delete_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.order_item_delete_id}}"
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
  }
}
JSON
);
?>