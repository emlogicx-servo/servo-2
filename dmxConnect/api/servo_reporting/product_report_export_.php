<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "number",
        "name": "user"
      },
      {
        "type": "text",
        "name": "datefrom"
      },
      {
        "type": "text",
        "name": "dateto"
      },
      {
        "type": "text",
        "name": "service"
      }
    ]
  },
  "exec": {
    "steps": {
      "exec": {},
      "options": {}
    }
  }
}
JSON
);
?>