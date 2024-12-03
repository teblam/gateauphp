<div class="users form content">
    <?= $this->Form->create(null, ['url' => ['action' => 'forgotPassword']]) ?>
    <fieldset>
        <legend><?= __('Mot de passe oublié') ?></legend>
        <?= $this->Form->control('email', ['type' => 'email', 'label' => 'Votre email']) ?>
    </fieldset>
    <?= $this->Form->button(__('Envoyer le nouveau mot de passe')); ?>
    <?= $this->Form->end() ?>
</div>