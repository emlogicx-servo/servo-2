<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "transaction_id"
      }
    ],
    "$_POST": [
      {
        "type": "number",
        "name": "vendor_transaction_id"
      },
      {
        "type": "text",
        "name": "transaction_note"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_vendor_cash_transaction_note",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_vendor_cash_transaction",
              "column": "vendor_transaction_id",
              "type": "number",
              "value": "{{$_POST.vendor_transaction_id}}"
            },
            {
              "table": "servo_vendor_cash_transaction",
              "column": "transaction_note",
              "type": "text",
              "value": "{{$_POST.transaction_note.default(null)}}"
            }
          ],
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
          "query": "update `servo_vendor_cash_transaction` set `vendor_transaction_id` = ?, `transaction_note` = ? where `vendor_transaction_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.vendor_transaction_id}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.transaction_note.default(null)}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
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
      ]
    }
  }
}
JSON
);
?>