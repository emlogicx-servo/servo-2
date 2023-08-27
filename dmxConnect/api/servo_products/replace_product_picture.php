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
        "type": "file",
        "name": "product_picture_file",
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
        "name": "upload_product_picture",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/product_pictures",
          "fields": "{{$_POST.product_picture_file}}"
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
        "name": "replace_product_picture",
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
                "value": "{{upload_product_picture.name}}"
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
            "query": "UPDATE servo_products\nSET product_picture = :P1 /* {{upload_product_picture.name}} */\nWHERE product_id = :P2 /* {{$_POST.product_id}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{upload_product_picture.name}}"
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