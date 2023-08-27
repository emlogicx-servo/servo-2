<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "asset_name"
      },
      {
        "type": "number",
        "name": "asset_lat"
      },
      {
        "type": "number",
        "name": "asset_long"
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
        "name": "neighbordhood_local_name"
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
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_asset_additonal",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
          "values": [
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "payment_status",
              "type": "text",
              "value": "{{$_POST.payment_status}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_status",
              "type": "text",
              "value": "{{$_POST.project_status}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_alert_status",
              "type": "text",
              "value": "{{$_POST.project_alert_status}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "title_deed_number",
              "type": "text",
              "value": "{{$_POST.title_deed_number}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "plot_number",
              "type": "text",
              "value": "{{$_POST.plot_number}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "block_number",
              "type": "text",
              "value": "{{$_POST.block_number}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "surface_area",
              "type": "number",
              "value": "{{$_POST.surface_area}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "commentaire_sur_decallage",
              "type": "text",
              "value": "{{$_POST.commentaire_sur_decallage}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "secteur_operationel",
              "type": "text",
              "value": "{{$_POST.secteur_operationel}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "servitude_publique",
              "type": "text",
              "value": "{{$_POST.servitude_publique}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "servitude_privee",
              "type": "text",
              "value": "{{$_POST.servitude_privee}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_entitlement",
              "type": "number",
              "value": "{{$_POST.project_entitlement}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "emprise_du_sol",
              "type": "number",
              "value": "{{$_POST.emprise_du_sol}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "cumul_de_plancees",
              "type": "number",
              "value": "{{$_POST.cumul_de_plancees}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "observations",
              "type": "text",
              "value": "{{$_POST.observations}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "permit_number",
              "type": "text",
              "value": "{{$_POST.permit_number}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_doeuvre",
              "type": "text",
              "value": "{{$_POST.maitre_doeuvre}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "maitre_douvrage",
              "type": "text",
              "value": "{{$_POST.maitre_douvrage}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "construction_type",
              "type": "text",
              "value": "{{$_POST.construction_type}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "district",
              "type": "number",
              "value": "{{$_POST.district}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighborhood",
              "type": "number",
              "value": "{{$_POST.neighborhood}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "neighbordhood_local_name",
              "type": "number",
              "value": "{{$_POST.neighbordhood_local_name}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "street_name",
              "type": "number",
              "value": "{{$_POST.street_name}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_purpose",
              "type": "number",
              "value": "{{$_POST.project_purpose}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "project_id",
              "type": "text",
              "value": "{{$_POST.project_id}}"
            },
            {
              "table": "servo_asset_special_fields_municipality",
              "column": "asset",
              "type": "number",
              "value": "{{$_POST.asset}}"
            }
          ],
          "table": "servo_asset_special_fields_municipality",
          "query": "INSERT INTO servo_asset_special_fields_municipality\n(payment_status, project_status, project_alert_status, title_deed_number, plot_number, block_number, surface_area, commentaire_sur_decallage, secteur_operationel, servitude_publique, servitude_privee, project_entitlement, emprise_du_sol, cumul_de_plancees, observations, permit_number, maitre_doeuvre, maitre_douvrage, construction_type, district, neighborhood, neighbordhood_local_name, street_name, project_purpose, project_id, asset) VALUES (:P1 /* {{$_POST.payment_status}} */, :P2 /* {{$_POST.project_status}} */, :P3 /* {{$_POST.project_alert_status}} */, :P4 /* {{$_POST.title_deed_number}} */, :P5 /* {{$_POST.plot_number}} */, :P6 /* {{$_POST.block_number}} */, :P7 /* {{$_POST.surface_area}} */, :P8 /* {{$_POST.commentaire_sur_decallage}} */, :P9 /* {{$_POST.secteur_operationel}} */, :P10 /* {{$_POST.servitude_publique}} */, :P11 /* {{$_POST.servitude_privee}} */, :P12 /* {{$_POST.project_entitlement}} */, :P13 /* {{$_POST.emprise_du_sol}} */, :P14 /* {{$_POST.cumul_de_plancees}} */, :P15 /* {{$_POST.observations}} */, :P16 /* {{$_POST.permit_number}} */, :P17 /* {{$_POST.maitre_doeuvre}} */, :P18 /* {{$_POST.maitre_douvrage}} */, :P19 /* {{$_POST.construction_type}} */, :P20 /* {{$_POST.district}} */, :P21 /* {{$_POST.neighborhood}} */, :P22 /* {{$_POST.neighbordhood_local_name}} */, :P23 /* {{$_POST.street_name}} */, :P24 /* {{$_POST.project_purpose}} */, :P25 /* {{$_POST.project_id}} */, :P26 /* {{$_POST.asset}} */)",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.payment_status}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.project_status}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.project_alert_status}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.title_deed_number}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.plot_number}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.block_number}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.surface_area}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.commentaire_sur_decallage}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.secteur_operationel}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.servitude_publique}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.servitude_privee}}"
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.project_entitlement}}"
            },
            {
              "name": ":P13",
              "type": "expression",
              "value": "{{$_POST.emprise_du_sol}}"
            },
            {
              "name": ":P14",
              "type": "expression",
              "value": "{{$_POST.cumul_de_plancees}}"
            },
            {
              "name": ":P15",
              "type": "expression",
              "value": "{{$_POST.observations}}"
            },
            {
              "name": ":P16",
              "type": "expression",
              "value": "{{$_POST.permit_number}}"
            },
            {
              "name": ":P17",
              "type": "expression",
              "value": "{{$_POST.maitre_doeuvre}}"
            },
            {
              "name": ":P18",
              "type": "expression",
              "value": "{{$_POST.maitre_douvrage}}"
            },
            {
              "name": ":P19",
              "type": "expression",
              "value": "{{$_POST.construction_type}}"
            },
            {
              "name": ":P20",
              "type": "expression",
              "value": "{{$_POST.district}}"
            },
            {
              "name": ":P21",
              "type": "expression",
              "value": "{{$_POST.neighborhood}}"
            },
            {
              "name": ":P22",
              "type": "expression",
              "value": "{{$_POST.neighbordhood_local_name}}"
            },
            {
              "name": ":P23",
              "type": "expression",
              "value": "{{$_POST.street_name}}"
            },
            {
              "name": ":P24",
              "type": "expression",
              "value": "{{$_POST.project_purpose}}"
            },
            {
              "name": ":P25",
              "type": "expression",
              "value": "{{$_POST.project_id}}"
            },
            {
              "name": ":P26",
              "type": "expression",
              "value": "{{$_POST.asset}}"
            }
          ]
        }
      },
      "meta": [
        {
          "name": "identity",
          "type": "text"
        },
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