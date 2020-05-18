<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Voyages Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Destinations
 * @property \App\Model\Table\ComptesTable&\Cake\ORM\Association\BelongsToMany $Comptes
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\BelongsToMany $Questions
 *
 * @method \App\Model\Entity\Voyage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Voyage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Voyage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Voyage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Voyage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Voyage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Voyage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Voyage findOrCreate($search, callable $callback = null, $options = [])
 */
class VoyagesTable extends Table
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

        $this->setTable('voyages');
        $this->setDisplayField('id_voyage');
        $this->setPrimaryKey('id_voyage');

        $this->belongsTo('Destinations', [
            'foreignKey' => 'id_destination',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Comptes', [
            'foreignKey' => 'id_voyage',
            'targetForeignKey' => 'id_compte',
            'joinTable' => 'comptes_voyages'
        ]);
        $this->belongsToMany('Questions', [
            'foreignKey' => 'id_voyage',
            'targetForeignKey' => 'id_question',
            'joinTable' => 'voyages_questions'
        ]);

        $this->hasMany('VoyagesQuestions', [
            'foreignKey' => 'id_voyage',
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
            ->integer('voyage_id')
            ->allowEmptyString('voyage_id', null, 'create');

        $validator
            ->scalar('ville')
            ->maxLength('ville', 50)
            ->requirePresence('ville', 'create')
            ->allowEmptyString('ville');

        $validator
            ->decimal('cout')
            ->requirePresence('cout', 'create')
            ->notEmptyString('cout');

        $validator
            ->date('date_depart','yyyy-mm-ff','Cette date est invalide')
            ->requirePresence('date_depart', 'create')
            ->notEmptyDate('date_depart');

        $validator
            ->date('date_limite','yyyy-mm-ff','Cette date est invalide')
            ->requirePresence('date_limite', 'create')
            ->notEmptyDate('date_limite');

        $validator
            ->date('date_retour','yyyy-mm-ff','Cette date est invalide')
            ->requirePresence('date_retour', 'create')
            ->notEmptyDate('date_retour');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        $validator
            ->boolean('approuvee')
            ->notEmptyString('approuvee');

        $validator
            ->scalar('nom_projet')
            ->maxLength('nom_projet', 30)
            ->requirePresence('nom_projet', 'create')
            ->notEmptyString('nom_projet');

        $validator
            ->scalar('note')
            ->maxLength('note', 200)
            ->requirePresence('note', 'create')
            ->allowEmptyString('note');

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
        $rules->add($rules->existsIn(['destination_id'], 'Destinations'));

        return $rules;
    }
}
