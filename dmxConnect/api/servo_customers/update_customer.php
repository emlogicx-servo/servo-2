<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
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
        "type": "number",
        "name": "customer_id"
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
    ]
  },
  "exec": {
    "steps": {
      "name": "update_customer",
      "module": "dbupdater",
      "action": "update",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "update",
          "values": [
            {
              "table": "servo_customers",
              "column": "customer_first_name",
              "type": "text",
              "value": "{{$_POST.customer_first_name}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_last_name",
              "type": "text",
              "value": "{{$_POST.customer_last_name}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_phone_number",
              "type": "number",
              "value": "{{$_POST.customer_phone_number}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_class",
              "type": "text",
              "value": "{{$_POST.customer_class}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_sex",
              "type": "text",
              "value": "{{$_POST.customer_sex}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_dob",
              "type": "datetime",
              "value": "{{$_POST.customer_dob}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_age",
              "type": "number",
              "value": "{{$_POST.customer_age}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_address",
              "type": "text",
              "value": "{{$_POST.customer_address}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_email",
              "type": "text",
              "value": "{{$_POST.customer_email}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_legal_status",
              "type": "text",
              "value": "{{$_POST.customer_legal_status}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_tax_payer_number",
              "type": "number",
              "value": "{{$_POST.customer_tax_payer_number}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_rep_name",
              "type": "text",
              "value": "{{$_POST.customer_rep_name}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_rep_surname",
              "type": "text",
              "value": "{{$_POST.customer_rep_surname}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_rep_id_card",
              "type": "text",
              "value": "{{$_POST.customer_rep_id_card}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_rep_address",
              "type": "text",
              "value": "{{$_POST.customer_rep_address}}"
            },
            {
              "table": "servo_customers",
              "column": "customer_rep_phone",
              "type": "text",
              "value": "{{$_POST.customer_rep_phone}}"
            }
          ],
          "table": "servo_customers",
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "customer_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_POST.customer_id}}",
                "data": {
                  "column": "customer_id"
                },
                "operation": "="
              }
            ]
          },
          "query": "UPDATE servo_customers\nSET customer_first_name = :P1 /* {{$_POST.customer_first_name}} */, customer_last_name = :P2 /* {{$_POST.customer_last_name}} */, customer_phone_number = :P3 /* {{$_POST.customer_phone_number}} */, customer_class = :P4 /* {{$_POST.customer_class}} */, customer_sex = :P5 /* {{$_POST.customer_sex}} */, customer_dob = :P6 /* {{$_POST.customer_dob}} */, customer_age = :P7 /* {{$_POST.customer_age}} */, customer_address = :P8 /* {{$_POST.customer_address}} */, customer_email = :P9 /* {{$_POST.customer_email}} */, customer_legal_status = :P10 /* {{$_POST.customer_legal_status}} */, customer_tax_payer_number = :P11 /* {{$_POST.customer_tax_payer_number}} */, customer_rep_name = :P12 /* {{$_POST.customer_rep_name}} */, customer_rep_surname = :P13 /* {{$_POST.customer_rep_surname}} */, customer_rep_id_card = :P14 /* {{$_POST.customer_rep_id_card}} */, customer_rep_address = :P15 /* {{$_POST.customer_rep_address}} */, customer_rep_phone = :P16 /* {{$_POST.customer_rep_phone}} */\nWHERE customer_id = :P17 /* {{$_POST.customer_id}} */",
          "params": [
            {
              "name": ":P1",
              "type": "expression",
              "value": "{{$_POST.customer_first_name}}"
            },
            {
              "name": ":P2",
              "type": "expression",
              "value": "{{$_POST.customer_last_name}}"
            },
            {
              "name": ":P3",
              "type": "expression",
              "value": "{{$_POST.customer_phone_number}}"
            },
            {
              "name": ":P4",
              "type": "expression",
              "value": "{{$_POST.customer_class}}"
            },
            {
              "name": ":P5",
              "type": "expression",
              "value": "{{$_POST.customer_sex}}"
            },
            {
              "name": ":P6",
              "type": "expression",
              "value": "{{$_POST.customer_dob}}"
            },
            {
              "name": ":P7",
              "type": "expression",
              "value": "{{$_POST.customer_age}}"
            },
            {
              "name": ":P8",
              "type": "expression",
              "value": "{{$_POST.customer_address}}"
            },
            {
              "name": ":P9",
              "type": "expression",
              "value": "{{$_POST.customer_email}}"
            },
            {
              "name": ":P10",
              "type": "expression",
              "value": "{{$_POST.customer_legal_status}}"
            },
            {
              "name": ":P11",
              "type": "expression",
              "value": "{{$_POST.customer_tax_payer_number}}"
            },
            {
              "name": ":P12",
              "type": "expression",
              "value": "{{$_POST.customer_rep_name}}"
            },
            {
              "name": ":P13",
              "type": "expression",
              "value": "{{$_POST.customer_rep_surname}}"
            },
            {
              "name": ":P14",
              "type": "expression",
              "value": "{{$_POST.customer_rep_id_card}}"
            },
            {
              "name": ":P15",
              "type": "expression",
              "value": "{{$_POST.customer_rep_address}}"
            },
            {
              "name": ":P16",
              "type": "expression",
              "value": "{{$_POST.customer_rep_phone}}"
            },
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P17",
              "value": "{{$_POST.customer_id}}"
            }
          ],
          "returning": "customer_id"
        }
      },
      "meta": [
        {
          "name": "affected",
          "type": "number"
        }
      ]
    }
  }
}
JSON
);
?>