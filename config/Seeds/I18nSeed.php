<?php
use Migrations\AbstractSeed;

/**
 * I18n seed.
 */
class I18nSeed extends AbstractSeed
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
                'id' => '5',
                'locale' => 'ar',
                'model' => 'Addresses',
                'foreign_key' => '8',
                'field' => 'title',
                'content' => '287 rue de limoges',
            ],
        ];

        $table = $this->table('i18n');
        $table->insert($data)->save();
    }
}
