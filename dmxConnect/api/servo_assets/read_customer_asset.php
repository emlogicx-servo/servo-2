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
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": [
      {
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
      },
      {
        "name": "query_read_asset_floors",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.asset_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_asset_floors_cc"
            },
            "primary": "asset_floor_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_asset_floors_cc.asset_id",
                  "field": "servo_asset_floors_cc.asset_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.asset_id}}",
                  "data": {
                    "table": "servo_asset_floors_cc",
                    "column": "asset_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": false,
                      "references": "asset_id",
                      "inTable": "servo_assets",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "asset_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select * from `servo_asset_floors_cc` where `servo_asset_floors_cc`.`asset_id` = ?"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "asset_floor_id"
          },
          {
            "type": "number",
            "name": "asset_id"
          },
          {
            "type": "text",
            "name": "asset_floor_name"
          },
          {
            "type": "number",
            "name": "asset_floor_surface_area"
          },
          {
            "type": "number",
            "name": "asset_floor_number"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "TotalFloorArea",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [
              {
                "table": "servo_asset_floors_cc",
                "column": "asset_floor_surface_area",
                "alias": "TotalFloorArea",
                "aggregate": "SUM"
              }
            ],
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.asset_id}}",
                "test": ""
              }
            ],
            "table": {
              "name": "servo_asset_floors_cc"
            },
            "primary": "asset_floor_id",
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "servo_asset_floors_cc.asset_id",
                  "field": "servo_asset_floors_cc.asset_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.asset_id}}",
                  "data": {
                    "table": "servo_asset_floors_cc",
                    "column": "asset_id",
                    "type": "number",
                    "columnObj": {
                      "type": "reference",
                      "primary": false,
                      "nullable": false,
                      "references": "asset_id",
                      "inTable": "servo_assets",
                      "referenceType": "integer",
                      "onUpdate": "RESTRICT",
                      "onDelete": "RESTRICT",
                      "name": "asset_id"
                    }
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select sum(`asset_floor_surface_area`) as `TotalFloorArea` from `servo_asset_floors_cc` where `servo_asset_floors_cc`.`asset_id` = ?",
            "groupBy": []
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "TotalFloorArea"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>