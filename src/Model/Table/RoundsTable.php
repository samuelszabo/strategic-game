<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Round;
use Cake\Event\EventInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rounds Model
 *
 * @property \App\Model\Table\GamesTable&\Cake\ORM\Association\BelongsTo $Games
 * @method \App\Model\Entity\Round newEmptyEntity()
 * @method \App\Model\Entity\Round newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Round[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Round get($primaryKey, $options = [])
 * @method \App\Model\Entity\Round findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Round patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Round[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Round|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Round saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Round[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Round[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Round[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Round[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoundsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('rounds');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'Games' => [

            ],
        ]);

        $this->belongsTo('Games', [
            'foreignKey' => 'game_id',
        ]);
        $this->hasMany('Bets', [
            'foreignKey' => 'round_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('number')
            ->allowEmptyString('number');

        return $validator;
    }

    public function afterSave(EventInterface $event, Round $round)
    {
        $game = $this->Games->get($round->game_id, ['contain' => ['Rounds.Bets']]);
        $game->rounds_count = count($game->rounds);
        $game->earns = $game->calculateEarns();
        $game->satisfactions = $game->calculateSatisfaction();
        $game->points = 0;
        $this->Games->saveOrFail($game);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add(
            function (Round $round, $options) {
                $capacity = $round->game->getCapacity();
                $bets = collection($round->bets)->sumOf('bet');
                if ($bets > $capacity) {
                    return false;
                }

                return true;
            },
            'ruleName',
            [
                'errorField' => 'bets',
                'message' => 'Pridelená kapacita je vyššia ako dostupná',
            ]
        );

        return $rules;
    }
}
