<?php
// src/Controller/ArticlesController.php
namespace App\Controller;

use App\Controller\AppController;
use App\Mailer\AssignMail;
class TasksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $articles = $this->Paginator->paginate($this->Tasks->find());
        $this->set(compact('articles'));
    }

    public function view($slug)
    {
        $task = $this->Tasks->findBySlug($slug)->firstOrFail();
        $this->set(compact('task'));
    }

    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Tasks->patchEntity($task, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $task->user_id = 1;
            $data = $this->request->getData();
            $assignInfo = $this->Users->find()->where(['id' => $data['assign']])->first();
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('Your tasl has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your task.'));
        }
        $this->set('users', $this->Users->find()->all());
        $this->set('task', $task);
    }
    public function edit($slug)
    {
        $task = $this->Tasks
            ->findBySlug($slug)
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('Your task has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your task.'));
        }
        $this->set('users', $this->Users->find()->all());
        $this->set('task', $task);
    }
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Tasks->findBySlug($slug)->firstOrFail();
        if ($this->Tasks->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}