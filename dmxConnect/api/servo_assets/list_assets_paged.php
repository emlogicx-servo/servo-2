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
        "name": "customerfname"
      },
      {
        "type": "text",
        "name": "customerlname"
      },
      {
        "type": "text",
        "name": "assetpermitnumber"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_assets_paged",
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
            },
            {
              "table": "servo_customers",
              "column": "customer_first_name"
            },
            {
              "table": "servo_customers",
              "column": "customer_last_name"
            },
            {
              "table": "servo_customers",
              "column": "id_card_number"
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
            },
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
                    "operation": "=",
                    "value": {
                      "table": "servo_assets",
                      "column": "asset_id"
                    }
                  }
                ]
              },
              "primary": "asset_info_special_id"
            }
          ],
          "query": "select `servo_assets`.`asset_id`, `servo_assets`.`asset_name`, `servo_assets`.`asset_lat`, `servo_assets`.`asset_long`, `servo_assets`.`date_created`, `servo_assets`.`asset_owner`, `servo_assets`.`user_created`, `servo_user`.`user_id`, `servo_user`.`user_fname`, `servo_user`.`user_lname`, `servo_user`.`user_username`, `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_customers`.`id_card_number` from `servo_assets` left join `servo_user` on `servo_user`.`user_id` = `servo_assets`.`user_created` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_assets`.`asset_owner` left join `servo_asset_special_fields_municipality` on `servo_asset_special_fields_municipality`.`asset` = `servo_assets`.`asset_id` limit ?",
          "params": [],
          "orders": [],
          "limitTest": "100"
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
            },
            {
              "type": "text",
              "name": "customer_first_name"
            },
            {
              "type": "text",
              "name": "customer_last_name"
            },
            {
              "type": "text",
              "name": "id_card_number"
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