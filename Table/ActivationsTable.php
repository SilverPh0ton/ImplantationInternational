<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activations Model
 *
 * @method \App\Model\Entity\Activation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activation findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivationsTable extends Table
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

        $this->setTable('activations');
        $this->setDisplayField('id_activation');
        $this->setPrimaryKey('id_activation');
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
            ->integer('activation_id')
            ->allowEmptyString('activation_id', null, 'create');

        $validator
            ->scalar('code_activation')
            ->maxLength('code_activation', 30)
            ->requirePresence('code_activation', 'create')
            ->notEmptyString('code_activation');

        $validator
            ->integer('id_voyage')
            ->requirePresence('id_voyage', 'create')
            ->notEmptyString('id_voyage');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        return $validator;
    }
}
