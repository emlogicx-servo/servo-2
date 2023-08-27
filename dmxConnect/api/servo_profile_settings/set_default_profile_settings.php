<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "custom",
  "module": "dbupdater",
  "action": "custom",
  "options": {
    "connection": "servodb",
    "sql": {
      "query": " REPLACE INTO servo_profile_settings  \n  VALUES ('1','Admin','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes'),\n  ('2','Manager','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','Yes','No'),\n  \n  ('3','Cashier','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n  \n   ('4','Waiter','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n\n('5','Service','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No'),\n\n('6','Support','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No','No');\n\n",
      "params": []
    }
  },
  "output": true,
  "meta": [],
  "outputType": "array"
}
JSON
);
?>