<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sales_point_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_sales_point",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_sales_point",
            "alias": "servo_sales_point"
          },
          "primary": "sales_point_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_sales_point AS servo_sales_point\nWHERE sales_point_id = :P1 /* {{$_GET.sales_point_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.sales_point_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_sales_point.sales_point_id",
                "field": "servo_sales_point.sales_point_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.sales_point_id}}",
                "data": {
                  "table": "servo_sales_point",
                  "column": "sales_point_id",
                  "type": "number",
                  "columnObj": {
                    "type": "integer",
                    "primary": true,
                    "name": "sales_point_id"
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
      "meta": [],
      "outputType": "object"
    }
  }
}
JSON
);
?>