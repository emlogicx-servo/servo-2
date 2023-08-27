<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "customer_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_read_customer",
      "module": "dbconnector",
      "action": "single",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "servo_customers"
          },
          "joins": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_customers.customer_id",
                "field": "servo_customers.customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.customer_id}}",
                "data": {
                  "table": "servo_customers",
                  "column": "customer_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "query": "SELECT *\nFROM servo_customers\nWHERE customer_id = :P1 /* {{$_GET.customer_id}} */",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.customer_id}}"
            }
          ],
          "primary": "customer_id"
        }
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
          "type": "text",
          "name": "customer_phone_number"
        },
        {
          "type": "text",
          "name": "customer_picture"
        },
        {
          "type": "text",
          "name": "customer_class"
        },
        {
          "type": "text",
          "name": "customer_sex"
        },
        {
          "type": "datetime",
          "name": "customer_dob"
        },
        {
          "type": "number",
          "name": "customer_age"
        },
        {
          "type": "text",
          "name": "customer_address"
        },
        {
          "type": "number",
          "name": "id_card_number"
        },
        {
          "type": "text",
          "name": "location_lat"
        },
        {
          "type": "text",
          "name": "locatio_lon"
        },
        {
          "type": "number",
          "name": "customer_city"
        },
        {
          "type": "text",
          "name": "customer_building_photo"
        },
        {
          "type": "text",
          "name": "customer_location_diretions"
        },
        {
          "type": "number",
          "name": "customer_nationality"
        },
        {
          "type": "text",
          "name": "customer_email"
        },
        {
          "type": "text",
          "name": "customer_legal_status"
        },
        {
          "type": "number",
          "name": "customer_tax_payer_number"
        },
        {
          "type": "text",
          "name": "customer_rep_name"
        },
        {
          "type": "text",
          "name": "customer_rep_surname"
        },
        {
          "type": "text",
          "name": "customer_rep_id_card"
        },
        {
          "type": "text",
          "name": "customer_rep_address"
        },
        {
          "type": "text",
          "name": "customer_rep_phone"
        }
      ],
      "outputType": "object"
    }
  }
}
JSON
);
?>