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
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "wallet_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_wallet_transactions_paged",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_id"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_amount"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_type"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_initiated_id"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_date"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_payment_method"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_status"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_note"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_balance"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_amount_tendered"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_received"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_department_received"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_originating_wallet"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_destination_wallet"
            },
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_user_approved"
            },
            {
              "table": "servo_payment_methods",
              "column": "payment_method_name"
            },
            {
              "table": "user_initiated",
              "column": "user_username",
              "alias": "user_initiated_username"
            },
            {
              "table": "user_approved",
              "column": "user_username",
              "alias": "user_approved_username"
            },
            {
              "table": "user_received",
              "column": "user_username",
              "alias": "user_received_username"
            },
            {
              "table": "originating_wallet",
              "column": "wallet_name",
              "alias": "originating_wallet_name"
            },
            {
              "table": "destination_wallet",
              "column": "wallet_name",
              "alias": "destination_wallet_name"
            },
            {
              "table": "destination_wallet",
              "column": "wallet_id",
              "alias": "destination_wallet_id"
            },
            {
              "table": "originating_wallet",
              "column": "wallet_id",
              "alias": "originating_wallet_id"
            }
          ],
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.wallet_id}}",
              "test": ""
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.wallet_id}}",
              "test": ""
            }
          ],
          "table": {
            "name": "servo_wallet_transactions"
          },
          "primary": "transaction_id",
          "joins": [
            {
              "table": "servo_user",
              "column": "*",
              "alias": "user_initiated",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "user_initiated",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_user_initiated_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "alias": "user_approved",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "user_approved",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_user_approved"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
            {
              "table": "servo_user",
              "column": "*",
              "alias": "user_received",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "user_received",
                    "column": "user_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_user_received"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            },
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
                      "table": "servo_wallet_transactions",
                      "column": "transaction_payment_method"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "payment_method_id"
            },
            {
              "table": "servo_wallets",
              "column": "*",
              "alias": "originating_wallet",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "originating_wallet",
                    "column": "wallet_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_originating_wallet"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "wallet_id"
            },
            {
              "table": "servo_wallets",
              "column": "*",
              "alias": "destination_wallet",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "destination_wallet",
                    "column": "wallet_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_destination_wallet"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "wallet_id"
            }
          ],
          "query": "SELECT servo_wallet_transactions.transaction_id, servo_wallet_transactions.transaction_amount, servo_wallet_transactions.transaction_type, servo_wallet_transactions.transaction_user_initiated_id, servo_wallet_transactions.transaction_date, servo_wallet_transactions.transaction_payment_method, servo_wallet_transactions.transaction_status, servo_wallet_transactions.transaction_note, servo_wallet_transactions.transaction_balance, servo_wallet_transactions.transaction_amount_tendered, servo_wallet_transactions.transaction_user_received, servo_wallet_transactions.transaction_department_received, servo_wallet_transactions.transaction_originating_wallet, servo_wallet_transactions.transaction_destination_wallet, servo_wallet_transactions.transaction_user_approved, servo_payment_methods.payment_method_name, user_initiated.user_username AS user_initiated_username, user_approved.user_username AS user_approved_username, user_received.user_username AS user_received_username, originating_wallet.wallet_name AS originating_wallet_name, destination_wallet.wallet_name AS destination_wallet_name, destination_wallet.wallet_id AS destination_wallet_id, originating_wallet.wallet_id AS originating_wallet_id\nFROM servo_wallet_transactions\nLEFT JOIN servo_user AS user_initiated ON user_initiated.user_id = servo_wallet_transactions.transaction_user_initiated_id LEFT JOIN servo_user AS user_approved ON user_approved.user_id = servo_wallet_transactions.transaction_user_approved LEFT JOIN servo_user AS user_received ON user_received.user_id = servo_wallet_transactions.transaction_user_received LEFT JOIN servo_payment_methods ON servo_payment_methods.payment_method_id = servo_wallet_transactions.transaction_payment_method LEFT JOIN servo_wallets AS originating_wallet ON originating_wallet.wallet_id = servo_wallet_transactions.transaction_originating_wallet LEFT JOIN servo_wallets AS destination_wallet ON destination_wallet.wallet_id = servo_wallet_transactions.transaction_destination_wallet\nWHERE (servo_wallet_transactions.transaction_destination_wallet = :P1 /* {{$_GET.wallet_id}} */ OR servo_wallet_transactions.transaction_originating_wallet = :P2 /* {{$_GET.wallet_id}} */) AND servo_wallet_transactions.delete_status = 'active'\nORDER BY servo_wallet_transactions.transaction_id DESC",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "condition": "OR",
                "rules": [
                  {
                    "id": "servo_wallet_transactions.transaction_destination_wallet",
                    "field": "servo_wallet_transactions.transaction_destination_wallet",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.wallet_id}}",
                    "data": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_destination_wallet",
                      "type": "number",
                      "columnObj": {
                        "type": "reference",
                        "primary": false,
                        "nullable": true,
                        "references": "wallet_id",
                        "inTable": "servo_wallets",
                        "referenceType": "integer",
                        "onUpdate": "RESTRICT",
                        "onDelete": "RESTRICT",
                        "name": "transaction_destination_wallet"
                      }
                    },
                    "operation": "="
                  },
                  {
                    "id": "servo_wallet_transactions.transaction_originating_wallet",
                    "field": "servo_wallet_transactions.transaction_originating_wallet",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{$_GET.wallet_id}}",
                    "data": {
                      "table": "servo_wallet_transactions",
                      "column": "transaction_originating_wallet",
                      "type": "number",
                      "columnObj": {
                        "type": "reference",
                        "primary": false,
                        "nullable": true,
                        "references": "wallet_id",
                        "inTable": "servo_wallets",
                        "referenceType": "integer",
                        "onUpdate": "RESTRICT",
                        "onDelete": "RESTRICT",
                        "name": "transaction_originating_wallet"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": null
              },
              {
                "condition": "AND",
                "rules": [
                  {
                    "id": "servo_wallet_transactions.delete_status",
                    "field": "servo_wallet_transactions.delete_status",
                    "type": "string",
                    "operator": "equal",
                    "value": "active",
                    "data": {
                      "table": "servo_wallet_transactions",
                      "column": "delete_status",
                      "type": "text",
                      "columnObj": {
                        "type": "text",
                        "maxLength": 65535,
                        "primary": false,
                        "nullable": true,
                        "name": "delete_status"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": null
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": [
            {
              "table": "servo_wallet_transactions",
              "column": "transaction_id",
              "direction": "DESC",
              "recid": 1
            }
          ]
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
              "name": "transaction_id"
            },
            {
              "type": "number",
              "name": "transaction_amount"
            },
            {
              "type": "text",
              "name": "transaction_type"
            },
            {
              "type": "number",
              "name": "transaction_user_initiated_id"
            },
            {
              "type": "datetime",
              "name": "transaction_date"
            },
            {
              "type": "number",
              "name": "transaction_payment_method"
            },
            {
              "type": "text",
              "name": "transaction_status"
            },
            {
              "type": "text",
              "name": "transaction_note"
            },
            {
              "type": "number",
              "name": "transaction_balance"
            },
            {
              "type": "number",
              "name": "transaction_amount_tendered"
            },
            {
              "type": "number",
              "name": "transaction_user_received"
            },
            {
              "type": "number",
              "name": "transaction_department_received"
            },
            {
              "type": "number",
              "name": "transaction_originating_wallet"
            },
            {
              "type": "number",
              "name": "transaction_destination_wallet"
            },
            {
              "type": "number",
              "name": "transaction_user_approved"
            },
            {
              "type": "text",
              "name": "payment_method_name"
            },
            {
              "type": "text",
              "name": "user_initiated_username"
            },
            {
              "type": "text",
              "name": "user_approved_username"
            },
            {
              "type": "text",
              "name": "user_received_username"
            },
            {
              "type": "text",
              "name": "originating_wallet_name"
            },
            {
              "type": "text",
              "name": "destination_wallet_name"
            },
            {
              "type": "number",
              "name": "destination_wallet_id"
            },
            {
              "type": "number",
              "name": "originating_wallet_id"
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