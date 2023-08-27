<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "data_field_name"
      },
      {
        "type": "number",
        "name": "data_field_id"
      },
      {
        "type": "text",
        "name": "data_field_unit"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "update_data_field",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_data_fields",
              "column": "data_field_name",
              "type": "text",
              "value": "{{$_POST.data_field_name}}"
            },
            {
              "table": "servo_data_fields",
              "column": "data_field_unit",
              "type": "text",
              "value": "{{$_POST.data_field_unit}}"
            }
          ],
          "table": "servo_data_fields",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "data_field_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.data_field_id}}",
                "data": {
                  "column": "data_field_id"
                },
                "operation": "="
              }
            ]
          },
          "returning": "data_field_id",
          "query": "UPDATE servo_data_fields\nSET data_field_name = :P1 /* {{$_POST.data_field_name}} */, data_field_unit = :P2 /* {{$_POST.data_field_unit}} */\nWHERE data_field_id = :P3 /* {{$_POST.data_field_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.data_field_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.data_field_unit}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P3",
              "value": "{{$_POST.data_field_id}}"
            }
          ]
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