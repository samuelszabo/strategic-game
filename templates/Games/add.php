<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-offset-25 column-50">
        <div class="users form content">
            <?= $this->Form->create($game) ?>
            <fieldset>
                <legend><?= __('Add Game') ?></legend>
                <?php
                    echo $this->Form->hidden('user_id', ['value' => $user->id]);
                    echo $this->Form->control('name', ['label'=>'Company name']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
