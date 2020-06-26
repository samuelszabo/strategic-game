<?php
/**
 * @var AppView $this
 * @var User|null $user
 * @var Game|null $game
 */

use App\Model\Entity\Game;
use App\Model\Entity\Round;
use App\Model\Entity\User;
use App\View\AppView;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        StrategicGame:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <script defer src="/js/<?= $this->Html->versionedUrl('main.js') ?>" charset="utf-8"></script>
    <script defer src="/js/<?= $this->Html->versionedUrl('vendors~main.js') ?>" charset="utf-8"></script>
</head>
<body>
<nav class="top-nav">
    <div class="top-nav-title">
        <a href="/">Strategic<span>Game</span></a>
    </div>
    <div class="top-nav-links">
        <?php
        if ($game && !$game->isNew()) {
            //echo min(count($game->rounds) + 1, Round::MAX) . '/' . Round::MAX;
            echo $this->Form->postLink(__('New Game'), ['controller' => 'Games', 'action' => 'reset']);
        }
        if ($user) {
            echo $this->Html->link(__('Winners'), ['controller' => 'Games', 'action' => 'index']);
            echo $this->Form->postLink(__('Logout'), ['controller' => 'Users', 'action' => 'logout']);
        }
        ?>
    </div>
</nav>
<main class="main">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>
<footer>
</footer>
</body>
</html>
