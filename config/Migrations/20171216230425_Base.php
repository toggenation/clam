<?php
use Migrations\AbstractMigration;

class Base extends AbstractMigration
{
    public function up()
    {

        $this->table('assigned')
            ->addColumn('part_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('start_time', 'time', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('minutes', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('part_title', 'string', [
                'default' => null,
                'limit' => 256,
                'null' => false,
            ])
            ->addColumn('meeting_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('assistant_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'meeting_id',
                    'part_id',
                ],
                ['unique' => true]
            )
            ->create();


        $this->table('meeting_notes')
            ->addColumn('meeting_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('heading', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('note', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('meetings')
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('schedule_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('person_id', 'integer', [
                'comment' => 'CLAM Chairman',
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('co_visit', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('parts')
            ->addColumn('active', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('chairman_part', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('co_visit', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('no_assign', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('assistant', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('partname', 'string', [
                'default' => null,
                'limit' => 70,
                'null' => true,
            ])
            ->addColumn('replace_token', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('minutes', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => true,
            ])
            ->addColumn('start_time', 'time', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('min_suffix', 'string', [
                'default' => null,
                'limit' => 15,
                'null' => false,
            ])
            ->addColumn('section_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('counsel_mins', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('link_to', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('parts_roles')
            ->addColumn('part_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->create();

        $this->table('people')
            ->addColumn('brother', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('firstname', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('lastname', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('people_roles')
            ->addColumn('person_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('role_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();

        $this->table('roles')
            ->addColumn('assistant', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('schedules')
            ->addColumn('published', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('start_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('month', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('comment', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->create();

        $this->table('sections')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('heading', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('colour', 'string', [
                'default' => null,
                'limit' => 7,
                'null' => false,
            ])
            ->addColumn('css_class', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->create();

        $this->table('users')
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('assigned');
        $this->dropTable('meeting_notes');
        $this->dropTable('meetings');
        $this->dropTable('parts');
        $this->dropTable('parts_roles');
        $this->dropTable('people');
        $this->dropTable('people_roles');
        $this->dropTable('roles');
        $this->dropTable('schedules');
        $this->dropTable('sections');
        $this->dropTable('users');
    }
}
