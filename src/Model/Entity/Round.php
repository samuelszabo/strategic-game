<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Round Entity
 *
 * @property int $id
 * @property int|null $game_id
 * @property int|null $number
 * @property float|null $bet_project_1
 * @property float|null $bet_project_2
 * @property float|null $bet_project_3
 * @property float|null $bet_maintenance
 * @property float|null $bet_upgrade
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Game $game
 * @property \App\Model\Entity\Bet[] $bets
 */
class Round extends Entity
{
    public const MAX = 3;
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'game_id' => true,
        'number' => true,
        'created' => true,
        'modified' => true,
        'game' => true,
        'bets' => true,
    ];

    public function getEarns(): float
    {
        return collection($this->getPositiveBets())->sumOf(fn(Bet $bet) => $bet->getEarns());
    }

    public function getSatisfaction(): float
    {
        return collection($this->getPositiveBets())->sumOf(fn(Bet $bet) => $bet->getSatisfaction());
    }

    /**
     * @return \App\Model\Entity\Bet[]
     */
    public function getPositiveBets(): array
    {
        return collection($this->bets)->filter(fn(Bet $bet) => $bet->bet > 0)->toArray();
    }
}
