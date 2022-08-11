<?php

namespace App\Model\Rule;

use Cake\Datasource\EntityInterface;

class TitleIsUnique
{
    // public function __construct($rules)
    // {
    //     $this->rules = $rules;
    // }

    public function __invoke(EntityInterface $entity, array $options)
    {
        $title = $entity->title;

        $table = $options['repository'];

        $tableAlias = $table->getAlias();

        $query = $table->find();

        $isDuplicate = $query->select(['title'])->where(['title LIKE' => $title])->count() > 0;

        if($isDuplicate) {
            return "Title \"${title}\" is already in the ${tableAlias} table - Rules Checker";
        }

        return true;

        // $rule = $this->rules->isUnique(
        //     ['title'],
        //     [
        //         'message' => "Title \"${title}\" is already in the ${tableAlias} table - Rules Checker",
        //         'errorField' => 'title'
        //     ]
        // );

        // return $rule($entity, $options);
    }
}
