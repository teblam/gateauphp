<nav class="menu-sidebar">
    <?php foreach ($menus as $menu): ?>
        <?= $this->Html->link(
            $menu->intitule,
            $menu->lien,
            ['class' => 'menu-item']
        ) ?>
        <?php echo '<br/>'; ?>
    <?php endforeach; ?>
</nav> 