<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComptesVoyages Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Comptes
 * @property &\Cake\ORM\Association\BelongsTo $Voyages
 *
 * @method \App\Model\Entity\ComptesVoyage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ComptesVoyage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ComptesVoyage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComptesVoyage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComptesVoyage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ComptesVoyage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ComptesVoyage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComptesVoyage findOrCreate($search, callable $callback = null, $options = [])
 */
class ComptesVoyagesTable extends Table
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

        $this->setTable('comptes_voyages');
        $this->setDisplayField('id_compte');
        $this->setPrimaryKey(['id_compte', 'id_voyage']);

        $this->belongsTo('Comptes', [
            'foreignKey' => 'id_compte',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Voyages', [
            'foreignKey' => 'id_voyage',
            'joinType' => 'INNER'
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
            ->date('date_paiment')
            ->allowEmptyDate('date_paiment');

        $validator
            ->scalar('relation')
            ->maxLength('relation', 20)
            ->requirePresence('relation', 'create')
            ->notEmptyString('relation');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id_compte'], 'Comptes'));
        $rules->add($rules->existsIn(['id_voyage'], 'Voyages'));

        return $rules;
    }
}
