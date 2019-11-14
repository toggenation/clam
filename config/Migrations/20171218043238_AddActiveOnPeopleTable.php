<?php
use Migrations\AbstractMigration;

class AddActiveOnPeopleTable extends AbstractMigration
{

    public function up()
    {

        $this->table('people')
            ->addColumn('active', 'boolean', [
                'after' => 'modified',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('people')
            ->removeColumn('active')
            ->update();
    }
}

