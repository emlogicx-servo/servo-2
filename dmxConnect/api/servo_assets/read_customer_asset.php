<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "asset_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_customer_asset",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_assets"
          },
          "primary": "asset_id",
          "joins": [
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_asset_special_fields_municipality",
                    "column": "asset",
                    "operator": "equal",
                    "value": {
                      "table": "servo_assets",
                      "column": "asset_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "asset_info_special_id"
            },
            {
              "table": "servo_customers",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customers",
                    "column": "customer_id",
                    "operator": "equal",
                    "value": {
                      "table": "servo_assets",
                      "column": "asset_owner"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "customer_id"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_assets.asset_id",
                "field": "servo_assets.asset_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.asset_id}}",
                "data": {
                  "table": "servo_assets",
                  "column": "asset_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "primary": true,
                    "name": "asset_id"
                  }
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "select * from `servo_assets` left join `servo_asset_special_fields_municipality` on `servo_asset_special_fields_municipality`.`asset` = `servo_assets`.`asset_id` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_assets`.`asset_owner` where `servo_assets`.`asset_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.asset_id}}"
            }
          ]
        }
      },
      "output": true,
      "meta": [
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
          "type": "number",
          "name": "asset_owner"
        },
        {
          "type": "datetime",
          "name": "date_created"
        },
        {
          "type": "number",
          "name": "user_created"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>