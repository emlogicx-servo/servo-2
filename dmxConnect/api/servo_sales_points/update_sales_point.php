<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "sales_point_name"
      },
      {
        "type": "number",
        "name": "sales_point_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_sales_point",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_sales_point",
              "column": "sales_point_name",
              "type": "text",
              "value": "{{$_POST.sales_point_name}}"
            }
          ],
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
          "query": "UPDATE servo_sales_point\nSET sales_point_name = :P1 /* {{$_POST.sales_point_name}} */\nWHERE sales_point_id = :P2 /* {{$_POST.sales_point_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.sales_point_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
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