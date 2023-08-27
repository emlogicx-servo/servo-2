<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "wallet_id"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "wallet_name"
      },
      {
        "type": "text",
        "name": "wallet_type"
      },
      {
        "type": "text",
        "name": "wallet_description"
      },
      {
        "type": "number",
        "name": "wallet_currency"
      },
      {
        "type": "number",
        "name": "wallet_format"
      },
      {
        "type": "number",
        "name": "wallet_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_wallet",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_wallets",
              "column": "wallet_name",
              "type": "text",
              "value": "{{$_POST.wallet_name}}"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_type",
              "type": "text",
              "value": "{{$_POST.wallet_type}}"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_description",
              "type": "text",
              "value": "{{$_POST.wallet_description}}"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_currency",
              "type": "number",
              "value": "{{$_POST.wallet_currency}}"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_format",
              "type": "number",
              "value": "{{$_POST.wallet_format}}"
            }
          ],
          "table": "servo_wallets",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "wallet_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.wallet_id}}",
                "data": {
                  "column": "wallet_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "wallet_id",
          "query": "UPDATE servo_wallets\nSET wallet_name = :P1 /* {{$_POST.wallet_name}} */, wallet_type = :P2 /* {{$_POST.wallet_type}} */, wallet_description = :P3 /* {{$_POST.wallet_description}} */, wallet_currency = :P4 /* {{$_POST.wallet_currency}} */, wallet_format = :P5 /* {{$_POST.wallet_format}} */\nWHERE wallet_id = :P6 /* {{$_POST.wallet_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.wallet_name}}",
              "test": ""
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.wallet_type}}",
              "test": ""
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.wallet_description}}",
              "test": ""
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.wallet_currency}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.wallet_format}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P6",
              "value": "{{$_POST.wallet_id}}",
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