<?php
$urlToCarsAutocompleteCityJson = $this->Url->build([
    "controller" => "Cities",
    "action" => "findCities",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToCarsAutocompleteCityJson . '";', ['block' => true]);
echo $this->Html->script('Cities/autocompleteCity', ['block' => 'scriptBottom']);
?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<?= $this->Form->create('Cities') ?>
<fieldset>
    <legend><?= __('Search City') ?></legend>
    <?php
    echo $this->Form->input('name', ['id' => 'autocomplete']);
    ?>
</fieldset>
<?= $this->Form->end() ?>