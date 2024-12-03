<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Exécute la migration.
     */
    public function change(): void
    {
        $table = $this->table('users');
        
        // Création des colonnes de la table 'users'
        $table->addColumn('first_name', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('last_name', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('username', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('password', 'string', [
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

        // Ajout de l'index unique sur la colonne 'email'
        $this->table('users')
            ->addIndex('email', ['unique' => true])
            ->update();
    }
}