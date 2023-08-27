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
        "name": "group_product_department"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_product_group",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
          "returning": "product_group_id",
          "query": "INSERT INTO servo_product_groups\n(product_group_name, group_product_department) VALUES (:P1 /* {{$_POST.product_group_name}} */, :P2 /* {{$_POST.group_product_department}} */)",
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