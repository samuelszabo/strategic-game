<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Tables\Table1;
use App\Tables\Table2;
use Cake\ORM\Entity;
use Cake\ORM\Table;

/**
 * Game Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Round[] $rounds
 */
class Game extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'rounds' => true,
    ];

    private array $tables = [
        Table1::class,
        Table2::class,
    ];

    public function getCapacity(): int
    {
        return 1;
    }

    public function nextTable(): ?Table
    {
        if (!isset($this->tables[$this->getLastNumber()])) {
            return null;
        }
        $table = $this->tables[$this->getLastNumber()];
        return new $table;
    }

    public function getLastNumber(): int
    {
        return count($this->rounds) + 1;
    }

    public function getEarns(): float
    {
        return collection($this->rounds)->sumOf(fn(Round $round) => ($this->getLastNumber() - $round->number) * $round->getEarns());
    }

    public function getSatisfaction(): float
    {
        return collection($this->rounds)->sumOf(fn(Round $round) => ($this->getLastNumber() - $round->number) * $round->getSatisfaction());
    }
}
