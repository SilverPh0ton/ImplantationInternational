<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VoyagesQuestions Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Voyages
 * @property &\Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\VoyagesQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\VoyagesQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VoyagesQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VoyagesQuestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VoyagesQuestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VoyagesQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VoyagesQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VoyagesQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class VoyagesQuestionsTable extends Table
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

        $this->setTable('voyages_questions');
        $this->setDisplayField('id_voyage');
        $this->setPrimaryKey(['id_voyage', 'id_question']);

        $this->belongsTo('Voyages', [
            'foreignKey' => 'id_voyage',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Questions', [
            'foreignKey' => 'id_question',
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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id_voyage'], 'Voyages'));
        $rules->add($rules->existsIn(['id_question'], 'Questions'));

        return $rules;
    }
}
