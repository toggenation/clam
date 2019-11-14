<?php
use Migrations\AbstractMigration;

class AssistantPrefix extends AbstractMigration
{

    public function up()
    {

        $this->table('meetings')
            ->addColumn('auxiliary_counselor_id', 'integer', [
                'after' => 'co_visit',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();

        $this->table('parts')
            ->addColumn('assistant_prefix', 'string', [
                'after' => 'has_auxiliary',
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('meetings')
            ->removeColumn('auxiliary_counselor_id')
            ->update();

        $this->table('parts')
            ->removeColumn('assistant_prefix')
            ->update();
    }
}

