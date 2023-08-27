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
        "name": "service_id"
      },
      {
        "type": "text",
        "name": "search"
      },
      {
        "type": "text",
        "name": "product_category"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "custom",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select * from servo_products\n\nleft join servo_product_categories on servo_product_category_product_category_id = product_categories_id\n\nleft join servo_product_sub_category on product_sub_category_sub_category_id = product_sub_category_id\n\nleft join servo_product_price\non product_price_product_id = product_id\n\nleft join \nservo_service_department_category\non sdc_category_id = servo_products.servo_product_category_product_category_id\nwhere \nsdc_service_id = :P1\nAND\nservo_products.product_name LIKE :P3\nAND\nservo_product_price.servo_service_service_id = :P1\nAND (product_type = 'Service' OR product_type = 'Store')\n\nAND product_categories_id LIKE :P2\n\nlimit 50\n",
            "params": [
              {
                "name": ":P3",
                "value": "%{{$_GET.search}}%"
              },
              {
                "name": ":P1",
                "value": "{{$_GET.service_id}}",
                "test": "6"
              },
              {
                "name": ":P2",
                "value": "%{{$_GET.product_category}}%",
                "test": "11"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "product_id",
            "type": "number"
          },
          {
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_picture",
            "type": "text"
          },
          {
            "name": "servo_product_brands_product_brand_id",
            "type": "number"
          },
          {
            "name": "product_description",
            "type": "text"
          },
          {
            "name": "servo_product_category_product_category_id",
            "type": "number"
          },
          {
            "name": "product_standard_price",
            "type": "number"
          },
          {
            "name": "product_discount",
            "type": "number"
          },
          {
            "name": "product_type",
            "type": "text"
          },
          {
            "name": "product_stock_value",
            "type": "text"
          },
          {
            "name": "product_min_stock",
            "type": "number"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "product_price_id",
            "type": "number"
          },
          {
            "name": "product_price",
            "type": "number"
          },
          {
            "name": "product_price_date",
            "type": "text"
          },
          {
            "name": "product_price_product_id",
            "type": "number"
          },
          {
            "name": "servo_service_service_id",
            "type": "number"
          },
          {
            "name": "product_price_code",
            "type": "text"
          },
          {
            "name": "service_department_category_id",
            "type": "number"
          },
          {
            "name": "sdc_service_id",
            "type": "number"
          },
          {
            "name": "sdc_category_id",
            "type": "number"
          },
          {
            "name": "sdc_department_id",
            "type": "number"
          },
          {
            "name": "sdc_code",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{custom}}",
          "outputFields": [
            "product_id",
            "product_picture",
            "product_name",
            "servo_product_brands_product_brand_id",
            "product_description",
            "servo_product_category_product_category_id",
            "product_standard_price",
            "product_discount",
            "product_type",
            "product_stock_value",
            "product_min_stock",
            "product_category_name",
            "product_price_product_id",
            "product_price_date",
            "sdc_code",
            "sdc_department_id",
            "sdc_category_id",
            "sdc_service_id",
            "service_department_category_id",
            "product_price_code",
            "servo_service_service_id",
            "product_price",
            "product_price_id",
            "product_categories_id"
          ],
          "exec": {
            "steps": [
              {
                "name": "query_list_options",
                "module": "dbconnector",
                "action": "select",
                "options": {
                  "sql": {
                    "type": "SELECT",
                    "columns": [],
                    "table": {
                      "name": "servo_product_category_options",
                      "alias": "servo_product_category_options"
                    },
                    "primary": "category_option_id",
                    "joins": [],
                    "query": "SELECT *\nFROM servo_product_category_options AS servo_product_category_options\nWHERE category_option_category_id = :P1 /* {{product_categories_id}} */",
                    "params": [
                      {
                        "operator": "equal",
                        "type": "expression",
                        "name": ":P1",
                        "value": "{{product_categories_id}}"
                      }
                    ],
                    "wheres": {
                      "condition": "AND",
                      "rules": [
                        {
                          "id": "servo_product_category_options.category_option_category_id",
                          "field": "servo_product_category_options.category_option_category_id",
                          "type": "double",
                          "operator": "equal",
                          "value": "{{product_categories_id}}",
                          "data": {
                            "table": "servo_product_category_options",
                            "column": "category_option_category_id",
                            "type": "number",
                            "columnObj": {
                              "type": "reference",
                              "primary": false,
                              "nullable": false,
                              "references": "product_categories_id",
                              "inTable": "servo_product_categories",
                              "onUpdate": "RESTRICT",
                              "onDelete": "RESTRICT",
                              "name": "category_option_category_id"
                            }
                          },
                          "operation": "="
                        }
                      ],
                      "conditional": null,
                      "valid": true
                    }
                  },
                  "connection": "servodb"
                },
                "output": true,
                "meta": [
                  {
                    "type": "number",
                    "name": "category_option_id"
                  },
                  {
                    "type": "number",
                    "name": "category_option_category_id"
                  },
                  {
                    "type": "text",
                    "name": "category_option_option"
                  }
                ],
                "outputType": "array"
              },
              {
                "name": "query_list_product_stock",
                "module": "dbupdater",
                "action": "custom",
                "options": {
                  "connection": "servodb",
                  "sql": {
                    "query": "select product_name, ((select COALESCE(sum(po_item_quantity), 0) from servo_purchase_order_items \nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \nwhere po_status = \"Received\" and po_product_id = product_id)  -\n\n((select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status = 'Adjustment') +\n\n(select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status IN ('Paid', 'Credit')))) as TotalStock\n\nfrom servo_products \n \nwhere product_id = :P1 \n",
                    "params": [
                      {
                        "name": ":P1",
                        "value": "{{product_id}}",
                        "test": "71"
                      }
                    ]
                  }
                },
                "output": true,
                "meta": [
                  {
                    "name": "product_name",
                    "type": "text"
                  },
                  {
                    "name": "TotalStock",
                    "type": "text"
                  }
                ]
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
          {
            "name": "product_id",
            "type": "number"
          },
          {
            "name": "product_name",
            "type": "text"
          },
          {
            "name": "product_picture",
            "type": "text"
          },
          {
            "name": "servo_product_brands_product_brand_id",
            "type": "number"
          },
          {
            "name": "product_description",
            "type": "text"
          },
          {
            "name": "servo_product_category_product_category_id",
            "type": "number"
          },
          {
            "name": "product_standard_price",
            "type": "number"
          },
          {
            "name": "product_discount",
            "type": "number"
          },
          {
            "name": "product_type",
            "type": "text"
          },
          {
            "name": "product_stock_value",
            "type": "text"
          },
          {
            "name": "product_min_stock",
            "type": "number"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          },
          {
            "name": "product_price_id",
            "type": "number"
          },
          {
            "name": "product_price",
            "type": "number"
          },
          {
            "name": "product_price_date",
            "type": "text"
          },
          {
            "name": "product_price_product_id",
            "type": "number"
          },
          {
            "name": "servo_service_service_id",
            "type": "number"
          },
          {
            "name": "product_price_code",
            "type": "text"
          },
          {
            "name": "service_department_category_id",
            "type": "number"
          },
          {
            "name": "sdc_service_id",
            "type": "number"
          },
          {
            "name": "sdc_category_id",
            "type": "number"
          },
          {
            "name": "sdc_department_id",
            "type": "number"
          },
          {
            "name": "sdc_code",
            "type": "text"
          },
          {
            "name": "query_list_options",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "category_option_id"
              },
              {
                "type": "number",
                "name": "category_option_category_id"
              },
              {
                "type": "text",
                "name": "category_option_option"
              }
            ]
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