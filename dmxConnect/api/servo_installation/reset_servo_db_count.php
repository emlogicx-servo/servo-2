<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "reset_table_product_discount",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_discount AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_categories",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_categories AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_brands",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_brands AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_has_product_categories",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_products_has_servo_product_categories AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_branches",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_branches AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_5_profile",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_user_profile AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array",
    "disabled": true
  },
  {
    "name": "reset_table_user_profile",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_user_profile AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array",
    "disabled": true
  },
  {
    "name": "reset_table_user_tenure",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_user_tenure AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_login_session",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_login_session AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_shifts",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_shifts AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_department_categories",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_department_categories AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_purchase_order_items",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_purchase_order_items AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_payment_methods",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_payment_methods AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_servo_company_info",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_company_info AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_stock_movement",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_stock_movement AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_order_item_deletes",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_order_item_deletes AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_category_options",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_category_options AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_group_items",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_group_items AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_sales_point",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_sales_point AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_sales_point_departments",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_sales_point_departments AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_price",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_price AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_services",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_services AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_service_department_category",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_service_department_category AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_order_items",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_order_items AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_user_shifts",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_user_shifts AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_product_groups",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_product_groups AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_customers",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_customers AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_vendors",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_vendors AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_products",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_products AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_purchase_orders",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_purchase_orders AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_customer_table",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_customer_table AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_customer_cash_transaction",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_customer_cash_transaction AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "reset_table_orders",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "ALTER TABLE servo_orders AUTO_INCREMENT = 1;\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  }
]
JSON
);
?>