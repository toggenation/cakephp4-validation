<?php 

namespace App\Services;

use App\Controller\PostsController;

class CreatePost {

    public function add(PostsController $controller, $type = null) {
        $request = $controller->getRequest();
        
        $post =  $controller->Posts->newEmptyEntity();

        if ( $request->is('post')) {
            $post =  $controller->Posts->patchEntity(
                $post, 
                $request->getData()
            );
            if ( $controller->Posts->save($post)) {
                $controller->Flash->success(__('The post has been saved.'));

                return  $controller->redirect(['action' => 'index']);
            }
            $controller->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $controller->set(compact('post'));
    }

}