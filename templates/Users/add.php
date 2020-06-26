<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column column-offset-25 column-50">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <p>Najpr sa predstav. Pod týmto menom sa nájdeš aj na výhernej listine.</p>
                <?php
                echo $this->Form->control('name', ['label' => __('Name'), 'autofocus' => 'autofocus']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
