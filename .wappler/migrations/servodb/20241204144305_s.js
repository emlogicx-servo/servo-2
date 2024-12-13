
exports.up = function(knex) {
  return knex.schema
    .createTable('role_user', async function (table) {
      table.increments('id');
    })
    .renameTable('servo_role', 'servo_roles')

};

exports.down = function(knex) {
  return knex.schema
    .renameTable('servo_roles', 'servo_role')
    .dropTable('role_user')
};
