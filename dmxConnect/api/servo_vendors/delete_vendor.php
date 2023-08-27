<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "vendor_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_vendor",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
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
          "query": "DELETE\nFROM servo_vendors\nWHERE vendor_id = :P1 /* {{$_POST.vendor_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
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
      ]
    }
  }
}
JSON
);
?>