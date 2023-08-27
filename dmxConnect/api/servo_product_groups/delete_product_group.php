<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_group_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_product_group",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_product_groups",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_group_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_group_id}}",
                "data": {
                  "column": "product_group_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "DELETE\nFROM servo_product_groups\nWHERE product_group_id = :P1 /* {{$_POST.product_group_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.product_group_id}}"
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