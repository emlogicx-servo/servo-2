<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "uom_product_id"
      },
      {
        "type": "text",
        "name": "uom_name"
      },
      {
        "type": "number",
        "name": "uom_reference_multiple"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_product_uom",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_product_uom_multiples",
              "column": "uom_product_id",
              "type": "number",
              "value": "{{$_POST.uom_product_id}}"
            },
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
          "returning": "uom_ratio_id",
          "query": "insert into `servo_product_uom_multiples` (`uom_name`, `uom_product_id`, `uom_reference_multiple`) values (?, ?, ?)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.uom_product_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.uom_name}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.uom_reference_multiple}}",
              "test": ""
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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