<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  "SecurityProviders/servo_logout",
  {
    "name": "",
    "module": "auth",
    "action": "logout",
    "options": {
      "provider": "servo_logout"
    }
  },
  {
    "name": "localhost",
    "module": "core",
    "action": "removesession",
    "options": {}
  },
  {
    "name": "PHPSESSID",
    "module": "core",
    "action": "removecookie",
    "options": {}
  }
]
JSON
);
?>