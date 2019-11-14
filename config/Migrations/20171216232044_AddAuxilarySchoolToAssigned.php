<?php
use Migrations\AbstractMigration;

class AddAuxilarySchoolToAssigned extends AbstractMigration
{

    public function up()
    {

        $this->table('assigned')
            ->addColumn('aux_person_id', 'integer', [
                'after' => 'assistant_id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('aux_assistant_id', 'integer', [
                'after' => 'aux_person_id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('assigned')
            ->removeColumn('aux_person_id')
            ->removeColumn('aux_assistant_id')
            ->update();
    }
}

