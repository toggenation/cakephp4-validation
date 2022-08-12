<?php

namespace App\Service;

use App\Controller\PostsController;

class CreatePost
{
    public function add(PostsController $controller)
    {
        $request = $controller->getRequest();

        $post = $controller->Posts->newEmptyEntity();

        if ($request->is('post')) {
            $post = $controller->Posts->patchEntity(
                $post,
                $request->getData(),
                ['validate' => 'command']
            );

            if ($controller->Posts->save($post)) {
                $controller->Flash->success(__('The post has been saved.'));

                return $controller->redirect(['action' => 'index']);
            }

            $controller->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $controller->set(compact('post'));
    }
}
