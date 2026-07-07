<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_pemesanan_akomodasi extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_pemesanan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'id_akomodasi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'harga_tambahan' => array(
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id_pemesanan');
        $this->dbforge->add_key('id_akomodasi');
        $this->dbforge->create_table('pemesanan_akomodasi', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('pemesanan_akomodasi', TRUE);
    }
}