<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Gateau</span>PHP 🐗</a>
        </div>
        <div class="top-nav-links">
            <?php 
            $this->loadHelper('Authentication.Identity');
            if ($this->Identity->isLoggedIn()) : ?>
                <span class="user-info">
                    <?= h($this->Identity->get('first_name')) ?> <?= h($this->Identity->get('last_name')) ?>
                </span>
                <?= $this->Html->link('Déconnexion', ['controller' => 'Users', 'action' => 'logout']) ?>
            <?php else : ?>
                <?= $this->Html->link('Connexion', ['controller' => 'Users', 'action' => 'login']) ?>
            <?php endif; ?>
        </div>
    </nav>
    
    <?php if ($this->Identity->isLoggedIn()) : ?>
    <div class="main-container">
        <div id="menu" class="side-menu">
            <?php
            // Récupération des éléments du menu depuis le controller
            $menus = $this->cell('Menu')->render();
            echo $menus;
            ?>
        </div>
        <main class="main-content">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
    <?php endif; ?>
</body>
</html>