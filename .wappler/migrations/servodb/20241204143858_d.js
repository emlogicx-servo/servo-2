
exports.up = function(knex) {
  return knex.schema
    .createTable('servo_permissions', async function (table) {
      table.increments('id');
      table.string('name');
    })

};

exports.down = function(knex) {
  return knex.schema
    .dropTable('servo_permissions')
};
