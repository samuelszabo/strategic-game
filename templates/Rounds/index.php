<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Tables\TablesInterface $table
 * @var \App\Model\Entity\Game $game
 */
?>
<div class="rounds index content">
    <div class="column">
        <h1>Toto treba?</h1>
        <p>Nejaké intro, pozadie firmy <?= h($game->name) ?> </p>
        <?= $this->Html->link(__('Start Game'), ['action' => 'add']) ?>
    </div>
</div>
