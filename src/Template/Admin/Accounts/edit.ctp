<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
$this->extend('/Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $account->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $account->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Accounts'), ['action' => 'index']) ?></li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $account->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $account->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Accounts'), ['action' => 'index']) ?></li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($account); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Account']) ?></legend>
    <?php
    echo $this->Form->control('name');
    echo $this->Form->control('description');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
