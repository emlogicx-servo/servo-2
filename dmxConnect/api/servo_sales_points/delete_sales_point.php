<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "sales_point_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_sales_point",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_sales_point",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "sales_point_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.sales_point_id}}",
                "data": {
                  "column": "sales_point_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "sales_point_id",
          "query": "DELETE\nFROM servo_sales_point\nWHERE sales_point_id = :P1 /* {{$_POST.sales_point_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.sales_point_id}}"
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