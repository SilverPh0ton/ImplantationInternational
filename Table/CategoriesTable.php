<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @method \App\Model\Entity\Categorie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Categorie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Categorie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Categorie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Categorie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Categorie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Categorie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Categorie findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriesTable extends Table
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

        $this->setTable('categories');
        $this->setDisplayField('id_categorie');
        $this->setPrimaryKey('id_categorie');

        $this->hasMany('Questions', [
            'foreignKey' => 'id_categorie',
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
            ->integer('id_categorie')
            ->allowEmptyString('id_categorie', null, 'create');

        $validator
            ->scalar('categorie')
            ->maxLength('categorie', 50)
            ->requirePresence('categorie', 'create')
            ->notEmptyString('categorie');

        $validator
            ->boolean('actif')
            ->notEmptyString('actif');

        return $validator;
    }
}
