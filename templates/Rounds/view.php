<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 * @var \App\Model\Entity\Game $game
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="view content">
            <h3><?= h($round->number) ?>. kolo</h3>
            <p>Tržby: <?php
                echo $this->Number->currency($round->getEarns());
                ?></p>
            <p>Spokojnosť: <?php
                echo $this->Number->toPercentage($round->getSatisfaction());
                ?></p>
        </div>
        <div class="content">
            <p>Tržby: <?php
                echo $this->Number->currency($game->getEarns());
                ?></p>
            <p>Spokojnosť: <?php
                echo $this->Number->toPercentage($game->getSatisfaction());
                ?></p>
            <?php
            if ($game->nextTable()) {
                echo $this->Html->link('Pokračuj na ďalšie kolo', ['controller' => 'Rounds', 'action' => 'add'], ['class'=>'button']);
            } else {
                echo $this->Html->link('Zobraz celkové skóre', ['controller' => 'Games', 'action' => 'index'], ['class'=>'button button-outline']);
            }
            ?>
            <p></p>
        </div>
    </div>
</div>
