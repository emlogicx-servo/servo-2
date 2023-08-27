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
      },
      {
        "type": "text",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "wallet_id"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "wallet_privilege_deposit"
      },
      {
        "type": "text",
        "name": "wallet_privilege_transfer"
      },
      {
        "type": "text",
        "name": "wallet_privilege_payout"
      },
      {
        "type": "number",
        "name": "wallet_privilege_id"
      },
      {
        "type": "text",
        "name": "wallet_privilege_transfer_to"
      },
      {
        "type": "text",
        "name": "wallet_privilege_approve"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_wallet_privilege",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_deposit",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_deposit}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_transfer",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_transfer}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_payout",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_payout}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_transfer_to",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_transfer_to}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_approve",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_approve}}"
            },
            {
              "table": "servo_wallet_privileges",
              "column": "wallet_privilege_receive",
              "type": "text",
              "value": "{{$_POST.wallet_privilege_receive}}"
            }
          ],
          "table": "servo_wallet_privileges",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "wallet_privilege_id",
                "field": "wallet_privilege_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.wallet_privilege_id}}",
                "data": {
                  "column": "wallet_privilege_id"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "returning": "wallet_privilege_id",
          "query": "update `servo_wallet_privileges` set `wallet_privilege_deposit` = ?, `wallet_privilege_transfer` = ?, `wallet_privilege_payout` = ?, `wallet_privilege_transfer_to` = ?, `wallet_privilege_approve` = ?, `wallet_privilege_receive` = ? where `wallet_privilege_id` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_deposit}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_transfer}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_payout}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_transfer_to}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_approve}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.wallet_privilege_receive}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P7",
              "value": "{{$_POST.wallet_privilege_id}}",
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