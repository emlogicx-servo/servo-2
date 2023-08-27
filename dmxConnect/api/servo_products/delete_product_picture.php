<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "product_picture_file"
      },
      {
        "type": "text",
        "name": "product_picture"
      },
      {
        "type": "number",
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "remove_customer_picture",
        "module": "fs",
        "action": "remove",
        "options": {
          "path": "{{'/uploads/product_pictures/'+$_POST.product_picture_file}}"
        },
        "outputType": "boolean",
        "output": true
      },
      {
        "name": "update_product_picture",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_products",
                "column": "product_picture",
                "type": "text",
                "value": "{{null}}"
              }
            ],
            "table": "servo_products",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "product_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.product_id}}",
                  "data": {
                    "column": "product_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "product_id",
            "query": "UPDATE servo_products\nSET product_picture = :P1 /* {{null}} */\nWHERE product_id = :P2 /* {{$_POST.product_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{null}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_POST.product_id}}"
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
    ]
  }
}
JSON
);
?>