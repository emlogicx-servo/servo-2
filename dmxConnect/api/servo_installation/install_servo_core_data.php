<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "create_profiles",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_user_profile VALUES \n(NULL,'Admin'),\n(NULL,'Manager'),\n(NULL,'Support'),\n(NULL,'Cashier'),\n(NULL,'Service'),\n(NULL,'Waiter');",
        "params": []
      }
    },
    "meta": [],
    "outputType": "array",
    "output": true
  },
  {
    "name": "create_department",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_department VALUES ('1', 'Central');",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "create_admin_user",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_user VALUES (NULL, 'Servo', 'Admin', 'admin', 'admin', '1', 'Admin');",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "create_company_info",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_company_info VALUES (NULL, 'Servo', NULL, NULL, NULL, NULL, NULL, NULL);",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "create_payment_methods",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_payment_methods VALUES \n(1, 'Deposit'),\n(2, 'Cash'), \n(3, 'MTN Mobile Money'),\n(4, 'Orange Money'),\n(5, 'Bank Transfer');\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "create_currencies",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": "INSERT INTO servo_currencies VALUES \n(1, 'XAF'),\n(2, 'USD'), \n(3, 'EUR'),\n(4, 'NGN'),\n(5, 'GBP');\n",
        "params": []
      }
    },
    "output": true,
    "meta": [],
    "outputType": "array"
  },
  {
    "name": "set_profile_privileges",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "servodb",
      "sql": {
        "query": " INSERT INTO servo_profile_settings  \n  VALUES ('1','Admin','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes'),\n  ('2','Manager','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','No'),\n  \n  ('3','Cashier','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n  \n   ('4','Waiter','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n\n('5','Service','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n\n('6','Support','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No');\n  \n",
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