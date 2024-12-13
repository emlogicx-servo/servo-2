
exports.up = function(knex) {
  return knex.schema
    .createTable('role_user', async function (table) {
      table.increments('id');
    })
    .createTable('servo_role', async function (table) {
      table.increments('id');
      table.string('name');
    })

};

exports.down = function(knex) {
  return knex.schema
    .dropTable('servo_role')
    .dropTable('role_user')
};
