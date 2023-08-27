<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_sub_category_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_product_sub_category",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_sub_category_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_sub_category_id}}",
                "data": {
                  "column": "product_sub_category_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "DELETE\nFROM servo_product_sub_category\nWHERE product_sub_category_id = :P1 /* {{$_POST.product_sub_category_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.product_sub_category_id}}"
            }
          ],
          "returning": "product_sub_category_id"
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