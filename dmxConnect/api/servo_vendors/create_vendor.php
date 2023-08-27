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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_vendor",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
            }
          ],
          "table": "servo_vendors",
          "returning": "vendor_id",
          "query": "INSERT INTO servo_vendors\n(vendor_name, vendor_address, vendor_phone_number) VALUES (:P1 /* {{$_POST.vendor_name}} */, :P2 /* {{$_POST.vendor_address}} */, :P3 /* {{$_POST.vendor_phone_number}} */)",
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