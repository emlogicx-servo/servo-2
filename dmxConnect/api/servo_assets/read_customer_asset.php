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
          "query": "SELECT *\nFROM servo_assets\nLEFT JOIN servo_asset_special_fields_municipality ON (servo_asset_special_fields_municipality.asset = servo_assets.asset_id) LEFT JOIN servo_customers ON (servo_customers.customer_id = servo_assets.asset_owner)\nWHERE servo_assets.asset_id = :P1 /* {{$_GET.asset_id}} */",
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
        },
        {
          "type": "text",
          "name": "payment_status"
        },
        {
          "type": "text",
          "name": "project_status"
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
          "name": "plot_number"
        },
        {
          "type": "text",
          "name": "block_number"
        },
        {
          "type": "number",
          "name": "surface_area"
        },
        {
          "type": "text",
          "name": "commentaire_sur_decallage"
        },
        {
          "type": "text",
          "name": "secteur_operationel"
        },
        {
          "type": "text",
          "name": "servitude_publique"
        },
        {
          "type": "text",
          "name": "servitude_privee"
        },
        {
          "type": "number",
          "name": "project_entitlement"
        },
        {
          "type": "number",
          "name": "emprise_du_sol"
        },
        {
          "type": "number",
          "name": "cumul_de_plancees"
        },
        {
          "type": "text",
          "name": "observations"
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
          "name": "neighbordhood_local_name"
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
          "name": "asset_info_special_id"
        },
        {
          "type": "number",
          "name": "combined_surface_area"
        },
        {
          "type": "number",
          "name": "customer_id"
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
          "name": "customer_phone_number"
        },
        {
          "type": "text",
          "name": "customer_picture"
        },
        {
          "type": "text",
          "name": "customer_class"
        },
        {
          "type": "text",
          "name": "customer_sex"
        },
        {
          "type": "datetime",
          "name": "customer_dob"
        },
        {
          "type": "number",
          "name": "customer_age"
        },
        {
          "type": "text",
          "name": "customer_address"
        },
        {
          "type": "number",
          "name": "id_card_number"
        },
        {
          "type": "text",
          "name": "location_lat"
        },
        {
          "type": "text",
          "name": "locatio_lon"
        },
        {
          "type": "number",
          "name": "customer_city"
        },
        {
          "type": "text",
          "name": "customer_building_photo"
        },
        {
          "type": "text",
          "name": "customer_location_diretions"
        },
        {
          "type": "number",
          "name": "customer_nationality"
        },
        {
          "type": "text",
          "name": "customer_email"
        },
        {
          "type": "text",
          "name": "customer_legal_status"
        },
        {
          "type": "number",
          "name": "customer_tax_payer_number"
        },
        {
          "type": "text",
          "name": "customer_rep_name"
        },
        {
          "type": "text",
          "name": "customer_rep_surname"
        },
        {
          "type": "text",
          "name": "customer_rep_id_card"
        },
        {
          "type": "text",
          "name": "customer_rep_address"
        },
        {
          "type": "text",
          "name": "customer_rep_phone"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>