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
      "name": "query_list_customers",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customers"
          },
          "joins": [],
          "query": "SELECT *\nFROM servo_customers",
          "params": []
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "customer_id"
        },
        {
          "type": "text",
          "name": "customer_first_name"
        },
        {
          "type": "text",
          "name": "customer_last_name"
        },
        {
          "type": "number",
          "name": "customer_phone_number"
        },
        {
          "type": "text",
          "name": "customer_picture"
        }
      ],
      "outputType": "array",
      "type": "dbconnector_select"
    }
  }
}
JSON
);
?>