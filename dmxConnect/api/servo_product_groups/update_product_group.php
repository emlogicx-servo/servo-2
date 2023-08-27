<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_group_name"
      },
      {
        "type": "number",
        "name": "product_group_id"
      },
      {
        "type": "number",
        "name": "group_product_department"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_product_group",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_groups",
              "column": "product_group_name",
              "type": "text",
              "value": "{{$_POST.product_group_name}}"
            },
            {
              "table": "servo_product_groups",
              "column": "group_product_department",
              "type": "number",
              "value": "{{$_POST.group_product_department}}"
            }
          ],
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
          "query": "UPDATE servo_product_groups\nSET product_group_name = :P1 /* {{$_POST.product_group_name}} */, group_product_department = :P2 /* {{$_POST.group_product_department}} */\nWHERE product_group_id = :P3 /* {{$_POST.product_group_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.product_group_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.group_product_department}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.product_group_id}}"
            }
          ],
          "returning": "product_group_id"
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