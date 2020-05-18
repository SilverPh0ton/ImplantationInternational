<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programmes Model
 *
 * @method \App\Model\Entity\Programme get($primaryKey, $options = [])
 * @method \App\Model\Entity\Programme newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Programme[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Programme|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programme saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programme patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Programme[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Programme findOrCreate($search, callable $callback = null, $options = [])
 */
class ProgrammesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('programmes');
        $this->setDisplayField('id_programme');
        $this->setPrimaryKey('id_programme');

        $this->hasMany('Comptes', [
            'foreignKey' => 'id_programme',
        ]);
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = trim($value);
            }
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id_programme')
            ->allowEmptyString('id_programme', null, 'create');

        $validator
            ->scalar('nom_programme')
            ->maxLength('nom_programme', 50)
            ->requirePresence('nom_programme', 'create')
            ->notEmptyString('nom_programme');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        return $validator;
    }
}
