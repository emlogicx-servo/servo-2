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
        "name": "customer"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_customer_assets_paged",
      "module": "dbconnector",
      "action": "paged",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_assets",
              "column": "asset_id"
            },
            {
              "table": "servo_assets",
              "column": "asset_name"
            },
            {
              "table": "servo_assets",
              "column": "asset_lat"
            },
            {
              "table": "servo_assets",
              "column": "asset_long"
            },
            {
              "table": "servo_assets",
              "column": "date_created"
            },
            {
              "table": "servo_assets",
              "column": "asset_owner"
            },
            {
              "table": "servo_assets",
              "column": "user_created"
            },
            {
              "table": "servo_user",
              "column": "user_id"
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
            "name": "servo_assets"
          },
          "primary": "asset_id",
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
                      "table": "servo_assets",
                      "column": "user_created"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "user_id"
            }
          ],
          "query": "SELECT servo_assets.asset_id, servo_assets.asset_name, servo_assets.asset_lat, servo_assets.asset_long, servo_assets.date_created, servo_assets.asset_owner, servo_assets.user_created, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username\nFROM servo_assets\nLEFT JOIN servo_user ON (servo_user.user_id = servo_assets.user_created)\nWHERE servo_assets.asset_owner = :P1 /* {{$_GET.customer}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_assets.asset_owner",
                "field": "servo_assets.asset_owner",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer}}",
                "data": {
                  "table": "servo_assets",
                  "column": "asset_owner",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "nullable": true,
                    "name": "asset_owner"
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
              "name": "asset_id"
            },
            {
              "type": "text",
              "name": "asset_name"
            },
            {
              "type": "text",
              "name": "asset_lat"
            },
            {
              "type": "text",
              "name": "asset_long"
            },
            {
              "type": "datetime",
              "name": "date_created"
            },
            {
              "type": "number",
              "name": "asset_owner"
            },
            {
              "type": "number",
              "name": "user_created"
            },
            {
              "type": "number",
              "name": "user_id"
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
          ]
        }
      ],
      "outputType": "object",
      "type": "dbconnector_paged_select"
    }
  }
}
JSON
);
?>