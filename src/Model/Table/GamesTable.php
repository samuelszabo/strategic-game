<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Game;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Games Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RoundsTable&\Cake\ORM\Association\HasMany $Rounds
 * @method Game newEmptyEntity()
 * @method Game newEntity(array $data, array $options = [])
 * @method Game[] newEntities(array $data, array $options = [])
 * @method Game get($primaryKey, $options = [])
 * @method Game findOrCreate($search, ?callable $callback = null, $options = [])
 * @method Game patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method Game[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method Game|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method Game saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method Game[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method Game[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method Game[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method Game[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GamesTable extends Table
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

        $this->setTable('games');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', ['foreignKey' => 'user_id',]);
        $this->hasMany('Rounds', ['foreignKey' => 'game_id',]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->nonNegativeInteger('id')->allowEmptyString('id', null, 'create');

        $validator->scalar('name')->maxLength('name', 255)->allowEmptyString('name');

        $validator->numeric('earns')->allowEmptyString('earns');

        $validator->numeric('satisfactions')->allowEmptyString('satisfactions');

        $validator->numeric('points')->allowEmptyString('points');

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
        return $rules;
    }
}
