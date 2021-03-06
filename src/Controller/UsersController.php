<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
       /*$this->Auth->allow(['logout', 'add', 'edit']);*/
    }
    
     public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));

        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Addresses']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*public function add(){
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }*/
    public function add()
    {   
        $loguser = $this->request->getSession()->read('Auth.User');

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!isset($user['role']))
                $user['role'] = 'toBeCustomer';

            //debug($user);
            //die();

            if ($result = $this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $user_id = $result->id;
                debug($user_id);


                if(isset($loguser)){
                    if(isset($loguser['role']) && $loguser['role'] === 'admin'){
                        //Admin
                        echo 'test admin';
                    }
                }else{
                    // Créé par l'user
                    // Log in automatiquement
                    $user = $this->Auth->identify();
                    if ($user) {
                        $this->Auth->setUser($user);
                    }

                }

                // Redirection
                if($user['role'] === 'toBeCustomer'){
                    return $this->redirect([
                        'controller' => 'Users', 
                        'action' => 'index', $user_id
                    ]);
                }else if($user['role'] === 'toBeEmploye'){
                    return $this->redirect([
                        'controller' => 'Employes', 
                        'action' => 'add', $user_id
                    ]);
                }


            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     public function confirmEmploye($user_id = null){
        $user = $this->Users->get($user_id);
        $user->role = 'employe';
    
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The employe has been added.'));
            $loguser = $this->request->getSession()->read('Auth.User');
            if($loguser['id'] == $user_id){
                
                $this->request->getSession()->write('Auth.User', $user);
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The employe could not be added. Please, try again.'));
    }
    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $action = $this->request->getParam('action');
        if (isset($user['role']) && $user['role'] === 'admin') {
            if(in_array($action, ['add', 'view', 'edit', 'delete'])){
                return true;
            }
            return true;
        }
        if (isset($user['role']) && $user['role'] === 'toBeEmploye') {
            if(in_array($action, ['add','view', 'edit'])){
                return true;
            }
            return true;
        }
        // All actions are allowed to logged in users for tags.
       // return true;
    }
   
}
