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
        "name": "asset_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_asset_files",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_asset_files",
              "column": "asset_file_id"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_type"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_description"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_creator"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_date_created"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_status"
            },
            {
              "table": "servo_asset_files",
              "column": "asset_file_asset_id"
            },
            {
              "table": "servo_user",
              "column": "user_id"
            },
            {
              "table": "servo_user",
              "column": "user_username"
            }
          ],
          "table": {
            "name": "servo_asset_files"
          },
          "primary": "asset_file_id",
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
                      "table": "servo_asset_files",
                      "column": "asset_file_creator"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_asset_files.asset_file_id, servo_asset_files.asset_file, servo_asset_files.asset_file_type, servo_asset_files.asset_file_description, servo_asset_files.asset_file_creator, servo_asset_files.asset_file_date_created, servo_asset_files.asset_file_status, servo_asset_files.asset_file_asset_id, servo_user.user_id, servo_user.user_username\nFROM servo_asset_files\nLEFT JOIN servo_user ON (servo_user.user_id = servo_asset_files.asset_file_creator)\nWHERE servo_asset_files.asset_file_asset_id = :P1 /* {{$_GET.asset_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.asset_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_asset_files.asset_file_asset_id",
                "field": "servo_asset_files.asset_file_asset_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.asset_id}}",
                "data": {
                  "table": "servo_asset_files",
                  "column": "asset_file_asset_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "name": "asset_file_asset_id"
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
          "name": "asset_file_id"
        },
        {
          "type": "text",
          "name": "asset_file"
        },
        {
          "type": "text",
          "name": "asset_file_type"
        },
        {
          "type": "text",
          "name": "asset_file_description"
        },
        {
          "type": "number",
          "name": "asset_file_creator"
        },
        {
          "type": "datetime",
          "name": "asset_file_date_created"
        },
        {
          "type": "text",
          "name": "asset_file_status"
        },
        {
          "type": "number",
          "name": "asset_file_asset_id"
        },
        {
          "type": "number",
          "name": "user_id"
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