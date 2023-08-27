<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "product_group_id"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "read_product_group",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_product_groups"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_groups.product_group_id",
                "field": "servo_product_groups.product_group_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_group_id}}",
                "data": {
                  "table": "servo_product_groups",
                  "column": "product_group_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_product_groups\nWHERE product_group_id = :P1 /* {{$_GET.product_group_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_group_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_group_id"
        },
        {
          "type": "text",
          "name": "product_group_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>