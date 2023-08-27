<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "vendor_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "read_vendor",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_vendors"
          },
          "primary": "vendor_id",
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_vendors.vendor_id",
                "field": "servo_vendors.vendor_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.vendor_id}}",
                "data": {
                  "table": "servo_vendors",
                  "column": "vendor_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "vendor_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_vendors\nWHERE vendor_id = :P1 /* {{$_GET.vendor_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.vendor_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "vendor_id"
        },
        {
          "type": "text",
          "name": "vendor_name"
        },
        {
          "type": "text",
          "name": "vendor_address"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>