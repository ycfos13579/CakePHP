<h1>
    Addresses tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
<?php foreach ($addresses as $address): ?>
    <article>
        <!-- Use the HtmlHelper to create a link -->
        <h4><?= $this->Html->link(
            $address->title,
            ['controller' => 'Addresses', 'action' => 'view', $address->slug]
        ) ?></h4>
        <span><?= h($address->created) ?>
    </article>
<?php endforeach; ?>
</section>
