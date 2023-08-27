<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_categories_id"
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
          "table": "servo_product_categories",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_categories_id",
                "field": "product_categories_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_categories_id}}",
                "data": {
                  "column": "product_categories_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "DELETE\nFROM servo_product_categories\nWHERE product_categories_id = :P1 /* {{$_POST.product_categories_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.product_categories_id}}"
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