<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

?>

<main class="main">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="column">
                    <h1>Vitaj</h1>
                    <p>Tu si vyskúšaš č je zodpovednosť pri strategickom plánovaní.</p>
                    <?= $this->Html->link(__('New Game'), ['controller' => 'Rounds', 'action' => 'add'], ['class' => 'button']) ?>
                    <?= $this->Html->link(__('Winners'), ['controller' => 'Games', 'action' => 'index'], ['class' => 'button button-outline']) ?>
                </div>
            </div>
        </div>
    </div>
</main>
