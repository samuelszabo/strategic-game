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
            <p>Vďaka tvojmu rozhodnutiu, každý ďalší kvartál budú:</p>
            <ul>
                <li><?php
                    if ($round->getEarns() >= 0) {
                        echo 'Tržby rásť o ' . $this->Number->currency($round->getEarns());
                    } else {
                        echo 'Tržby klesať o ' . $this->Number->currency($round->getEarns());
                    }
                    ?></li>
                <li><?php
                    if ($round->getSatisfaction() >= 1) {
                        echo 'Spokojnosť zamestnancov stúpať o ' . $this->Number->toPercentage($round->getSatisfaction());
                    } else {
                        echo 'Spokojnosť zamestnancov klesať o ' . $this->Number->toPercentage($round->getSatisfaction());
                    }
                    ?></li>
            </ul>
        </div>
        <br>
        <div class="content">
            <div class="row">
                <div class="column column-25">
                    <p>Bodov:</p>
                    <h2><?php
                        echo $this->Number->format($game->points);
                        ?></h2>
                </div>
                <div class="column column-25">
                    <p>Tržby:</p>
                    <h2><?php
                        echo $this->Number->currency($game->earns);
                        ?></h2>
                </div>
                <div class="column column-25">
                    <p>Spokojnosť:</p>
                    <h2><?php
                        echo $this->Number->toPercentage($game->calculateSatisfaction());
                        ?></h2>
                </div>
            </div>
            <?php
            if ($game->nextTable()) {
                echo $this->Html->link('Pokračuj na ďalšie kolo', ['controller' => 'Rounds', 'action' => 'add'],
                    ['class' => 'button']);
            } else {
                echo $this->Html->link('Zobraz celkové skóre', ['controller' => 'Games', 'action' => 'index'],
                    ['class' => 'button button-outline']);
            }
            ?>
            <p></p>
        </div>
    </div>
</div>
