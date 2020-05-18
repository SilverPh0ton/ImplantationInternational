<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\VoyagesTable&\Cake\ORM\Association\BelongsToMany $Voyages
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null, $options = [])
 */
class QuestionsTable extends Table
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

        $this->setTable('questions');
        $this->setDisplayField('id_question');
        $this->setPrimaryKey('id_question');

        $this->belongsTo('Categories', [
            'foreignKey' => 'id_categorie',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Voyages', [
            'foreignKey' => 'id_question',
            'targetForeignKey' => 'id_voyage',
            'joinTable' => 'voyages_questions'
        ]);

        $this->hasMany('VoyagesQuestions', [
            'foreignKey' => 'id_question',
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
            ->integer('id_question')
            ->allowEmptyString('id_question', null, 'create');

        $validator
            ->scalar('question')
            ->maxLength('question', 800)
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('input_option')
            ->maxLength('input_option', 100)
            ->allowEmpty('input_option');

        $validator
            ->scalar('affichage')
            ->maxLength('affichage', 30)
            ->requirePresence('affichage', 'create')
            ->notEmptyString('affichage');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        $validator
            ->boolean('$regroupement')
            ->notEmptyString('$regroupement');


        $validator
            ->scalar('info_sup')
            ->allowEmpty('info_sup')
            ->maxLength('info_sup', 250);

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
        $rules->add($rules->existsIn(['id_categorie'], 'Categories'));

        return $rules;
    }
}
