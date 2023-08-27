<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "customer_picture"
      },
      {
        "type": "text",
        "name": "customer_picture_file"
      },
      {
        "type": "number",
        "name": "customer_id"
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
          "path": "{{'/uploads/customer_pictures/'+$_POST.customer_picture_file}}"
        },
        "outputType": "boolean",
        "output": true
      },
      {
        "name": "update_customer_picture",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "servo_customers",
                "column": "customer_picture",
                "type": "text",
                "value": "{{null}}"
              }
            ],
            "table": "servo_customers",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "customer_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_POST.customer_id}}",
                  "data": {
                    "column": "customer_id"
                  },
                  "operation": "="
                }
              ]
            },
            "returning": "customer_id",
            "query": "UPDATE servo_customers\nSET customer_picture = :P1 /* {{null}} */\nWHERE customer_id = :P2 /* {{$_POST.customer_id}} */",
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
                "value": "{{$_POST.customer_id}}"
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