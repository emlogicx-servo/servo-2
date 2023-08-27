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
        "name": "query_list_products",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "select * from servo_products\n\nleft join servo_product_categories on servo_product_category_product_category_id = product_categories_id\n\nwhere product_name LIKE :P3\n\nlimit 50\n",
            "params": [
              {
                "name": ":P3",
                "value": "%{{$_GET.search}}%",
                "test": "%"
              },
              {
                "name": ":P2",
                "value": "%{{$_GET.product_category}}%",
                "test": "%"
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
            "type": "file"
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
            "type": "file"
          },
          {
            "name": "product_stock_value",
            "type": "number"
          },
          {
            "name": "product_min_stock",
            "type": "number"
          },
          {
            "name": "product_expiration_date",
            "type": "datetime"
          },
          {
            "name": "product_sub_category_sub_category_id",
            "type": "number"
          },
          {
            "name": "product_categories_id",
            "type": "number"
          },
          {
            "name": "product_category_name",
            "type": "text"
          }
        ]
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query_list_products}}",
          "outputFields": [
            "product_id",
            "product_name",
            "product_description",
            "product_standard_price",
            "product_picture",
            "servo_product_brands_product_brand_id",
            "servo_product_category_product_category_id",
            "product_type",
            "product_discount",
            "product_stock_value",
            "product_min_stock",
            "product_expiration_date",
            "product_sub_category_sub_category_id",
            "product_categories_id",
            "product_category_name"
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
                "outputType": "array",
                "disabled": true
              },
              {
                "name": "query_list_product_stock",
                "module": "dbupdater",
                "action": "custom",
                "options": {
                  "connection": "servodb",
                  "sql": {
                    "query": "select product_id, product_name, ((select COALESCE(sum(po_item_quantity), 0) from servo_purchase_order_items \nleft join servo_purchase_orders on servo_purchase_orders.po_id = servo_purchase_order_items.po_id \nwhere po_status = \"Received\" and po_product_id = product_id)  -\n\n((select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status = 'Adjustment') +\n\n(select COALESCE(sum(order_item_quantity), 0) from servo_order_items left join servo_orders on order_id = servo_orders_order_id \nwhere servo_products_product_id = product_id and order_status IN ('Paid', 'Credit')))) as TotalStock\n\nfrom servo_products \n \nwhere product_id = :P1 \n",
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
                    "name": "product_id",
                    "type": "number"
                  },
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
            "type": "file"
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
            "type": "file"
          },
          {
            "name": "product_stock_value",
            "type": "number"
          },
          {
            "name": "product_min_stock",
            "type": "number"
          },
          {
            "name": "product_expiration_date",
            "type": "datetime"
          },
          {
            "name": "product_sub_category_sub_category_id",
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
          },
          {
            "name": "query_list_product_stock",
            "type": "text",
            "sub": [
              {
                "name": "product_id",
                "type": "number"
              },
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
        ],
        "outputType": "array",
        "output": true
      }
    ]
  }
}
JSON
);
?>