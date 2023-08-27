<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
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
        "type": "datetime",
        "name": "wallet_creation_date"
      },
      {
        "type": "number",
        "name": "wallet_user_created"
      },
      {
        "type": "number",
        "name": "wallet_currency"
      },
      {
        "type": "number",
        "name": "wallet_format"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_wallet",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
              "column": "wallet_creation_date",
              "type": "datetime",
              "value": "{{$_POST.wallet_creation_date}}"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_user_created",
              "type": "number",
              "value": "{{$_POST.wallet_user_created}}"
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
          "returning": "wallet_id",
          "query": "INSERT INTO servo_wallets\n(wallet_name, wallet_type, wallet_description, wallet_creation_date, wallet_user_created, wallet_currency, wallet_format) VALUES (:P1 /* {{$_POST.wallet_name}} */, :P2 /* {{$_POST.wallet_type}} */, :P3 /* {{$_POST.wallet_description}} */, :P4 /* {{$_POST.wallet_creation_date}} */, :P5 /* {{$_POST.wallet_user_created}} */, :P6 /* {{$_POST.wallet_currency}} */, :P7 /* {{$_POST.wallet_format}} */)",
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
              "value": "{{$_POST.wallet_creation_date}}",
              "test": ""
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.wallet_user_created}}",
              "test": ""
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.wallet_currency}}",
              "test": ""
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.wallet_format}}",
              "test": ""
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