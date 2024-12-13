<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "role_id"
      },
      {
        "type": "text",
        "name": "search_text"
      },
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "number",
        "name": "limit"
      },
      {
        "type": "number",
        "name": "current_page"
      }
    ],
    "$_SESSION": [
      {
        "type": "text",
        "name": "user_permissions"
      }
    ]
  },
  "exec": {
    "steps": [
      "lib/permission_check/resource/role/roleRead",
      {
        "name": "pag",
        "module": "arraylist",
        "action": "create",
        "options": {},
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "currentPage",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{$_GET.current_page.toNumber()}}"
        },
        "meta": [],
        "outputType": "number"
      },
      {
        "name": "num_row",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT COUNT(servo_user.user_id) as total from servo_user inner join servo_role_user on servo_role_user.user_id = servo_user.user_id\n\nwhere servo_role_user.role_id = :P1\n  ",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": "1"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "total",
            "type": "text"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "totalPage",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{(num_row[0].total / $_GET.limit).ceil()}}"
        },
        "meta": [],
        "outputType": "text",
        "output": true
      },
      {
        "name": "",
        "module": "arraylist",
        "action": "add",
        "options": {
          "ref": "pag",
          "value": 1
        }
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{currentPage-2>=1}}",
          "then": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{currentPage-2==1}}",
                "then": {
                  "steps": {
                    "name": "leftLag_copy",
                    "module": "core",
                    "action": "setvalue",
                    "options": {
                      "value": 0
                    },
                    "meta": [],
                    "outputType": "boolean"
                  }
                },
                "else": {
                  "steps": [
                    {
                      "name": "",
                      "module": "arraylist",
                      "action": "add",
                      "options": {
                        "ref": "pag",
                        "value": "{{currentPage-2}}"
                      }
                    },
                    {
                      "name": "currentPageMin2",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "value": "{{currentPage-2}}"
                      },
                      "meta": [],
                      "outputType": "number",
                      "output": true,
                      "disabled": true
                    }
                  ]
                }
              },
              "outputType": "boolean"
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{currentPage-1>=1}}",
          "then": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{currentPage-1==1}}",
                "then": {
                  "steps": {
                    "name": "leftLag",
                    "module": "core",
                    "action": "setvalue",
                    "options": {
                      "value": 0
                    },
                    "meta": [],
                    "outputType": "boolean"
                  }
                },
                "else": {
                  "steps": [
                    {
                      "name": "",
                      "module": "arraylist",
                      "action": "add",
                      "options": {
                        "ref": "pag",
                        "value": "{{currentPage-1}}"
                      }
                    },
                    {
                      "name": "currentPageMin1",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "value": "{{currentPage-1}}"
                      },
                      "meta": [],
                      "outputType": "number",
                      "output": true,
                      "disabled": true
                    }
                  ]
                }
              },
              "outputType": "boolean"
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{(currentPage!=1 && currentPage!=totalPage)}}",
          "then": {
            "steps": {
              "name": "",
              "module": "arraylist",
              "action": "add",
              "options": {
                "ref": "pag",
                "value": "{{currentPage}}"
              }
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{currentPage+1<=totalPage}}",
          "then": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{currentPage+1==totalPage}}",
                "then": {
                  "steps": {
                    "name": "rightLag",
                    "module": "core",
                    "action": "setvalue",
                    "options": {
                      "value": 0
                    },
                    "meta": [],
                    "outputType": "boolean"
                  }
                },
                "else": {
                  "steps": [
                    {
                      "name": "",
                      "module": "arraylist",
                      "action": "add",
                      "options": {
                        "ref": "pag",
                        "value": "{{currentPage+1}}"
                      }
                    },
                    {
                      "name": "currentPage1",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "value": "{{currentPage+1}}"
                      },
                      "meta": [],
                      "outputType": "number",
                      "output": true,
                      "disabled": true
                    }
                  ]
                }
              },
              "outputType": "boolean"
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{currentPage+2<=totalPage}}",
          "then": {
            "steps": {
              "name": "",
              "module": "core",
              "action": "condition",
              "options": {
                "if": "{{currentPage+2==totalPage}}",
                "then": {
                  "steps": {
                    "name": "rightLag_copy",
                    "module": "core",
                    "action": "setvalue",
                    "options": {
                      "value": 0
                    },
                    "meta": [],
                    "outputType": "boolean"
                  }
                },
                "else": {
                  "steps": [
                    {
                      "name": "",
                      "module": "arraylist",
                      "action": "add",
                      "options": {
                        "ref": "pag",
                        "value": "{{currentPage+2}}"
                      }
                    },
                    {
                      "name": "currentPage2",
                      "module": "core",
                      "action": "setvalue",
                      "options": {
                        "value": "{{currentPage+2}}"
                      },
                      "meta": [],
                      "outputType": "number",
                      "output": true,
                      "disabled": true
                    }
                  ]
                }
              },
              "outputType": "boolean"
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{totalPage!=1&&totalPage!=0}}",
          "then": {
            "steps": {
              "name": "",
              "module": "arraylist",
              "action": "add",
              "options": {
                "ref": "pag",
                "value": "{{totalPage}}"
              }
            }
          }
        },
        "outputType": "boolean"
      },
      {
        "name": "pagination",
        "module": "arraylist",
        "action": "value",
        "options": {
          "ref": "pag"
        },
        "output": true,
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "paginated_query",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "servodb",
          "sql": {
            "query": "SELECT servo_user.user_id,servo_user.user_fname, servo_user.user_lname \nfrom servo_user \ninner join servo_role_user \non servo_role_user.user_id = servo_user.user_id\nwhere servo_role_user.role_id = :P1\nAND (servo_user.user_fname LIKE :P2 OR servo_user.user_lname LIKE :P2)\nLIMIT :limit\nOFFSET :offset\n  ",
            "params": [
              {
                "name": ":P1",
                "value": "{{$_GET.role_id}}",
                "test": "1"
              },
              {
                "name": ":P2",
                "value": "{{'%'+$_GET.search_text+'%'}}",
                "test": "N"
              },
              {
                "name": ":limit",
                "value": "{{$_GET.limit}}",
                "test": "5"
              },
              {
                "name": ":offset",
                "value": "{{$_GET.offset}}",
                "test": "1"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "user_id",
            "type": "number"
          },
          {
            "name": "user_fname",
            "type": "text"
          },
          {
            "name": "user_lname",
            "type": "text"
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