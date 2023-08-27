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
        "type": "text",
        "name": "data_field_unit"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "create_data_field",
      "module": "dbupdater",
      "action": "insert",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "insert",
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
          "returning": "data_field_id",
          "query": "INSERT INTO servo_data_fields\n(data_field_name, data_field_unit) VALUES (:P1 /* {{$_POST.data_field_name}} */, :P2 /* {{$_POST.data_field_unit}} */)",
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