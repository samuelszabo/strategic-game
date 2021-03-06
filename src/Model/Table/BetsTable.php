<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bets Model
 *
 * @property \App\Model\Table\RoundsTable&\Cake\ORM\Association\BelongsTo $Rounds
 * @method \App\Model\Entity\Bet newEmptyEntity()
 * @method \App\Model\Entity\Bet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Bet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Bet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Bet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BetsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Rounds', [
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('idea_name')
            ->maxLength('idea_name', 255)
            ->allowEmptyString('idea_name');

        $validator
            ->numeric('bet')
            ->allowEmptyString('bet');

        return $validator;
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
        $rules->add($rules->existsIn(['round_id'], 'Rounds'));

        return $rules;
    }
}
