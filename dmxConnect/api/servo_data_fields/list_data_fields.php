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
      },
      {
        "type": "text",
        "name": "data_reading_session_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "query_list_data_fields",
        "module": "dbconnector",
        "action": "select",
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
            "query": "SELECT *\nFROM servo_data_fields",
            "params": []
          }
        },
        "type": "dbconnector_select",
        "meta": [
          {
            "type": "number",
            "name": "data_field_id"
          },
          {
            "type": "text",
            "name": "data_field_name"
          },
          {
            "type": "text",
            "name": "data_field_unit"
          }
        ],
        "outputType": "array",
        "output": true,
        "disabled": true
      },
      {
        "name": "query_list_data_fields",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select * from servo_data_fields \nwhere data_field_id NOT IN (select data_field_reading_data_field from servo_data_field_readings where data_reading_session_id = :P1)",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.data_reading_session_id}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "data_field_id",
            "type": "number"
          },
          {
            "name": "data_field_name",
            "type": "text"
          },
          {
            "name": "data_field_unit",
            "type": "text"
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