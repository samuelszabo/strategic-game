<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 * @var \App\Model\Entity\Game $game
 */

$this->assign('title', $game->user->name . ' - ' . $game->name);
?>

<div class="content">
    <div class="row">
        <div class="column column-25">
            <p><?= h($game->name) ?></p>
            <h2><?php
                echo h($game->user->name);
                ?></h2>
        </div>
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
    echo $this->Html->link('Zobraz celkové skóre', ['controller' => 'Games', 'action' => 'index'],
        ['class' => 'button button-outline']);

    ?>
</div>
<br>
<div class="container content">
    <div class="row">
        <?php
        foreach ($game->rounds as $round) {
            ?>
            <div class="column column-50">
                <h3><?= h($round->number) ?>. kolo</h3>
                <p>Hlasovanie:</p>
                <ul><?php
                    foreach ($round->bets as $bet) {
                        if ($bet->bet > 0) {
                            echo '<li>';
                            echo $this->Number->toPercentage($bet->bet) . ' ' . $bet->getIdea()->title;
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
                <p>Výsledky:</p>
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
            <?php
        }
        ?>
    </div>
</div>


