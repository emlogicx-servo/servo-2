<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_brand_id"
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
          "table": "servo_product_brands",
          "query": "DELETE\nFROM servo_product_brands\nWHERE product_brand_id = :P1 /* {{$_POST.product_brand_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.product_brand_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "product_brand_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.product_brand_id}}",
                "data": {
                  "column": "product_brand_id"
                },
                "operation": "="
              }
            ]
          }
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