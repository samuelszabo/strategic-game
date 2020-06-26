<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Game'), ['action' => 'edit', $game->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Game'), ['action' => 'delete', $game->id], ['confirm' => __('Are you sure you want to delete # {0}?', $game->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Games'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Game'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="games view content">
            <h3><?= h($game->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $game->has('user') ? $this->Html->link($game->user->name, ['controller' => 'Users', 'action' => 'view', $game->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($game->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($game->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($game->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($game->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Rounds') ?></h4>
                <?php if (!empty($game->rounds)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Game Id') ?></th>
                            <th><?= __('Number') ?></th>
                            <th><?= __('Bet Project 1') ?></th>
                            <th><?= __('Bet Project 2') ?></th>
                            <th><?= __('Bet Project 3') ?></th>
                            <th><?= __('Bet Maintenance') ?></th>
                            <th><?= __('Bet Upgrade') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($game->rounds as $rounds) : ?>
                        <tr>
                            <td><?= h($rounds->id) ?></td>
                            <td><?= h($rounds->game_id) ?></td>
                            <td><?= h($rounds->number) ?></td>
                            <td><?= h($rounds->bet_project_1) ?></td>
                            <td><?= h($rounds->bet_project_2) ?></td>
                            <td><?= h($rounds->bet_project_3) ?></td>
                            <td><?= h($rounds->bet_maintenance) ?></td>
                            <td><?= h($rounds->bet_upgrade) ?></td>
                            <td><?= h($rounds->created) ?></td>
                            <td><?= h($rounds->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Rounds', 'action' => 'view', $rounds->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Rounds', 'action' => 'edit', $rounds->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rounds', 'action' => 'delete', $rounds->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rounds->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
