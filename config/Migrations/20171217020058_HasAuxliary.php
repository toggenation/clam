<?php
use Migrations\AbstractMigration;

class HasAuxliary extends AbstractMigration
{

    public function up()
    {

        $this->table('parts')
            ->addColumn('has_auxiliary', 'boolean', [
                'after' => 'link_to',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('parts')
            ->removeColumn('has_auxiliary')
            ->update();
    }
}

