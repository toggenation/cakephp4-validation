<?php

declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Rule\TitleIsUnique;
use App\Model\Validation\Validator as ValidationValidator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 *
 * @method \App\Model\Entity\Post newEmptyEntity()
 * @method \App\Model\Entity\Post newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Post[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Post get($primaryKey, $options = [])
 * @method \App\Model\Entity\Post findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Post patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Post[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Post|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PostsTable extends Table
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

        $this->setTable('posts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title')
            ->add('title', 'unique', [
                'rule' => function($value, $context) {
                    $isDuplicate = $this->find()->where(['title LIKE' => $value])->count() > 0;

                    if($isDuplicate) {
                        return "Title \"${value}\" is already in use - Validation";
                    }

                    return true;
                }
                // 'message' => 'Title must be unique - Validation',
                // 'rule' => 'validateUnique', 'provider' => 'table'
            ]);

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        return $validator;
    }


    public function validationCommand(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title')
            ->add('title', 'unique', [
                'rule' => function($value, $context) {
                    $table = $context['providers']['table'];
                    
                    $isDuplicate = $table->find()->where(['title LIKE' => $value])->count() > 0;

                    if($isDuplicate) {
                        return "Title \"${value}\" is already in use - Command Validation";
                    }

                    return true;
                }
                // 'message' => 'Title must be unique - Validation',
                // 'rule' => 'validateUnique', 'provider' => 'table'
            ]);

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body')
            ->add('body', 'unique', [
                 'message' => 'Body must be unique - Command Validation',
                'rule' => 'validateUnique', 'provider' => 'table'
            ]);

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
        $rules->add(new TitleIsUnique($rules), 'customIsUnique', ['errorField' => 'title']);

        return $rules;
    }
}
