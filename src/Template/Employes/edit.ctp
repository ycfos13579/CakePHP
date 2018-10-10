<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employe $enterprise
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employe->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employe->id)]
            )
        ?></li>
        <br/>
        <li><?= $this->Html->link(__('List Employes'), ['controller' => 'Employes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="enterprises form large-9 medium-8 columns content">
    <?= $this->Form->create($employe) ?>
    <fieldset>
        <legend><?= __('Edit Employe') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('adress');
            echo $this->Form->control('city');
            echo $this->Form->control('province');
            echo $this->Form->control('postal_code');
            echo $this->Form->control('region');
            echo $this->Form->control('additional_informations');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
