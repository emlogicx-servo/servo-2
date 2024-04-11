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
        "type": "number",
        "name": "combined_surface_area"
      },
      {
        "type": "text",
        "name": "neighborhood_local_name"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_customer_asset_muicipality_plaque",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "permit_number",
              "type": "text",
              "value": "{{$_POST.permit_number.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_doeuvre",
              "type": "text",
              "value": "{{$_POST.maitre_doeuvre.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_douvrage",
              "type": "text",
              "value": "{{$_POST.maitre_douvrage.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "construction_type",
              "type": "text",
              "value": "{{$_POST.construction_type.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "district",
              "type": "number",
              "value": "{{$_POST.district.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighborhood",
              "type": "number",
              "value": "{{$_POST.neighborhood.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "street_name",
              "type": "number",
              "value": "{{$_POST.street_name.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_purpose",
              "type": "number",
              "value": "{{$_POST.project_purpose.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_id",
              "type": "text",
              "value": "{{$_POST.project_id.default(null)}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "combined_surface_area",
              "type": "number",
              "value": "{{$_POST.combined_surface_area.default(null)}}"
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
          "query": "update `servo_asset_special_fields_municipality` set `permit_number` = ?, `maitre_doeuvre` = ?, `maitre_douvrage` = ?, `construction_type` = ?, `district` = ?, `neighborhood` = ?, `street_name` = ?, `project_purpose` = ?, `project_id` = ?, `combined_surface_area` = ?, `neighborhood_local_name` = ? where `asset` = ?",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.permit_number.default(null)}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.maitre_doeuvre.default(null)}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.maitre_douvrage.default(null)}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.construction_type.default(null)}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.district.default(null)}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.neighborhood.default(null)}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.street_name.default(null)}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.project_purpose.default(null)}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.project_id.default(null)}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.combined_surface_area.default(null)}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.neighborhood_local_name}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P12",
              "value": "{{$_POST.asset}}"
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
      ],
      "output": true
    }
  }
}
JSON
);
?>