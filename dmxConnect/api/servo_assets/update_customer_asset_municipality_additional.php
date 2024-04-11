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
      }
    ],
    "$_POST": [
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
        "type": "number",
        "name": "asset_id"
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
        "type": "number",
        "name": "district"
      },
      {
        "type": "number",
        "name": "neighborhood"
      },
      {
        "type": "number",
        "name": "street_name"
      },
      {
        "type": "number",
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
        "type": "text",
        "name": "neighborhood_local_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_customer_asset_muicipality_technical",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "payment_status",
              "type": "text",
              "value": "{{$_POST.payment_status.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_status",
              "type": "text",
              "value": "{{$_POST.project_status.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_alert_status",
              "type": "text",
              "value": "{{$_POST.project_alert_status.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "title_deed_number",
              "type": "text",
              "value": "{{$_POST.title_deed_number.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "plot_number",
              "type": "text",
              "value": "{{$_POST.plot_number.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "block_number",
              "type": "text",
              "value": "{{$_POST.block_number.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "surface_area",
              "type": "number",
              "value": "{{$_POST.surface_area.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "commentaire_sur_decallage",
              "type": "text",
              "value": "{{$_POST.commentaire_sur_decallage.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "secteur_operationel",
              "type": "text",
              "value": "{{$_POST.secteur_operationel.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "servitude_publique",
              "type": "text",
              "value": "{{$_POST.servitude_publique.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "servitude_privee",
              "type": "text",
              "value": "{{$_POST.servitude_privee.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_entitlement",
              "type": "number",
              "value": "{{$_POST.project_entitlement.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "emprise_du_sol",
              "type": "number",
              "value": "{{$_POST.emprise_du_sol.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "cumul_de_plancees",
              "type": "number",
              "value": "{{$_POST.cumul_de_plancees.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "observations",
              "type": "text",
              "value": "{{$_POST.observations.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighborhood_local_name",
              "type": "text",
              "value": "{{$_POST.neighborhood_local_name}}"
            }
          ],
          "table": "servo_asset_special_fields_municipality",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "asset",
                "field": "asset",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.asset}}",
                "data": {
                  "column": "asset"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "update `servo_asset_special_fields_municipality` set `payment_status` = ?, `project_status` = ?, `project_alert_status` = ?, `title_deed_number` = ?, `plot_number` = ?, `block_number` = ?, `surface_area` = ?, `commentaire_sur_decallage` = ?, `secteur_operationel` = ?, `servitude_publique` = ?, `servitude_privee` = ?, `project_entitlement` = ?, `emprise_du_sol` = ?, `cumul_de_plancees` = ?, `observations` = ?, `neighborhood_local_name` = ? where `asset` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.payment_status.default(null)}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.project_status.default(null)}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.project_alert_status.default(null)}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.title_deed_number.default(null)}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.plot_number.default(null)}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.block_number.default(null)}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.surface_area.default(null)}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.commentaire_sur_decallage.default(null)}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.secteur_operationel.default(null)}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.servitude_publique.default(null)}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.servitude_privee.default(null)}}"
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.project_entitlement.default(null)}}"
            },
            {
              "name": ":P13",
              "type": "expression",
              "value": "{{$_POST.emprise_du_sol.default(null)}}"
            },
            {
              "name": ":P14",
              "type": "expression",
              "value": "{{$_POST.cumul_de_plancees.default(null)}}"
            },
            {
              "name": ":P15",
              "type": "expression",
              "value": "{{$_POST.observations.default(null)}}"
            },
            {
              "name": ":P16",
              "type": "expression",
              "value": "{{$_POST.neighborhood_local_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P17",
              "value": "{{$_POST.asset}}",
              "test": ""
            }
          ],
          "returning": "asset_info_special_id"
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>