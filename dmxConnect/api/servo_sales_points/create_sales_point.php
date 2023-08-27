<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "text",
        "name": "sales_point_name"
      },
      {
        "type": "number",
        "name": "sales_point_customer_id"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "insert_pos_customer",
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
                "value": "SERVO"
              },
              {
                "table": "servo_customers",
                "column": "customer_last_name",
                "type": "text",
                "value": "{{$_POST.sales_point_name}}"
              },
              {
                "table": "servo_customers",
                "column": "customer_class",
                "type": "text",
                "value": "pos"
              }
            ],
            "table": "servo_customers",
            "returning": "customer_id",
            "query": "insert into `servo_customers` (`customer_class`, `customer_first_name`, `customer_last_name`) values (?, ?, ?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.sales_point_name}}",
                "test": ""
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
        "name": "get_last_ins",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select last_insert_id()",
            "params": []
          }
        },
        "meta": [
          {
            "name": "last_insert_id()",
            "type": "text"
          }
        ],
        "output": true
      },
      {
        "name": "insert_create_sales_point",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "servo_sales_point",
                "column": "sales_point_name",
                "type": "text",
                "value": "{{$_POST.sales_point_name}}"
              },
              {
                "table": "servo_sales_point",
                "column": "sales_point_customer_id",
                "type": "number",
                "value": "{{insert_pos_customer.identity}}"
              }
            ],
            "table": "servo_sales_point",
            "returning": "sales_point_id",
            "query": "insert into `servo_sales_point` (`sales_point_customer_id`, `sales_point_name`) values (?, ?)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.sales_point_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{insert_pos_customer.identity}}",
                "test": ""
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
      }
    ]
  }
}
JSON
);
?>