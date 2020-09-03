<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Round $round
 * @var \App\Tables\TablesInterface $table
 * @var \App\Model\Entity\Game $game
 */
$this->assign('title', $table->getTitle());
?>
<div class="rounds index content">
    <div class="column">
        <h1><?= $table->getTitle() ?></h1>
        <blockquote><p><?= $table->getIntro() ?></p></blockquote>

        <?= $this->Form->create($round) ?>
        <?php
        echo $this->Form->hidden('game_id', ['value' => $game->id]);
        echo $this->Form->hidden('number', ['value' => count($game->rounds) + 1]);
        ?>

        <hr>
        <fieldset>
            <legend><?= __('Idey na tento kvartál') ?></legend>
            <?php
            $i = 0;
            foreach ($table->getIdeas($game) as $idea) {
                echo $this->element('idea', ['idea' => $idea]);
                echo $this->Form->hidden('bets.' . $i . '.idea_name', ['value' => $idea->getName()]);
                echo $this->Form->control('bets.' . $i . '.bet', ['options' => ['0.5' => '50%', '1' => '100%'], 'empty' => 'nie', 'label' => 'Koľko času má Projektový tím venovať tejto idey?']);
                $i++;
                echo '<hr>';
            }

            ?>
        </fieldset>

        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
