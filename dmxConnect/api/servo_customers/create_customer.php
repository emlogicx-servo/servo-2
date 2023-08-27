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
        "name": "customer_first_name"
      },
      {
        "type": "text",
        "name": "customer_last_name"
      },
      {
        "type": "number",
        "name": "customer_phone_number"
      },
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
        "name": "customer_class"
      },
      {
        "type": "text",
        "name": "customer_sex"
      },
      {
        "type": "datetime",
        "name": "customer_dob"
      },
      {
        "type": "number",
        "name": "customer_age"
      },
      {
        "type": "text",
        "name": "customer_address"
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
        "name": "insert_customer",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_customers",
                "column": "customer_first_name",
                "type": "text",
                "value": "{{$_POST.customer_first_name}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_last_name",
                "type": "text",
                "value": "{{$_POST.customer_last_name}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_phone_number",
                "type": "number",
                "value": "{{$_POST.customer_phone_number}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_picture",
                "type": "text",
                "value": "{{upload_customer_picture.name}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_class",
                "type": "text",
                "value": "{{$_POST.customer_class}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_sex",
                "type": "text",
                "value": "{{$_POST.customer_sex}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_dob",
                "type": "datetime",
                "value": "{{$_POST.customer_dob}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_age",
                "type": "number",
                "value": "{{$_POST.customer_age}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_address",
                "type": "text",
                "value": "{{$_POST.customer_address}}"
              }
            ],
            "table": "servo_customers",
            "returning": "customer_id",
            "query": "INSERT INTO servo_customers\n(customer_first_name, customer_last_name, customer_phone_number, customer_picture, customer_class, customer_sex, customer_dob, customer_age, customer_address) VALUES (:P1 /* {{$_POST.customer_first_name}} */, :P2 /* {{$_POST.customer_last_name}} */, :P3 /* {{$_POST.customer_phone_number}} */, :P4 /* {{upload_customer_picture.name}} */, :P5 /* {{$_POST.customer_class}} */, :P6 /* {{$_POST.customer_sex}} */, :P7 /* {{$_POST.customer_dob}} */, :P8 /* {{$_POST.customer_age}} */, :P9 /* {{$_POST.customer_address}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.customer_first_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.customer_last_name}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.customer_phone_number}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{upload_customer_picture.name}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.customer_class}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.customer_sex}}"
              },
              {
                "name": ":P7",
                "type": "expression",
                "value": "{{$_POST.customer_dob}}"
              },
              {
                "name": ":P8",
                "type": "expression",
                "value": "{{$_POST.customer_age}}"
              },
              {
                "name": ":P9",
                "type": "expression",
                "value": "{{$_POST.customer_address}}"
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
      },
      {
        "name": "get_last_created_customer",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "current_customer",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{get_last_created_customer[0]['last_insert_id()']}}"
        },
        "meta": [],
        "outputType": "number"
      }
    ]
  }
}
JSON
);
?>