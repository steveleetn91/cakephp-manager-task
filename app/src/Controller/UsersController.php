<?php
// src/Controller/UsersController.php

namespace App\Controller;

class UsersController extends AppController
{

    public function index()
    {
        $this->loadComponent('Paginator');
        $users = $this->Paginator->paginate($this->Users->find());
        $this->set(compact('users'));
    }

    // in src/Controller/UsersController.php
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
{
    $result = $this->Authentication->getResult();
    // If the user is logged in send them away.
    if ($result->isValid()) {
        $target = $this->Authentication->getLoginRedirect() ?? '/tasks';
        return $this->redirect($target);
    }
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error('Invalid username or password');
    }
}

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $user->user_id = 1;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your user.'));
        }
        $this->set('user', $user);
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

}