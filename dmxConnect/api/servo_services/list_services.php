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
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_services",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_services",
            "alias": "servo_services"
          },
          "primary": "service_id",
          "joins": [],
          "query": "SELECT *\nFROM servo_services AS servo_services",
          "params": []
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "service_id"
        },
        {
          "type": "text",
          "name": "service_name"
        },
        {
          "type": "number",
          "name": "servo_service_sales_point"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>