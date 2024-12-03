<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <br />
    <?= $this->Html->link(__('Mot de passe oublié ?'), ['controller' => 'Users', 'action' => 'forgotPassword'])?>
    <?= $this->Form->end() ?>
</div>