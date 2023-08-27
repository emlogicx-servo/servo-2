<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_wallets_paged",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_wallets",
              "column": "wallet_id"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_name"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_type"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_description"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_creation_date"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_user_created"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_currency"
            },
            {
              "table": "servo_wallets",
              "column": "wallet_format"
            },
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name"
            },
            {
              "table": "servo_currencies",
              "column": "currency_name"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "params": [],
          "table": {
            "name": "servo_wallets"
          },
          "primary": "wallet_id",
          "joins": [
            {
              "table": "servo_payment_methods",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_payment_methods",
                    "column": "payment_method_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallets",
                      "column": "wallet_format"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            },
            {
              "table": "servo_currencies",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_currencies",
                    "column": "currency_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallets",
                      "column": "wallet_currency"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "currency_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_user",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallets",
                      "column": "wallet_user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "orders": [],
          "query": "SELECT servo_wallets.wallet_id, servo_wallets.wallet_name, servo_wallets.wallet_type, servo_wallets.wallet_description, servo_wallets.wallet_creation_date, servo_wallets.wallet_user_created, servo_wallets.wallet_currency, servo_wallets.wallet_format, servo_payment_methods.payment_method_name, servo_currencies.currency_name, servo_user.user_username\nFROM servo_wallets\nLEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_wallets.wallet_format LEFT JOIN servo_currencies ON servo_currencies.currency_id = servo_wallets.wallet_currency LEFT JOIN servo_user ON servo_user.user_id = servo_wallets.wallet_user_created"
        }
      },
      "output": true,
      "meta": [
        {
          "name": "offset",
          "type": "number"
        },
        {
          "name": "limit",
          "type": "number"
        },
        {
          "name": "total",
          "type": "number"
        },
        {
          "name": "page",
          "type": "object",
          "sub": [
            {
              "name": "offset",
              "type": "object",
              "sub": [
                {
                  "name": "first",
                  "type": "number"
                },
                {
                  "name": "prev",
                  "type": "number"
                },
                {
                  "name": "next",
                  "type": "number"
                },
                {
                  "name": "last",
                  "type": "number"
                }
              ]
            },
            {
              "name": "current",
              "type": "number"
            },
            {
              "name": "total",
              "type": "number"
            }
          ]
        },
        {
          "name": "data",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "wallet_id"
            },
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
            },
            {
              "type": "text",
              "name": "payment_method_name"
            },
            {
              "type": "text",
              "name": "currency_name"
            },
            {
              "type": "text",
              "name": "user_username"
            }
          ]
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>