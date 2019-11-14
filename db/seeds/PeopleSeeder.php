<?php


use Phinx\Seed\AbstractSeed;

class PeopleSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];



        for ($i = 0; $i < 100; $i++) {
            //id, brother, firstname, lastname, created, modified, active
            $gender = $faker->randomElement(['male', 'female']);

            $data[] = [
                'active' => 1,
                'brother' => $gender === 'male' ? 1 : 0,
                'firstname'    => $faker->firstName($gender),
                'lastname'     => $faker->lastName,
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ];
        }

        $this->insert('people', $data);
    }
}
