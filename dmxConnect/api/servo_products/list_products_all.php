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
        "name": "limit"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "dir"
      },
      {
        "type": "text",
        "name": "product_name"
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
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "distinct": false,
            "columns": [],
            "table": {
              "name": "servo_products"
            },
            "joins": [
              {
                "table": "servo_product_categories",
                "column": "*",
                "type": "LEFT",
                "clauses": {
                  "condition": "AND",
                  "rules": [
                    {
                      "table": "servo_product_categories",
                      "column": "product_categories_id",
                      "operator": "equal",
                      "operation": "=",
                      "value": {
                        "table": "servo_products",
                        "column": "servo_product_category_product_category_id"
                      }
                    }
                  ]
                },
                "primary": "product_categories_id"
              }
            ],
            "orders": [],
            "params": [
              {
                "operator": "contains",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.product_name}}",
                "test": ""
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{$_GET.product_category}}",
                "test": ""
              }
            ],
            "primary": "product_id",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_products.product_name",
                      "field": "servo_products.product_name",
                      "type": "string",
                      "operator": "contains",
                      "value": "{{$_GET.product_name}}",
                      "data": {
                        "table": "servo_products",
                        "column": "product_name",
                        "type": "text",
                        "columnObj": {
                          "type": "string",
                          "maxLength": 1000,
                          "primary": false,
                          "nullable": false,
                          "name": "product_name"
                        }
                      },
                      "operation": "LIKE",
                      "table": "servo_products"
                    }
                  ],
                  "conditional": "{{$_GET.product_name}}",
                  "table": "servo_products",
                  "id": "servo_products.undefined"
                },
                {
                  "condition": "AND",
                  "rules": [
                    {
                      "id": "servo_products.servo_product_category_product_category_id",
                      "field": "servo_products.servo_product_category_product_category_id",
                      "type": "double",
                      "operator": "equal",
                      "value": "{{$_GET.product_category}}",
                      "data": {
                        "table": "servo_products",
                        "column": "servo_product_category_product_category_id",
                        "type": "number",
                        "columnObj": {
                          "type": "reference",
                          "default": "",
                          "primary": false,
                          "nullable": true,
                          "references": "product_categories_id",
                          "inTable": "servo_product_categories",
                          "referenceType": "integer",
                          "onUpdate": "NO ACTION",
                          "onDelete": "NO ACTION",
                          "name": "servo_product_category_product_category_id"
                        }
                      },
                      "operation": "=",
                      "table": "servo_products"
                    }
                  ],
                  "conditional": "{{$_GET.product_category}}",
                  "table": "servo_products",
                  "id": "servo_products.undefined"
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "select * from `servo_products` left join `servo_product_categories` on `servo_product_categories`.`product_categories_id` = `servo_products`.`servo_product_category_product_category_id` where (`servo_products`.`product_name` like ?) and (`servo_products`.`servo_product_category_product_category_id` = ?)"
          }
        },
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "product_id"
              },
              {
                "type": "text",
                "name": "product_name"
              },
              {
                "type": "text",
                "name": "product_picture"
              },
              {
                "type": "number",
                "name": "servo_product_brands_product_brand_id"
              },
              {
                "type": "text",
                "name": "product_description"
              },
              {
                "type": "number",
                "name": "servo_product_category_product_category_id"
              },
              {
                "type": "number",
                "name": "product_standard_price"
              },
              {
                "type": "number",
                "name": "product_discount"
              },
              {
                "type": "text",
                "name": "product_type"
              },
              {
                "type": "number",
                "name": "product_stock_value"
              },
              {
                "type": "number",
                "name": "product_min_stock"
              },
              {
                "type": "datetime",
                "name": "product_expiration_date"
              },
              {
                "type": "number",
                "name": "product_sub_category_sub_category_id"
              },
              {
                "type": "text",
                "name": "product_reference_uom"
              }
            ]
          }
        ],
        "type": "dbconnector_paged_select",
        "outputType": "object",
        "output": true
      },
      {
        "name": "query_list_categories",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "servodb",
          "sql": {
            "type": "select",
            "columns": [],
            "params": [],
            "table": {
              "name": "servo_product_categories"
            },
            "primary": "product_categories_id",
            "joins": [],
            "query": "select * from `servo_product_categories`"
          }
        },
        "output": true,
        "meta": [
          {
            "type": "number",
            "name": "product_categories_id"
          },
          {
            "type": "text",
            "name": "product_category_name"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "repeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{query_list_products.data}}",
          "outputFields": [],
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
            "name": "product_reference_uom",
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