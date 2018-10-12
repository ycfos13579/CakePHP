<?php
use Migrations\AbstractSeed;

/**
 * Employes seed.
 */
class EmployesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'user_id' => '33',
                'name' => 'michel shrerer',
                'adress' => '',
                'city' => 'Laval',
                'province' => 'Québec',
                'postal_code' => 'H7M 2Y',
                'region' => 'rive nord',
                'additional_informations' => 'il est malade mentalement le pauvre',
            ],
        ];

        $table = $this->table('employes');
        $table->insert($data)->save();
    }
}
