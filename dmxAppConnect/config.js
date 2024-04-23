dmx.config({
  "Page2": {
    "repeat1": {
      "meta": null,
      "outputType": "text"
    },
    "repeat2": {
      "meta": null,
      "outputType": "text"
    },
    "sessionStorage": [
      {
        "type": "text",
        "name": "thisproduct"
      }
    ]
  },
  "productdetails": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "thisproduct"
      }
    ]
  },
  "header": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "user_profile"
      },
      {
        "type": "text",
        "name": "user_id"
      }
    ],
    "currentUser": {
      "meta": null,
      "outputType": "number"
    },
    "query": [
      {
        "type": "text",
        "name": "listShiftsOffset"
      }
    ]
  },
  "service": {
    "repeat1": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "order_item_id"
        },
        {
          "type": "datetime",
          "name": "order_time_ordered"
        },
        {
          "type": "datetime",
          "name": "order_time_ready"
        },
        {
          "type": "datetime",
          "name": "order_time_delivered"
        },
        {
          "type": "text",
          "name": "order_item_status"
        },
        {
          "type": "text",
          "name": "order_item_notes"
        },
        {
          "type": "number",
          "name": "order_item_quantity"
        },
        {
          "type": "number",
          "name": "order_item_price"
        },
        {
          "type": "number",
          "name": "order_item_discount"
        },
        {
          "type": "datetime",
          "name": "order_time_processing"
        },
        {
          "type": "text",
          "name": "order_item_type"
        },
        {
          "type": "number",
          "name": "servo_users_user_ordered"
        },
        {
          "type": "text",
          "name": "order_item_group_type"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        },
        {
          "type": "number",
          "name": "order_id"
        },
        {
          "type": "datetime",
          "name": "order_time"
        },
        {
          "type": "number",
          "name": "order_customer"
        },
        {
          "type": "number",
          "name": "order_discount"
        },
        {
          "type": "text",
          "name": "order_status"
        },
        {
          "type": "number",
          "name": "servo_user_user_id"
        },
        {
          "type": "number",
          "name": "servo_customer_table_table_id"
        },
        {
          "type": "text",
          "name": "order_notes"
        },
        {
          "type": "number",
          "name": "servo_shift_shift_id"
        },
        {
          "type": "number",
          "name": "order_amount_tendered"
        },
        {
          "type": "number",
          "name": "order_balance"
        },
        {
          "type": "number",
          "name": "servo_users_cashier_id"
        },
        {
          "type": "number",
          "name": "servo_payment_methods_payment_method"
        },
        {
          "type": "number",
          "name": "servo_service_service_id"
        },
        {
          "type": "number",
          "name": "coverage_percentage"
        },
        {
          "type": "number",
          "name": "coverage_partner"
        },
        {
          "type": "text",
          "name": "coverage_payment_status"
        },
        {
          "type": "datetime",
          "name": "order_time_paid"
        },
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
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "number",
          "name": "servo_user_departments_department_id"
        },
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
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
          "name": "customer_address"
        },
        {
          "type": "number",
          "name": "customer_city"
        }
      ],
      "outputType": "array"
    },
    "department_cat": {
      "meta": [
        {
          "type": "number",
          "name": "id"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "number",
          "name": "category_id"
        },
        {
          "type": "text",
          "name": "department_name"
        },
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
    "tables": {
      "meta": [
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        },
        {
          "type": "number",
          "name": "branch_id"
        },
        {
          "type": "text",
          "name": "branch_name"
        },
        {
          "type": "datetime",
          "name": "branch_date_registered"
        }
      ],
      "outputType": "array"
    },
    "repeat2": {
      "meta": [
        {
          "type": "number",
          "name": "table_id"
        },
        {
          "type": "text",
          "name": "table_name"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        },
        {
          "type": "number",
          "name": "branch_id"
        },
        {
          "type": "text",
          "name": "branch_name"
        },
        {
          "type": "datetime",
          "name": "branch_date_registered"
        }
      ],
      "outputType": "array"
    },
    "sessionStorage": [
      {
        "type": "number",
        "name": "table_id"
      },
      {
        "type": "number",
        "name": "current_order"
      },
      {
        "type": "text",
        "name": "current_user"
      },
      {
        "type": "text",
        "name": "user_profile"
      },
      {
        "type": "text",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "user_department"
      },
      {
        "type": "text",
        "name": "current_shift"
      },
      {
        "type": "text",
        "name": "user_department_id"
      }
    ],
    "repeatproducts": {
      "meta": [
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "number",
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
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
    "products": {
      "meta": [
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "number",
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
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
    "users": {
      "meta": [
        {
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "password"
        },
        {
          "type": "number",
          "name": "servo_user_profile_user_profile_id"
        },
        {
          "type": "number",
          "name": "servo_user_departments_department_id"
        },
        {
          "type": "number",
          "name": "user_profile_id"
        },
        {
          "type": "text",
          "name": "user_profile_name"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat2": {
      "meta": [
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "Volume",
          "type": "text"
        },
        {
          "name": "Total",
          "type": "text"
        }
      ],
      "outputType": "text"
    }
  },
  "departments": {
    "repeat1": {
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
    "products": {
      "meta": [
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "number",
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
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
    "sessionStorage": [
      {
        "type": "text",
        "name": "userToAssign"
      },
      {
        "type": "text",
        "name": "assigned_department"
      },
      {
        "type": "text",
        "name": "current_order"
      }
    ],
    "repeatcategoryoptions": {
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
    "repeatCategoryOptions": {
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
    "options": {
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
    "repeatOptions": {
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
    "repeatoptions": {
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
        },
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
          "name": "product_price"
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
        }
      ],
      "outputType": "array"
    },
    "repeatproducts": {
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
    },
    "repeatProducts": {
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
          "type": "number"
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
    "repeatProds": {
      "meta": [
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
          "name": "product_price"
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
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
        {
          "type": "number",
          "name": "product_categories_id"
        },
        {
          "type": "text",
          "name": "product_category_name"
        },
        {
          "type": "number",
          "name": "product_price_id"
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
          "name": "product_price_department_id"
        },
        {
          "type": "text",
          "name": "product_department"
        }
      ],
      "outputType": "array"
    },
    "repeatproductoptions": {
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
    "repeatproductsgroups": {
      "meta": [
        {
          "type": "number",
          "name": "product_group_id"
        },
        {
          "type": "text",
          "name": "product_group_name"
        }
      ],
      "outputType": "array"
    },
    "repeatOptions1": {
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
    "repeatGroupItems": {
      "meta": [
        {
          "type": "number",
          "name": "product_group_item_id"
        },
        {
          "type": "number",
          "name": "product_group_product_id"
        },
        {
          "type": "number",
          "name": "product_group_product_quantity"
        },
        {
          "type": "number",
          "name": "product_group_product_group_id"
        },
        {
          "type": "number",
          "name": "product_group_product_unit_price"
        },
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
        }
      ],
      "outputType": "array"
    },
    "repeatproductgroups": {
      "meta": [
        {
          "name": "product_group_id",
          "type": "number"
        },
        {
          "name": "product_group_name",
          "type": "text"
        },
        {
          "name": "query_list_grouped_products",
          "type": "array",
          "sub": [
            {
              "type": "number",
              "name": "product_group_item_id"
            },
            {
              "type": "number",
              "name": "product_group_product_id"
            },
            {
              "type": "number",
              "name": "product_group_product_quantity"
            },
            {
              "type": "number",
              "name": "product_group_product_group_id"
            },
            {
              "type": "number",
              "name": "product_group_product_unit_price"
            },
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
            }
          ]
        }
      ],
      "outputType": "array"
    },
    "repeatgroupitems": {
      "meta": [
        {
          "type": "number",
          "name": "product_group_item_id"
        },
        {
          "type": "number",
          "name": "product_group_product_id"
        },
        {
          "type": "number",
          "name": "product_group_product_quantity"
        },
        {
          "type": "number",
          "name": "product_group_product_group_id"
        },
        {
          "type": "number",
          "name": "product_group_product_unit_price"
        },
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
        }
      ],
      "outputType": "array"
    },
    "repeatServices": {
      "meta": [
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
          "name": "servo_service_sales_point"
        }
      ],
      "outputType": "array"
    },
    "repeat3": {
      "meta": null,
      "outputType": "number"
    },
    "repeatPOS": {
      "meta": [
        {
          "type": "number",
          "name": "sales_point_id"
        },
        {
          "type": "text",
          "name": "sales_point_name"
        }
      ],
      "outputType": "array"
    },
    "var1": {
      "meta": null,
      "outputType": "boolean"
    },
    "query": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      }
    ],
    "tableRepeat5": {
      "meta": [
        {
          "type": "number",
          "name": "shift_id"
        },
        {
          "type": "datetime",
          "name": "shift_start"
        },
        {
          "type": "datetime",
          "name": "shift_stop"
        },
        {
          "type": "number",
          "name": "servo_branches_branch_id"
        },
        {
          "type": "text",
          "name": "shift_status"
        }
      ],
      "outputType": "array"
    }
  },
  "ServoProcurement": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_purchase_order"
      },
      {
        "type": "text",
        "name": "current_adjustment_order"
      }
    ],
    "arr1": {
      "meta": [
        {
          "type": "number",
          "name": "po_product_id"
        },
        {
          "type": "number",
          "name": "po_item_quantity"
        },
        {
          "type": "number",
          "name": "po_item_price"
        },
        {
          "type": "text",
          "name": "po_item_notes"
        },
        {
          "type": "number",
          "name": "po_item_id"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        }
      ],
      "outputType": "array"
    },
    "products": {
      "meta": [
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        },
        {
          "type": "number",
          "name": "product_brand_id"
        },
        {
          "type": "text",
          "name": "product_brand_name"
        },
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
    "query": [
      {
        "type": "text",
        "name": "sort_po"
      },
      {
        "type": "text",
        "name": "dir_po"
      },
      {
        "type": "text",
        "name": "limit_po"
      },
      {
        "type": "text",
        "name": "offset_po"
      },
      {
        "type": "text",
        "name": "offset_to_in"
      },
      {
        "type": "text",
        "name": "offset_to_out"
      },
      {
        "type": "text",
        "name": "stock_value_offset"
      },
      {
        "type": "text",
        "name": "offset_to"
      },
      {
        "type": "text",
        "name": "sort_to_in"
      },
      {
        "type": "text",
        "name": "sort_to_out"
      }
    ],
    "var2": {
      "meta": null,
      "outputType": "text"
    },
    "data_view1": {
      "meta": [
        {
          "name": "po_product_id",
          "type": "number"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "TotalPurchased",
          "type": "text"
        },
        {
          "name": "TotalAdjusted",
          "type": "text"
        },
        {
          "name": "TotalSold",
          "type": "text"
        }
      ],
      "outputType": "array"
    },
    "receiptDetails": {
      "meta": [
        {
          "type": "number",
          "name": "po_product_id"
        },
        {
          "type": "number",
          "name": "po_item_quantity"
        },
        {
          "type": "number",
          "name": "po_item_price"
        },
        {
          "type": "text",
          "name": "po_item_notes"
        },
        {
          "type": "number",
          "name": "po_item_id"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "number",
          "name": "product_id"
        },
        {
          "type": "text",
          "name": "product_name"
        },
        {
          "type": "file",
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
          "name": "product_price"
        },
        {
          "type": "number",
          "name": "product_discount"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat8": {
      "meta": null,
      "outputType": "object"
    },
    "tableRepeat5": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "datetime",
          "name": "time_ordered"
        },
        {
          "type": "datetime",
          "name": "time_approved"
        },
        {
          "type": "text",
          "name": "po_status"
        },
        {
          "type": "text",
          "name": "po_notes"
        },
        {
          "type": "datetime",
          "name": "po_need_by_date"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "vendor_name"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "number",
          "name": "servo_users_user_received_id"
        },
        {
          "type": "text",
          "name": "po_type"
        },
        {
          "type": "number",
          "name": "transfer_source_department_id"
        }
      ],
      "outputType": "array"
    },
    "list_tos_in": {
      "meta": [
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "datetime",
          "name": "time_ordered"
        },
        {
          "type": "datetime",
          "name": "time_approved"
        },
        {
          "type": "text",
          "name": "po_status"
        },
        {
          "type": "text",
          "name": "po_notes"
        },
        {
          "type": "datetime",
          "name": "po_need_by_date"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "vendor_name"
        },
        {
          "type": "number",
          "name": "servo_users_user_received_id"
        },
        {
          "type": "text",
          "name": "po_type"
        },
        {
          "type": "number",
          "name": "transfer_source_department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "text",
          "name": "source_department_name"
        },
        {
          "type": "number",
          "name": "source_department_id"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        }
      ],
      "outputType": "array"
    },
    "list_tos_out": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "datetime",
          "name": "time_ordered"
        },
        {
          "type": "datetime",
          "name": "time_approved"
        },
        {
          "type": "text",
          "name": "po_status"
        },
        {
          "type": "text",
          "name": "po_notes"
        },
        {
          "type": "datetime",
          "name": "po_need_by_date"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "vendor_name"
        },
        {
          "type": "number",
          "name": "servo_users_user_received_id"
        },
        {
          "type": "text",
          "name": "po_type"
        },
        {
          "type": "number",
          "name": "transfer_source_department_id"
        },
        {
          "type": "text",
          "name": "department_name"
        },
        {
          "type": "text",
          "name": "source_department_name"
        },
        {
          "type": "number",
          "name": "source_department_id"
        },
        {
          "type": "number",
          "name": "department_id"
        },
        {
          "type": "number",
          "name": "servo_departments_department_id"
        }
      ],
      "outputType": "array"
    }
  },
  "ServoCashier": {
    "amountTendered": {
      "meta": null,
      "outputType": "text"
    },
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_order"
      }
    ],
    "repeat1": {
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
          ]
        }
      ],
      "outputType": "object"
    },
    "query": [
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "offset"
      }
    ],
    "tableRepeat2": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "name": "order_item_id",
          "type": "number"
        },
        {
          "name": "order_time_ordered",
          "type": "datetime"
        },
        {
          "name": "order_time_ready",
          "type": "datetime"
        },
        {
          "name": "order_time_delivered",
          "type": "datetime"
        },
        {
          "name": "order_item_status",
          "type": "text"
        },
        {
          "name": "servo_orders_order_id",
          "type": "number"
        },
        {
          "name": "servo_products_product_id",
          "type": "number"
        },
        {
          "name": "servo_user_user_prepared_id",
          "type": "number"
        },
        {
          "name": "order_item_notes",
          "type": "file"
        },
        {
          "name": "order_item_quantity",
          "type": "text"
        },
        {
          "name": "order_item_price",
          "type": "text"
        },
        {
          "name": "order_item_discount",
          "type": "number"
        },
        {
          "name": "order_time_processing",
          "type": "datetime"
        },
        {
          "name": "order_item_type",
          "type": "file"
        },
        {
          "name": "servo_users_user_ordered",
          "type": "number"
        },
        {
          "name": "order_item_group_type",
          "type": "file"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "order_item_group_id",
          "type": "number"
        },
        {
          "name": "order_item_group_reference",
          "type": "text"
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
          "name": "product_reference_uom",
          "type": "file"
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
          "name": "order_id",
          "type": "number"
        },
        {
          "name": "order_time",
          "type": "datetime"
        },
        {
          "name": "order_customer",
          "type": "number"
        },
        {
          "name": "order_discount",
          "type": "number"
        },
        {
          "name": "order_status",
          "type": "text"
        },
        {
          "name": "servo_user_user_id",
          "type": "number"
        },
        {
          "name": "servo_customer_table_table_id",
          "type": "number"
        },
        {
          "name": "order_notes",
          "type": "file"
        },
        {
          "name": "servo_shift_shift_id",
          "type": "number"
        },
        {
          "name": "order_amount_tendered",
          "type": "number"
        },
        {
          "name": "order_balance",
          "type": "number"
        },
        {
          "name": "servo_users_cashier_id",
          "type": "number"
        },
        {
          "name": "servo_payment_methods_payment_method",
          "type": "number"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "servo_service_service_id",
          "type": "number"
        },
        {
          "name": "coverage_percentage",
          "type": "number"
        },
        {
          "name": "coverage_partner",
          "type": "number"
        },
        {
          "name": "coverage_payment_status",
          "type": "file"
        },
        {
          "name": "order_time_paid",
          "type": "datetime"
        },
        {
          "name": "order_extra_info",
          "type": "file"
        },
        {
          "name": "order_pos",
          "type": "number"
        },
        {
          "name": "Volume",
          "type": "text"
        },
        {
          "name": "Total",
          "type": "text"
        }
      ],
      "outputType": "text"
    },
    "stockvals": {
      "meta": [
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "product_id",
          "type": "number"
        },
        {
          "name": "product_min_stock",
          "type": "number"
        },
        {
          "name": "TotalStock",
          "type": "number"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat4": {
      "meta": [
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "SUM(order_item_quantity)",
          "type": "text"
        },
        {
          "name": "sum(order_item_quantity * order_item_price)",
          "type": "text"
        }
      ],
      "outputType": "text"
    },
    "cookies": [
      {
        "type": "text",
        "name": "servotheme"
      }
    ],
    "tableRepeat7": {
      "meta": [
        {
          "name": "order_item_id",
          "type": "number"
        },
        {
          "name": "order_time_ordered",
          "type": "datetime"
        },
        {
          "name": "order_time_ready",
          "type": "datetime"
        },
        {
          "name": "order_time_delivered",
          "type": "datetime"
        },
        {
          "name": "order_item_status",
          "type": "text"
        },
        {
          "name": "servo_orders_order_id",
          "type": "number"
        },
        {
          "name": "servo_products_product_id",
          "type": "number"
        },
        {
          "name": "servo_user_user_prepared_id",
          "type": "number"
        },
        {
          "name": "order_item_notes",
          "type": "file"
        },
        {
          "name": "order_item_quantity",
          "type": "text"
        },
        {
          "name": "order_item_price",
          "type": "text"
        },
        {
          "name": "order_item_discount",
          "type": "number"
        },
        {
          "name": "order_time_processing",
          "type": "datetime"
        },
        {
          "name": "order_item_type",
          "type": "file"
        },
        {
          "name": "servo_users_user_ordered",
          "type": "number"
        },
        {
          "name": "order_item_group_type",
          "type": "file"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "order_item_group_id",
          "type": "number"
        },
        {
          "name": "order_item_group_reference",
          "type": "text"
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
          "name": "product_reference_uom",
          "type": "file"
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
          "name": "order_id",
          "type": "number"
        },
        {
          "name": "order_time",
          "type": "datetime"
        },
        {
          "name": "order_customer",
          "type": "number"
        },
        {
          "name": "order_discount",
          "type": "number"
        },
        {
          "name": "order_status",
          "type": "text"
        },
        {
          "name": "servo_user_user_id",
          "type": "number"
        },
        {
          "name": "servo_customer_table_table_id",
          "type": "number"
        },
        {
          "name": "order_notes",
          "type": "file"
        },
        {
          "name": "servo_shift_shift_id",
          "type": "number"
        },
        {
          "name": "order_amount_tendered",
          "type": "number"
        },
        {
          "name": "order_balance",
          "type": "number"
        },
        {
          "name": "servo_users_cashier_id",
          "type": "number"
        },
        {
          "name": "servo_payment_methods_payment_method",
          "type": "number"
        },
        {
          "name": "servo_departments_department_id",
          "type": "number"
        },
        {
          "name": "servo_service_service_id",
          "type": "number"
        },
        {
          "name": "coverage_percentage",
          "type": "number"
        },
        {
          "name": "coverage_partner",
          "type": "number"
        },
        {
          "name": "coverage_payment_status",
          "type": "file"
        },
        {
          "name": "order_time_paid",
          "type": "datetime"
        },
        {
          "name": "order_extra_info",
          "type": "file"
        },
        {
          "name": "order_pos",
          "type": "number"
        },
        {
          "name": "Volume",
          "type": "text"
        },
        {
          "name": "Total",
          "type": "text"
        }
      ],
      "outputType": "text"
    }
  },
  "products": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_user"
      },
      {
        "type": "text",
        "name": "user_profile"
      },
      {
        "type": "text",
        "name": "current_shift"
      },
      {
        "type": "text",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "user_department"
      },
      {
        "type": "text",
        "name": "user_department_id"
      },
      {
        "type": "text",
        "name": "assigned_department"
      },
      {
        "type": "number",
        "name": "current_customer"
      },
      {
        "type": "text",
        "name": "current_project"
      }
    ],
    "assigned_department": {
      "meta": null,
      "outputType": "number"
    },
    "purchasesVolume": {
      "outputType": "number"
    },
    "query": [
      {
        "type": "text",
        "name": "offset_gugr_projects"
      },
      {
        "type": "text",
        "name": "limit_gugr_projects"
      },
      {
        "type": "text",
        "name": "sort_gugr_projects"
      },
      {
        "type": "text",
        "name": "limit_groups"
      },
      {
        "type": "text",
        "name": "offset_gugr_projects_projects"
      },
      {
        "type": "text",
        "name": "offset_group_product"
      },
      {
        "type": "text",
        "name": "dir_gugr_projects"
      },
      {
        "type": "text",
        "name": "offset_all_tasks"
      },
      {
        "type": "text",
        "name": "offset_gugr_project_tasks"
      },
      {
        "type": "text",
        "name": "sort_gugr_project_tasks"
      },
      {
        "type": "text",
        "name": "dir_gugr_project_tasks"
      },
      {
        "type": "text",
        "name": "dir_gugr_projects_projects"
      },
      {
        "type": "text",
        "name": "sort_gugr_projects_projects"
      }
    ],
    "repeat1": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "task_id"
        },
        {
          "type": "datetime",
          "name": "task_start"
        },
        {
          "type": "datetime",
          "name": "task_stop"
        },
        {
          "type": "number",
          "name": "task_user_created"
        },
        {
          "type": "number",
          "name": "task_user_concerned"
        },
        {
          "type": "text",
          "name": "task_notes"
        },
        {
          "type": "text",
          "name": "task_status"
        },
        {
          "type": "datetime",
          "name": "task_date_created"
        },
        {
          "type": "number",
          "name": "userCreatedID"
        },
        {
          "type": "text",
          "name": "userCratedName"
        },
        {
          "type": "number",
          "name": "userConcernedID"
        },
        {
          "type": "text",
          "name": "userConcernedName"
        },
        {
          "type": "text",
          "name": "task_description"
        },
        {
          "type": "datetime",
          "name": "task_date_completed"
        }
      ],
      "outputType": "array"
    },
    "repeatProjectNotes": {
      "meta": [
        {
          "type": "number",
          "name": "project_note_id"
        },
        {
          "type": "text",
          "name": "project_note"
        },
        {
          "type": "number",
          "name": "project_note_user_created"
        },
        {
          "type": "datetime",
          "name": "date_created"
        },
        {
          "type": "number",
          "name": "project_note_project_id"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat1": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "project_id"
        },
        {
          "type": "text",
          "name": "project_code"
        },
        {
          "type": "number",
          "name": "project_user_created"
        },
        {
          "type": "text",
          "name": "project_status"
        },
        {
          "type": "datetime",
          "name": "project_date_created"
        },
        {
          "type": "datetime",
          "name": "project_date_due"
        },
        {
          "type": "number",
          "name": "project_step_id"
        },
        {
          "type": "text",
          "name": "step_status"
        },
        {
          "type": "datetime",
          "name": "step_end_date"
        },
        {
          "type": "text",
          "name": "step_description"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat5": {
      "meta": [
        {
          "type": "number",
          "name": "project_id"
        },
        {
          "type": "text",
          "name": "project_code"
        },
        {
          "type": "number",
          "name": "project_user_created"
        },
        {
          "type": "text",
          "name": "project_status"
        },
        {
          "type": "datetime",
          "name": "project_date_created"
        },
        {
          "type": "datetime",
          "name": "project_date_due"
        },
        {
          "type": "number",
          "name": "project_step_id"
        },
        {
          "type": "text",
          "name": "step_status"
        },
        {
          "type": "datetime",
          "name": "step_end_date"
        },
        {
          "type": "text",
          "name": "step_description"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat6": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "project_id"
        },
        {
          "type": "number",
          "name": "project_user_created"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "text",
          "name": "project_status"
        },
        {
          "type": "datetime",
          "name": "project_date_created"
        },
        {
          "type": "datetime",
          "name": "project_date_due"
        },
        {
          "type": "text",
          "name": "project_notes"
        },
        {
          "type": "text",
          "name": "project_code"
        },
        {
          "type": "text",
          "name": "userConcerned_fname"
        },
        {
          "type": "text",
          "name": "userConcerned_lname"
        },
        {
          "type": "text",
          "name": "userConcerned_username"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat2": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "type": "number",
          "name": "project_id"
        },
        {
          "type": "number",
          "name": "project_user_created"
        },
        {
          "type": "text",
          "name": "user_profile"
        },
        {
          "type": "text",
          "name": "project_status"
        },
        {
          "type": "datetime",
          "name": "project_date_created"
        },
        {
          "type": "datetime",
          "name": "project_date_due"
        },
        {
          "type": "text",
          "name": "project_notes"
        },
        {
          "type": "text",
          "name": "project_code"
        },
        {
          "type": "text",
          "name": "userConcerned_fname"
        },
        {
          "type": "text",
          "name": "userConcerned_lname"
        },
        {
          "type": "text",
          "name": "userConcerned_username"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "project_type"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat7": {
      "meta": [
        {
          "type": "number",
          "name": "task_id"
        },
        {
          "type": "datetime",
          "name": "task_start"
        },
        {
          "type": "datetime",
          "name": "task_stop"
        },
        {
          "type": "number",
          "name": "task_user_created"
        },
        {
          "type": "number",
          "name": "task_user_concerned"
        },
        {
          "type": "text",
          "name": "task_notes"
        },
        {
          "type": "text",
          "name": "task_status"
        },
        {
          "type": "datetime",
          "name": "task_date_created"
        },
        {
          "type": "number",
          "name": "userCreatedID"
        },
        {
          "type": "text",
          "name": "userCratedName"
        },
        {
          "type": "number",
          "name": "userConcernedID"
        },
        {
          "type": "text",
          "name": "userConcernedName"
        },
        {
          "type": "text",
          "name": "task_description"
        },
        {
          "type": "datetime",
          "name": "task_date_completed"
        }
      ],
      "outputType": "array"
    },
    "tableRepeat8": {
      "meta": [
        {
          "type": "number",
          "name": "task_id"
        },
        {
          "type": "datetime",
          "name": "task_start"
        },
        {
          "type": "datetime",
          "name": "task_stop"
        },
        {
          "type": "number",
          "name": "task_user_created"
        },
        {
          "type": "number",
          "name": "task_user_concerned"
        },
        {
          "type": "text",
          "name": "task_notes"
        },
        {
          "type": "text",
          "name": "task_status"
        },
        {
          "type": "datetime",
          "name": "task_date_created"
        },
        {
          "type": "number",
          "name": "userCreatedID"
        },
        {
          "type": "text",
          "name": "userCratedName"
        },
        {
          "type": "number",
          "name": "userConcernedID"
        },
        {
          "type": "text",
          "name": "userConcernedName"
        },
        {
          "type": "text",
          "name": "task_description"
        },
        {
          "type": "datetime",
          "name": "task_date_completed"
        }
      ],
      "outputType": "array"
    },
    "productPricesTable1": {
      "meta": [
        {
          "type": "number",
          "name": "uom_multiple_id"
        },
        {
          "type": "number",
          "name": "uom_product_id"
        },
        {
          "type": "text",
          "name": "uom_name"
        },
        {
          "type": "number",
          "name": "uom_reference_multiple"
        }
      ],
      "outputType": "array"
    }
  },
  "TestPage": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "marker1Lat"
      },
      {
        "type": "text",
        "name": "marker1Lon"
      },
      {
        "type": "text",
        "name": "current_marker"
      }
    ]
  },
  "servoHeader": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_shift"
      }
    ]
  },
  "operators": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_customer"
      },
      {
        "type": "text",
        "name": "current_vendor"
      },
      {
        "type": "text",
        "name": "current_asset"
      },
      {
        "type": "text",
        "name": "current_order"
      },
      {
        "type": "text",
        "name": "current_data_reading_session"
      },
      {
        "type": "text",
        "name": "setup_status"
      },
      {
        "type": "text",
        "name": "user_id"
      }
    ],
    "query": [
      {
        "type": "text",
        "name": "asset_id"
      },
      {
        "type": "text",
        "name": "sort_assets"
      },
      {
        "type": "text",
        "name": "dir_assets"
      }
    ],
    "repeatdatafields": {
      "meta": [
        {
          "type": "number",
          "name": "data_field_reading_id"
        },
        {
          "type": "number",
          "name": "data_field_reading_data_field"
        },
        {
          "type": "datetime",
          "name": "data_field_reading_date"
        },
        {
          "type": "number",
          "name": "data_field_reading_value"
        },
        {
          "type": "number",
          "name": "data_field_reading_user"
        },
        {
          "type": "text",
          "name": "data_field_reading_note"
        },
        {
          "type": "number",
          "name": "data_reading_session_id"
        }
      ],
      "outputType": "array"
    },
    "repeatfieldsandvalues": {
      "meta": [
        {
          "type": "number",
          "name": "data_field_reading_id"
        },
        {
          "type": "number",
          "name": "data_field_reading_data_field"
        },
        {
          "type": "datetime",
          "name": "data_field_reading_date"
        },
        {
          "type": "number",
          "name": "data_field_reading_value"
        },
        {
          "type": "number",
          "name": "data_field_reading_user"
        },
        {
          "type": "text",
          "name": "data_field_reading_note"
        },
        {
          "type": "number",
          "name": "data_reading_session_id"
        },
        {
          "type": "number",
          "name": "data_field_id"
        },
        {
          "type": "text",
          "name": "data_field_name"
        },
        {
          "type": "text",
          "name": "data_field_unit"
        },
        {
          "type": "datetime",
          "name": "data_reading_session_date"
        },
        {
          "type": "number",
          "name": "data_reading_session_user"
        },
        {
          "type": "number",
          "name": "data_reading_session_customer"
        },
        {
          "type": "text",
          "name": "data_reading_session_notes"
        },
        {
          "type": "number",
          "name": "data_reading_session_asset"
        }
      ],
      "outputType": "array"
    },
    "variableOrderDiscount": {
      "meta": null,
      "outputType": "number"
    },
    "variableOrderCoverage": {
      "meta": null,
      "outputType": "number"
    },
    "variableCustomerTotalToPay": {
      "meta": null,
      "outputType": "object"
    },
    "variableTotalCustomerDebt": {
      "meta": null,
      "outputType": "object"
    },
    "variableOrderPaid": {
      "meta": null,
      "outputType": "text"
    },
    "variableOrderCoverageTotal": {
      "meta": null,
      "outputType": "number"
    },
    "variableOrderCoveragePaid": {
      "meta": null,
      "outputType": "text"
    },
    "variableOrderCoverageOwing": {
      "meta": null,
      "outputType": "text"
    },
    "tableCustomerAssets": {
      "meta": [
        {
          "type": "number",
          "name": "asset_id"
        },
        {
          "type": "text",
          "name": "asset_name"
        },
        {
          "type": "text",
          "name": "asset_lat"
        },
        {
          "type": "text",
          "name": "asset_long"
        },
        {
          "type": "number",
          "name": "asset_owner"
        },
        {
          "type": "datetime",
          "name": "date_created"
        },
        {
          "type": "number",
          "name": "user_created"
        }
      ],
      "outputType": "array"
    },
    "global": [
      {
        "type": "text",
        "name": "current_user"
      }
    ],
    "tableRepeat1": {
      "meta": [
        {
          "type": "number",
          "name": "file_id"
        },
        {
          "type": "number",
          "name": "file_customer_id"
        },
        {
          "type": "number",
          "name": "file_asset_id"
        },
        {
          "type": "number",
          "name": "file_order_id"
        },
        {
          "type": "number",
          "name": "file_transaction_id"
        },
        {
          "type": "text",
          "name": "file_name"
        },
        {
          "type": "number",
          "name": "file_user_created"
        },
        {
          "type": "datetime",
          "name": "file_date_created"
        },
        {
          "type": "text",
          "name": "file_description"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        }
      ],
      "outputType": "array"
    }
  },
  "printPlaque": {
    "query": [
      {
        "type": "text",
        "name": "asset"
      }
    ],
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_asset"
      }
    ]
  },
  "servoheader": {},
  "gugrLogin": {
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_user"
      },
      {
        "type": "text",
        "name": "user_id"
      },
      {
        "type": "text",
        "name": "current_asset"
      },
      {
        "type": "number",
        "name": "current_customer"
      }
    ],
    "assetId": {
      "meta": null,
      "outputType": "number"
    },
    "query": [
      {
        "type": "number",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "walletTransactions"
      }
    ],
    "totalDepositSettlements": {
      "meta": null,
      "outputType": "number"
    },
    "totalPayments": {
      "meta": null,
      "outputType": "number"
    },
    "totalSettlements": {
      "meta": null,
      "outputType": "number"
    },
    "repeatOptions3": {
      "meta": [
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "TotalStock",
          "type": "text"
        }
      ],
      "outputType": "text"
    },
    "totalDeposits": {
      "meta": null,
      "outputType": "number"
    },
    "totalTransfersInPerWallet": {
      "meta": null,
      "outputType": "number"
    },
    "totalPaymentsPerWallet": {
      "meta": null,
      "outputType": "number"
    },
    "repeat1": {
      "meta": [
        {
          "type": "number",
          "name": "order_id"
        }
      ],
      "outputType": "array"
    }
  },
  "testing": {
    "cookies": [
      {
        "type": "text",
        "name": "theme"
      }
    ]
  },
  "cashier": {
    "query": [
      {
        "type": "text",
        "name": "customerOrdersOffset"
      },
      {
        "type": "text",
        "name": "orders_sort"
      },
      {
        "type": "text",
        "name": "orders_dir"
      },
      {
        "type": "text",
        "name": "listDataOffset"
      }
    ],
    "sessionStorage": [
      {
        "type": "text",
        "name": "current_customer"
      }
    ],
    "variableCustomerTotalToPay": {
      "outputType": "number"
    }
  },
  "Customers": {
    "query": [
      {
        "type": "text",
        "name": "customerTransactionsOffset"
      }
    ]
  },
  "index": {
    "cookies": [
      {
        "type": "text",
        "name": "cookie1"
      }
    ]
  },
  "brands": {
    "query": [
      {
        "type": "text",
        "name": "ListTransactionsLimit"
      },
      {
        "type": "text",
        "name": "ListTransactionsOffset"
      }
    ]
  },
  "dmanager": {
    "products": {
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
      "outputType": "array"
    },
    "tableRepeat12": {
      "meta": [
        {
          "name": "old_value",
          "type": "text"
        },
        {
          "name": "new_value",
          "type": "text"
        },
        {
          "name": "updated_order_item_id",
          "type": "number"
        },
        {
          "name": "updated_value",
          "type": "text"
        },
        {
          "name": "updated_time",
          "type": "datetime"
        },
        {
          "name": "product_name",
          "type": "text"
        },
        {
          "name": "user_username",
          "type": "text"
        },
        {
          "name": "product_min_stock",
          "type": "number"
        }
      ],
      "outputType": "text"
    },
    "tableRepeat9": {
      "meta": [
        {
          "type": "number",
          "name": "po_item_delete_id"
        },
        {
          "type": "number",
          "name": "po_item_id"
        },
        {
          "type": "number",
          "name": "po_id"
        },
        {
          "type": "number",
          "name": "po_item_quantity"
        },
        {
          "type": "number",
          "name": "po_item_price"
        },
        {
          "type": "number",
          "name": "po_user_deleted"
        },
        {
          "type": "datetime",
          "name": "po_item_time_deleted"
        },
        {
          "type": "number",
          "name": "po_item_deleted_product_id"
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
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        }
      ],
      "outputType": "array"
    },
    "poTotal": {
      "meta": null,
      "outputType": "text"
    },
    "poTotalOwing": {
      "outputType": "number"
    },
    "poTotalPaid": {
      "meta": null,
      "outputType": "text"
    },
    "tableRepeat5": {
      "meta": [
        {
          "type": "number",
          "name": "vendor_transaction_id"
        },
        {
          "type": "number",
          "name": "transaction_amount"
        },
        {
          "type": "text",
          "name": "transaction_type"
        },
        {
          "type": "number",
          "name": "user_approved_id"
        },
        {
          "type": "datetime",
          "name": "transaction_date"
        },
        {
          "type": "number",
          "name": "transaction_payment_method"
        },
        {
          "type": "text",
          "name": "transaction_status"
        },
        {
          "type": "text",
          "name": "transaction_note"
        },
        {
          "type": "number",
          "name": "transaction_order"
        },
        {
          "type": "number",
          "name": "transaction_balance"
        },
        {
          "type": "number",
          "name": "transaction_amount_tendered"
        },
        {
          "type": "number",
          "name": "transaction_user_received"
        },
        {
          "type": "number",
          "name": "transaction_department_received"
        },
        {
          "type": "number",
          "name": "transaction_vendor_id"
        },
        {
          "type": "number",
          "name": "user_id"
        },
        {
          "type": "text",
          "name": "user_fname"
        },
        {
          "type": "text",
          "name": "user_lname"
        },
        {
          "type": "text",
          "name": "user_username"
        },
        {
          "type": "text",
          "name": "payment_method_name"
        }
      ],
      "outputType": "array"
    },
    "pageName": {
      "meta": null,
      "outputType": "text"
    }
  }
});
