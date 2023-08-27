<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "data_field_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "read_data_field",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_data_fields"
          },
          "primary": "data_field_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_data_fields\nWHERE data_field_id = :P1 /* {{$_GET.data_field_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.data_field_id}}"
            }
          ],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_data_fields.data_field_id",
                "field": "servo_data_fields.data_field_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.data_field_id}}",
                "data": {
                  "table": "servo_data_fields",
                  "column": "data_field_id",
                  "type": "number",
                  "columnObj": {
                    "type": "increments",
                    "primary": true,
                    "nullable": false,
                    "name": "data_field_id"
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
      "meta": [
        {
          "type": "number",
          "name": "data_field_id"
        },
        {
          "type": "text",
          "name": "data_field_name"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>