<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 * @var \App\Model\Entity\User $user
 * @var string[] $companyNames
 */
?>
<div class="row">
    <div class="column column-offset-25 column-50">
        <div class="users form content">
            <?= $this->Form->create($game) ?>
            <fieldset>
                <p>Vyplň názov svojej firmy. Podľa neho budeš vidieť rozdiel medzi jednotlivými pokusmi.</p>
                <?php
                echo $this->Form->hidden('user_id', ['value' => $user->id]);
                echo $this->Form->hidden('fallbackName', ['value' => $companyNames[0]]);
                echo $this->Form->control('name', ['label' => __('Company name'), 'autofocus' => 'autofocus', 'class' => 'js-autofill-target']);
                ?>
                Ak nevieš, vyber napr. tieto:<br><?php
                foreach ($companyNames as $companyName) {
                    echo $this->Html->link($companyName, '#', ['class' => 'js-autofill']) . ', ';
                }
                echo ' ..';
                ?>
            </fieldset>
            <?= $this->Form->button(__('Start Game')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
