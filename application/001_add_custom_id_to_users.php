<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_custom_id_to_users extends CI_Migration {

    public function up() {
        $fields = array(
            'custom_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '12', // Adjust length according to your needs
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('users', 'custom_id');
    }
}
