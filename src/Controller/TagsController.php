<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $action = $this->request->getParam('action');
        if (isset($user['role']) && $user['role'] === 'admin') {
            if(in_array($action, ['add', 'view', 'edit', 'delete'])){
                return true;
            }
            return true;
        }
        // All actions are allowed to logged in users for tags.
       // return true;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $tag = $this->Tags->get($id, [
            'contain' => ['Addresses']
        ]);

        $this->set('tag', $tag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $addresses = $this->Tags->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'adrresses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $tag = $this->Tags->get($id, [
            'contain' => ['Addresses']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $addresses = $this->Tags->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'adresses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
