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
      "name": "query_read_customer_asset_municipality_plaque",
      "module": "dbconnector",
      "action": "single",
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
              "table": "servo_asset_special_fields_municipality",
              "column": "permit_number"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_doeuvre"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_douvrage"
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
              "column": "payment_status"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "street_name"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_purpose"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_id"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "asset"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "combined_surface_area"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighborhood_local_name"
            }
          ],
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
          "query": "select `servo_assets`.`asset_id`, `servo_asset_special_fields_municipality`.`permit_number`, `servo_asset_special_fields_municipality`.`maitre_doeuvre`, `servo_asset_special_fields_municipality`.`maitre_douvrage`, `servo_asset_special_fields_municipality`.`construction_type`, `servo_asset_special_fields_municipality`.`district`, `servo_asset_special_fields_municipality`.`neighborhood`, `servo_asset_special_fields_municipality`.`payment_status`, `servo_asset_special_fields_municipality`.`street_name`, `servo_asset_special_fields_municipality`.`project_purpose`, `servo_asset_special_fields_municipality`.`project_id`, `servo_asset_special_fields_municipality`.`asset`, `servo_asset_special_fields_municipality`.`combined_surface_area`, `servo_asset_special_fields_municipality`.`neighborhood_local_name` from `servo_assets` left join `servo_asset_special_fields_municipality` on `servo_asset_special_fields_municipality`.`asset` = `servo_assets`.`asset_id` where `servo_assets`.`asset_id` = ?",
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
          "name": "permit_number"
        },
        {
          "type": "text",
          "name": "maitre_doeuvre"
        },
        {
          "type": "text",
          "name": "maitre_douvrage"
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
          "name": "payment_status"
        },
        {
          "type": "text",
          "name": "street_name"
        },
        {
          "type": "text",
          "name": "project_purpose"
        },
        {
          "type": "text",
          "name": "project_id"
        },
        {
          "type": "number",
          "name": "asset"
        },
        {
          "type": "number",
          "name": "combined_surface_area"
        },
        {
          "type": "text",
          "name": "neighborhood_local_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>