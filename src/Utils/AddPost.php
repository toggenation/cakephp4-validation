<?php

namespace App\Utils;

use App\Model\Table\PostsTable;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Hash;
use Cake\Utility\Text;
use Exception;

class AddPost
{

    use LocatorAwareTrait;

    private PostsTable $table;

    public function __construct()
    {
        $this->table = $this->fetchTable('Posts');
    }

    public function create($title, $body)
    {
        //save
        $post = $this->table->newEntity(
            compact('title', 'body'),
            ['validate' => 'command']
        );

        if ($this->table->save($post) === false) {
            $errors = $post->getErrors();

            $formattedErrors = Text::toList(array_values(Hash::flatten($errors)));

            throw new Exception($formattedErrors);
        }

        return $post;
    }
}
