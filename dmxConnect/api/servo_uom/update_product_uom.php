<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "uom_name"
      },
      {
        "type": "number",
        "name": "uom_reference_multiple"
      },
      {
        "type": "number",
        "name": "uom_multiple_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_product_uom",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_product_uom_multiples",
              "column": "uom_name",
              "type": "text",
              "value": "{{$_POST.uom_name}}"
            },
            {
              "table": "servo_product_uom_multiples",
              "column": "uom_reference_multiple",
              "type": "number",
              "value": "{{$_POST.uom_reference_multiple}}"
            }
          ],
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
          "query": "update `servo_product_uom_multiples` set `uom_name` = ?, `uom_reference_multiple` = ? where `uom_multiple_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.uom_name}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.uom_reference_multiple}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
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
      ]
    }
  }
}
JSON
);
?>