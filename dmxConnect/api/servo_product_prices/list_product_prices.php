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
        "name": "product_id"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query_list_product_prices",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "servodb",
        "sql": {
          "type": "SELECT",
          "columns": [
            {
              "table": "servo_product_price",
              "column": "product_price_id"
            },
            {
              "table": "servo_product_price",
              "column": "product_price"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_date"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_product_id"
            },
            {
              "table": "servo_product_price",
              "column": "servo_service_service_id"
            },
            {
              "table": "servo_products",
              "column": "product_name"
            },
            {
              "table": "servo_services",
              "column": "service_id"
            },
            {
              "table": "servo_services",
              "column": "service_name"
            },
            {
              "table": "servo_product_price",
              "column": "product_price_uom_service"
            }
          ],
          "table": {
            "name": "servo_product_price",
            "alias": "servo_product_price"
          },
          "joins": [
            {
              "table": "servo_products",
              "column": "*",
              "alias": "servo_products",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_products",
                    "column": "product_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_product_price",
                      "column": "product_price_product_id"
                    }
                  }
                ]
              },
              "primary": "product_id"
            },
            {
              "table": "servo_services",
              "column": "*",
              "alias": "servo_services",
              "type": "LEFT",
              "clauses": {
                "condition": "AND",
                "rules": [
                  {
                    "table": "servo_services",
                    "column": "service_id",
                    "operator": "equal",
                    "operation": "=",
                    "value": {
                      "table": "servo_product_price",
                      "column": "servo_service_service_id"
                    }
                  }
                ]
              },
              "primary": "service_id"
            }
          ],
          "query": "select `servo_product_price`.`product_price_id`, `servo_product_price`.`product_price`, `servo_product_price`.`product_price_date`, `servo_product_price`.`product_price_product_id`, `servo_product_price`.`servo_service_service_id`, `servo_products`.`product_name`, `servo_services`.`service_id`, `servo_services`.`service_name`, `servo_product_price`.`product_price_uom_service` from `servo_product_price` as `servo_product_price` left join `servo_products` as `servo_products` on `servo_products`.`product_id` = `servo_product_price`.`product_price_product_id` left join `servo_services` as `servo_services` on `servo_services`.`service_id` = `servo_product_price`.`servo_service_service_id` where `servo_product_price`.`product_price_product_id` = ?",
          "params": [
            {
              "operator": "equal",
              "type": "expression",
              "name": ":P1",
              "value": "{{$_GET.product_id}}"
            }
          ],
          "orders": [],
          "wheres": {
            "condition": "AND",
            "rules": [
              {
                "id": "servo_product_price.product_price_product_id",
                "field": "servo_product_price.product_price_product_id",
                "type": "double",
                "operator": "equal",
                "value": "{{$_GET.product_id}}",
                "data": {
                  "table": "servo_product_price",
                  "column": "product_price_product_id",
                  "type": "number"
                },
                "operation": "="
              }
            ],
            "conditional": null,
            "valid": true
          },
          "primary": "product_price_id"
        }
      },
      "output": true,
      "meta": [
        {
          "type": "number",
          "name": "product_price_id"
        },
        {
          "type": "number",
          "name": "product_price"
        },
        {
          "type": "datetime",
          "name": "product_price_date"
        },
        {
          "type": "number",
          "name": "product_price_product_id"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
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
          "name": "product_price_uom_service"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>