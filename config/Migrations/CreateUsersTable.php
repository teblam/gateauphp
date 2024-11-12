<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change(): void
    {
        // Création de la table `users`
        $table = $this->table('users');
        
        // Ajout des colonnes
        $table->addColumn('actif', 'boolean', [
            'default' => 1,
            'null' => false,
            'comment' => 'Statut actif/inactif',
        ]);
        
        $table->addColumn('nom', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => 'Nom de l\'utilisateur',
        ]);
        
        $table->addColumn('prenom', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => 'Prénom de l\'utilisateur',
        ]);
        
        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
            'unique' => true,
            'comment' => 'Email de l\'utilisateur',
        ]);
        
        $table->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
            'comment' => 'Mot de passe de l\'utilisateur',
        ]);
        
        $table->addColumn('observation', 'string', [
            'limit' => 255,
            'null' => true,
            'comment' => 'Observations sur l\'utilisateur',
        ]);
        
        // Colonnes de timestamps pour `created` et `modified`
        $table->addTimestamps('created', 'modified');

        // Création de la table
        $table->create();
    }
}