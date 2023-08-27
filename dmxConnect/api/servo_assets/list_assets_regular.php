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
        "name": "assetpermitnumber"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "list_assets_regular",
      "module": "dbconnector",
      "action": "select",
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
              "table": "servo_asset_special_fields_municipality",
              "column": "project_alert_status"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "title_deed_number"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "permit_number"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_doeuvre"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "construction_type"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "district"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighborhood"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_purpose"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "payment_status"
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
                    "value": {
                      "table": "servo_assets",
                      "column": "asset_id"
                    },
                    "operation": "="
                  }
                ]
              },
              "primary": "asset_info_special_id"
            }
          ],
          "query": "SELECT servo_assets.asset_id, servo_assets.asset_name, servo_assets.asset_lat, servo_assets.asset_long, servo_assets.date_created, servo_assets.asset_owner, servo_assets.user_created, servo_user.user_id, servo_user.user_fname, servo_user.user_lname, servo_user.user_username, servo_asset_special_fields_municipality.project_alert_status, servo_asset_special_fields_municipality.title_deed_number, servo_asset_special_fields_municipality.permit_number, servo_asset_special_fields_municipality.maitre_doeuvre, servo_asset_special_fields_municipality.construction_type, servo_asset_special_fields_municipality.district, servo_asset_special_fields_municipality.neighborhood, servo_asset_special_fields_municipality.project_purpose, servo_asset_special_fields_municipality.payment_status, servo_customers.customer_first_name, servo_customers.customer_last_name, servo_customers.id_card_number\nFROM servo_assets\nLEFT JOIN servo_user ON (servo_user.user_id = servo_assets.user_created) LEFT JOIN servo_customers ON (servo_customers.customer_id = servo_assets.asset_owner) LEFT JOIN servo_asset_special_fields_municipality ON (servo_asset_special_fields_municipality.asset = servo_assets.asset_id)\nWHERE servo_customers.customer_first_name LIKE :P1 /* {{$_GET.customerfname}} */ AND servo_customers.customer_last_name LIKE :P2 /* {{$_GET.customerlname}} */ AND servo_asset_special_fields_municipality.permit_number LIKE :P3 /* {{$_GET.assetpermitnumber}} */",
          "params": [
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customerfname}}"
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P2",
              "value": "{{$_GET.customerlname}}"
            },
            {
              "operator": "contains",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_GET.assetpermitnumber}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customers.customer_first_name",
                "field": "servo_customers.customer_first_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.customerfname}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_first_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "name": "customer_first_name"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_customers.customer_last_name",
                "field": "servo_customers.customer_last_name",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.customerlname}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_last_name",
                  "type": "text",
                  "columnObj": {
                    "type": "text",
                    "name": "customer_last_name"
                  }
                },
                "operation": "LIKE"
              },
              {
                "id": "servo_asset_special_fields_municipality.permit_number",
                "field": "servo_asset_special_fields_municipality.permit_number",
                "type": "string",
                "operator": "contains",
                "value": "{{$_GET.assetpermitnumber}}",
                "data": {
                  "table": "servo_asset_special_fields_municipality",
                  "column": "permit_number",
                  "type": "text",
                  "columnObj": {
                    "type": "string",
                    "nullable": true,
                    "name": "permit_number"
                  }
                },
                "operation": "LIKE"
              }
            ],
            "conditional": null,
            "valid": true
          },
          "orders": []
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
          "name": "project_alert_status"
        },
        {
          "type": "text",
          "name": "title_deed_number"
        },
        {
          "type": "text",
          "name": "permit_number"
        },
        {
          "type": "text",
          "name": "maitre_doeuvre"
        },
        {
          "type": "text",
          "name": "construction_type"
        },
        {
          "type": "text",
          "name": "district"
        },
        {
          "type": "text",
          "name": "neighborhood"
        },
        {
          "type": "text",
          "name": "project_purpose"
        },
        {
          "type": "text",
          "name": "payment_status"
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
          "type": "number",
          "name": "id_card_number"
        }
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>