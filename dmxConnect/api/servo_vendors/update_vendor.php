<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "vendor_name"
      },
      {
        "type": "text",
        "name": "vendor_address"
      },
      {
        "type": "number",
        "name": "vendor_phone_number"
      },
      {
        "type": "number",
        "name": "vendor_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_vendor",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_vendors",
              "column": "vendor_name",
              "type": "text",
              "value": "{{$_POST.vendor_name}}"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_address",
              "type": "text",
              "value": "{{$_POST.vendor_address}}"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_phone_number",
              "type": "number",
              "value": "{{$_POST.vendor_phone_number}}"
            },
            {
              "table": "servo_vendors",
              "column": "vendor_id",
              "type": "number",
              "value": "{{$_POST.vendor_id}}"
            }
          ],
          "table": "servo_vendors",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "vendor_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.vendor_id}}",
                "data": {
                  "column": "vendor_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "vendor_id",
          "query": "UPDATE servo_vendors\nSET vendor_name = :P1 /* {{$_POST.vendor_name}} */, vendor_address = :P2 /* {{$_POST.vendor_address}} */, vendor_phone_number = :P3 /* {{$_POST.vendor_phone_number}} */, vendor_id = :P4 /* {{$_POST.vendor_id}} */\nWHERE vendor_id = :P5 /* {{$_POST.vendor_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.vendor_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.vendor_address}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.vendor_phone_number}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.vendor_id}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P5",
              "value": "{{$_POST.vendor_id}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ],
      "output": true
    }
  }
}
JSON
);
?>