<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Ideas\Idea;
use Cake\Core\App;
use Cake\ORM\Entity;

/**
 * Bet Entity
 *
 * @property int $id
 * @property int|null $round_id
 * @property string|null $idea_name
 * @property float|null $bet
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Round $round
 */
class Bet extends Entity
{
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
        'round_id' => true,
        'idea_name' => true,
        'bet' => true,
        'created' => true,
        'modified' => true,
        'round' => true,
    ];

    public function getIdea(): Idea
    {
        assert(is_string($this->idea_name));
        $className = App::className($this->idea_name, 'Ideas');

        return new $className();
    }

    public function getEarns(): float
    {
        $idea = $this->getIdea();
        if ($this->bet >= 2.0) {
            return $idea->earns * $idea->doubleEarns;
        }
        if ($this->bet >= 1.0) {
            return $idea->earns * $idea->fullEarns;
        }
        if ($this->bet >= 0.5) {
            return $idea->earns * $idea->halfEarns;
        }

        return 0;
    }

    public function getSatisfaction(): float
    {
        $satisfaction = $this->getIdea()->satisfaction;

        return $satisfaction * $this->bet;
    }
}
