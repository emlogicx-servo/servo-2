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
      "name": "query_list_sales_points",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_customers",
              "column": "customer_first_name"
            },
            {
              "table": "servo_customers",
              "column": "customer_last_name"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_id"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_name"
            },
            {
              "table": "servo_sales_point",
              "column": "sales_point_customer_id"
            }
          ],
          "table": {
            "name": "servo_sales_point",
            "alias": "servo_sales_point"
          },
          "primary": "sales_point_id",
          "joins": [
            {
              "table": "servo_customers",
              "column": "*",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_customers",
                    "column": "customer_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_sales_point",
                      "column": "sales_point_customer_id"
                    }
                  }
                ]
              },
              "primary": "customer_id"
            }
          ],
          "query": "select `servo_customers`.`customer_first_name`, `servo_customers`.`customer_last_name`, `servo_sales_point`.`sales_point_id`, `servo_sales_point`.`sales_point_name`, `servo_sales_point`.`sales_point_customer_id` from `servo_sales_point` as `servo_sales_point` left join `servo_customers` on `servo_customers`.`customer_id` = `servo_sales_point`.`sales_point_customer_id` order by `servo_sales_point`.`sales_point_name` ASC",
          "params": [],
          "orders": [
            {
              "table": "servo_sales_point",
              "column": "sales_point_name",
              "direction": "ASC",
              "recid": 1
            }
          ]
        },
        "connection": "servodb"
      },
      "output": true,
      "meta": [
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
          "name": "sales_point_id"
        },
        {
          "type": "text",
          "name": "sales_point_name"
        },
        {
          "type": "number",
          "name": "sales_point_customer_id"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>