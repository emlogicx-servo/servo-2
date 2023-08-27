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
        "name": "customer_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_customer_files",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_files",
              "column": "file_id"
            },
            {
              "table": "servo_files",
              "column": "file_customer_id"
            },
            {
              "table": "servo_files",
              "column": "file_asset_id"
            },
            {
              "table": "servo_files",
              "column": "file_order_id"
            },
            {
              "table": "servo_files",
              "column": "file_transaction_id"
            },
            {
              "table": "servo_files",
              "column": "file_name"
            },
            {
              "table": "servo_files",
              "column": "file_user_created"
            },
            {
              "table": "servo_files",
              "column": "file_date_created"
            },
            {
              "table": "servo_files",
              "column": "file_description"
            },
            {
              "table": "servo_user",
              "column": "user_fname"
            },
            {
              "table": "servo_user",
              "column": "user_lname"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "table": {
            "name": "servo_files"
          },
          "primary": "file_id",
          "joins": [
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
                      "table": "servo_files",
                      "column": "file_user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_files.file_id, servo_files.file_customer_id, servo_files.file_asset_id, servo_files.file_order_id, servo_files.file_transaction_id, servo_files.file_name, servo_files.file_user_created, servo_files.file_date_created, servo_files.file_description, servo_user.user_fname, servo_user.user_lname, servo_user.user_username\nFROM servo_files\nLEFT JOIN servo_user ON (servo_user.user_id = servo_files.file_user_created)\nWHERE servo_files.file_customer_id = :P1 /* {{$_GET.customer_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_files.file_customer_id",
                "field": "servo_files.file_customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_id}}",
                "data": {
                  "table": "servo_files",
                  "column": "file_customer_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "nullable": true,
                    "name": "file_customer_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          }
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "file_id"
        },
        {
          "type": "number",
          "name": "file_customer_id"
        },
        {
          "type": "number",
          "name": "file_asset_id"
        },
        {
          "type": "number",
          "name": "file_order_id"
        },
        {
          "type": "number",
          "name": "file_transaction_id"
        },
        {
          "type": "text",
          "name": "file_name"
        },
        {
          "type": "number",
          "name": "file_user_created"
        },
        {
          "type": "datetime",
          "name": "file_date_created"
        },
        {
          "type": "text",
          "name": "file_description"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>