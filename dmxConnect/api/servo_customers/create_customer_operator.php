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
    ],
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
        "type": "text",
        "name": "customer_picture"
      },
      {
        "type": "file",
        "name": "customer_picture_file",
        "sub": [
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "text",
            "name": "type"
          },
          {
            "type": "number",
            "name": "size"
          },
          {
            "type": "text",
            "name": "error"
          }
        ],
        "outputType": "file"
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
        "name": "customer_city"
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
      },
      {
        "type": "text",
        "name": "id_card_number"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "upload_customer_picture",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/customer_pictures",
          "fields": "{{$_POST.customer_picture_file}}"
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "file",
        "output": true
      },
      {
        "name": "insert_customer_operator",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
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
                "column": "customer_picture",
                "type": "text",
                "value": "{{upload_customer_picture.name}}"
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
              },
              {
                "table": "servo_customers",
                "column": "id_card_number",
                "type": "text",
                "value": "{{$_POST.id_card_number}}"
              }
            ],
            "table": "servo_customers",
            "returning": "customer_id",
            "query": "insert into `servo_customers` (`customer_address`, `customer_age`, `customer_dob`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_legal_status`, `customer_phone_number`, `customer_picture`, `customer_rep_address`, `customer_rep_id_card`, `customer_rep_name`, `customer_rep_phone`, `customer_rep_surname`, `customer_sex`, `customer_tax_payer_number`, `id_card_number`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
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
                "value": "{{upload_customer_picture.name}}"
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
                "name": ":P17",
                "type": "expression",
                "value": "{{$_POST.id_card_number}}"
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
        ]
      },
      {
        "name": "custom_get_last_customer",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT last_insert_id()",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "text"
          }
        ]
      }
    ]
  }
}
JSON
);
?>