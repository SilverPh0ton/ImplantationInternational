<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Destinations Model
 *
 * @method \App\Model\Entity\Destination get($primaryKey, $options = [])
 * @method \App\Model\Entity\Destination newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Destination[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Destination|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Destination saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Destination patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Destination[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Destination findOrCreate($search, callable $callback = null, $options = [])
 */
class DestinationsTable extends Table
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

        $this->setTable('destinations');
        $this->setDisplayField('id_destination');
        $this->setPrimaryKey('id_destination');

        $this->hasMany('Voyages', [
            'foreignKey' => 'id_destination',
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
            ->integer('id_destination')
            ->allowEmptyString('id_destination', null, 'create');

        $validator
            ->scalar('nom_pays')
            ->maxLength('nom_pays', 50)
            ->requirePresence('nom_pays', 'create')
            ->notEmptyString('nom_pays');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        return $validator;
    }
}
