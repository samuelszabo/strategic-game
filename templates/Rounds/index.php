<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Tables\TablesInterface $table
 * @var \App\Model\Entity\Game $game
 */
?>
<div class="rounds index content">
    <div class="column">
        <h1>Začíname</h1>
        <p>Si šéfom malého eshopu <em><?= h($game->name) ?></em> s plavkami a plážovým oblečením, s vlastnou výrobou a
            návrhármi.
            Funguje už 10 rokov a stále pomaly rastie. Konkurencia je veľmi obmedzená a nikto nemá taký prehľadný
            web ako vy. Avšak stále chceš byť lepší a mať náskok.
        </p>
        <p> Čakajú ťa 4 kvartálne plánovania. Na každom sa rozhoduješ o práci svojho “projektového teamu”, čomu sa budú
            venovať.
        </p>
        <?= $this->Html->link(__('Start Game'), ['action' => 'add'], ['class' => 'button']) ?>
    </div>
</div>
