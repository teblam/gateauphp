<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMenusTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('menus');
        
        $table->addColumn('ordre', 'integer', [
            'default' => 0,
            'null' => false,
        ])
        ->addColumn('intitule', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('lien', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->create();
    }
} 