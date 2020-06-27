<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game[]|\Cake\Collection\CollectionInterface $games
 */
?>
<div class="content">
    <?= $this->Html->link(__('New Game'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Best ofs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Points') ?></th>
                <th><?= __('Earns') ?></th>
                <th><?= __('Satisfaction') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($games as $i => $game): ?>
                <tr>
                    <td><?= $this->Html->link($i + 1, ['action' => 'view', $game->id]) ?>.</td>
                    <td><?= $game->has('user') ? $game->user->name : '' ?>
                        <small><?= h($game->name) ?></small></td>
                    <td><?= $this->Number->points($game->points) ?> </td>
                    <td><?= $this->Number->currency($game->earns) ?> </td>
                    <td><?= $this->Number->toPercentage($game->satisfactions) ?> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="content">
    <h3><?= __('Your results') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Points') ?></th>
                <th><?= __('Earns') ?></th>
                <th><?= __('Satisfaction') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= $game->has('user') ? $game->user->name : '' ?>
                        <small><?= h($game->name) ?></small></td>
                    <td><?= $game->points ?> </td>
                    <td><?= $this->Number->currency($game->earns) ?> </td>
                    <td><?= $this->Number->toPercentage($game->satisfactions) ?> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
