<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddFirstNameAndLastNameToUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Applique les modifications pour ajouter les colonnes.
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('first_name', 'string', [
            'limit' => 255,
            'null' => true, // Autorise NULL
        ])
        ->addColumn('last_name', 'string', [
            'limit' => 255,
            'null' => true, // Autorise NULL
        ])
        ->update();
    }
}