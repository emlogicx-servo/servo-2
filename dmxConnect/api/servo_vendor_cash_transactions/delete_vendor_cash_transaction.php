<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "vendor_transaction_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "delete_po_transaction",
      "module": "dbupdater",
      "action": "delete",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "delete",
          "table": "servo_vendor_cash_transaction",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "vendor_transaction_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.vendor_transaction_id}}",
                "data": {
                  "column": "vendor_transaction_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "vendor_transaction_id",
          "query": "delete from `servo_vendor_cash_transaction` where `vendor_transaction_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_POST.vendor_transaction_id}}",
              "test": ""
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