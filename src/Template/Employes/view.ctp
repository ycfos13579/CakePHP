<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employe $employe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employe'), ['action' => 'edit', $employe->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employe'), ['action' => 'delete', $employe->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employe->id)]) ?> </li>
        <br/>
        <li><?= $this->Html->link(__('List Employes'), ['controller' => 'Employes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="enterprises view large-9 medium-8 columns content">
    <h3><?= h($employe->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $employe->has('user') ? $this->Html->link($employe->user->id, ['controller' => 'Users', 'action' => 'view', $employe->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($employe->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Adress') ?></th>
            <td><?= h($employe->adress) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($employe->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= h($employe->province) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postal Code') ?></th>
            <td><?= h($employe->postal_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= h($employe->region) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('additional_informations') ?></th>
            <td><?= h($employe->additional_informations) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employe->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $employe->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Addresses') ?></h4>
        <?php if (!empty($employe->internships)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employe Id') ?></th>
                <th scope="col"><?= __('Semester') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Available Places') ?></th>
                <th scope="col"><?= __('Work Hours') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employe->internships as $Addresses): ?>
            <tr>
                <td><?= h($Addresses->id) ?></td>
                <td><?= h($Addresses->enterprise_id) ?></td>
                <td><?= h($Addresses->semester) ?></td>
                <td><?= h($Addresses->start_date) ?></td>
                <td><?= h($Addresses->end_date) ?></td>
                <td><?= h($Addresses->available_places) ?></td>
                <td><?= h($Addresses->work_hours) ?></td>
                <td><?= h($Addresses->title) ?></td>
                <td><?= h($Addresses->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $Addresses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Addresses', 'action' => 'edit', $Addresses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Addresses', 'action' => 'delete', $Addresses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $Addresses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
