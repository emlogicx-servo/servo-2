<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "customer_picture"
      },
      {
        "type": "file",
        "name": "customer_picture_file",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "text",
        "name": "customer_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_customer_picture",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/customer_pictures",
          "fields": "{{$_POST.customer_picture_file}}"
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file",
        "output": true
      },
      {
        "name": "replace_customer_picture",
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
                "value": "{{upload_customer_picture.name}}"
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
            "query": "UPDATE servo_customers\nSET customer_picture = :P1 /* {{upload_customer_picture.name}} */\nWHERE customer_id = :P2 /* {{$_POST.customer_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{upload_customer_picture.name}}"
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