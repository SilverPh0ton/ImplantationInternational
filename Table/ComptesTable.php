<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comptes Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Programmes
 * @property \App\Model\Table\VoyagesTable&\Cake\ORM\Association\BelongsToMany $Voyages
 *
 * @method \App\Model\Entity\Compte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Compte newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Compte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Compte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Compte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Compte[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Compte findOrCreate($search, callable $callback = null, $options = [])
 */
class ComptesTable extends Table
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

        $this->setTable('comptes');
        $this->setDisplayField('id_compte');
        $this->setPrimaryKey('id_compte');

        $this->belongsTo('Programmes', [
            'foreignKey' => 'id_programme',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Voyages', [
            'foreignKey' => 'id_compte',
            'targetForeignKey' => 'voyage_id',
            'joinTable' => 'comptes_voyages'
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
            ->integer('id_compte')
            ->allowEmptyString('id_compte', null, 'create');

        $validator
            ->scalar('pseudo')
            ->maxLength('pseudo', 30)
            ->requirePresence('pseudo', 'create')
            ->notEmptyString('pseudo');

        $validator
            ->scalar('mot_de_passe')
            ->maxLength('mot_de_passe', 255)
            ->requirePresence('mot_de_passe', 'create')
            ->notEmptyString('mot_de_passe');

        $validator
            ->scalar('type')
            ->maxLength('type', 10)
            ->notEmptyString('type');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        $validator
            ->scalar('courriel')
            ->maxLength('courriel', 50)
            ->requirePresence('courriel', 'create')
            ->notEmptyString('courriel');

        $validator
            ->scalar('nom')
            ->maxLength('nom', 30)
            ->requirePresence('nom', 'create')
            ->notEmptyString('nom');

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 30)
            ->requirePresence('prenom', 'create')
            ->notEmptyString('prenom');

        $validator
            ->date('date_naissance','yyyy-mm-ff','Cette date est invalide')
            ->requirePresence('date_naissance', 'create')
            ->notEmptyDate('date_naissance');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 20)
            ->requirePresence('telephone', 'create')
            ->allowEmpty('telephone');

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
        $rules->add($rules->existsIn(['programme_id'], 'Programmes'));

        return $rules;
    }
}
