<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class MenusSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'ordre' => 1,
                'intitule' => 'Utilisateurs',
                'lien' => '/users/index',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'ordre' => 2,
                'intitule' => 'Menu',
                'lien' => '/menus/index',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]
        ];

        $table = $this->table('menus');
        $table->insert($data)->save();
    }
} 