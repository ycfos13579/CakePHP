<?php


namespace App\Controller;

use App\Controller\AppController;


class AddressesController extends AppController
{
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['tags']);
    }
    
    public function isAuthorized($user)    {
        parent::isAuthorized($user);   
        $action = $this->request->getParam('action');
        if (isset($user['role']) && $user['role'] === 'admin') {
            if(in_array($action, ['add', 'view', 'edit', 'delete'])){
                return true;
            }
            return true;
        }
        /*$action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        
        $id = $this->request->getParam('pass.0');
        if (!$id) {
            return false;
        }

        // Check that the address belongs to the current user.
        $address = $this->Addresses->findById($id)->first();

        return $address->user_id === $user['id'];*/
    }
 
    public function index()
    {
         $this->paginate = [
            'contain' => ['Users']
        ];
        $addresses = $this->paginate($this->Addresses);

        $this->set(compact('addresses'));
    }
    
    public function view($id = null)
    {
        $address = $this->Addresses->get($id, [
            'contain' => ['Users', 'Tags', 'Customers', 'files']
        ]);

        $this->set('address', $address);
    }
    public function add(){
        $address = $this->Addresses->newEntity();
        if ($this->request->is('post')) {
            $address = $this->Addresses->patchEntity($address, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $address->user_id = $this->Auth->user('id');

            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('Your address has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }
        $tags = $this->Addresses->Tags->find('list', ['limit' => 200]);
        $files = $this->Addresses->files->find('list', ['limit' => 200]);
        $this->set(compact('address', 'users', 'tags', 'files'));
    }
    
    public function edit($id = null) {
        $address = $this->Addresses->get($id, [
            'contain' => ['Tags', 'files']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $address = $this->Addresses->patchEntity($address, $this->request->getData());
            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }
        
        $tags = $this->Addresses->Tags->find('list', ['limit' => 200]);
        $files = $this->Addresses->files->find('list', ['limit' => 200]);
        $this->set(compact('address', 'users', 'tags', 'files'));
    }
    
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $address = $this->Addresses->get($id);
        if ($this->Addresses->delete($address)) {
            $this->Flash->success(__('The address has been deleted.'));
        } else {
            $this->Flash->error(__('The address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the AddressesTable to find tagged addresses.
        $addresss = $this->Addresses->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'addresses' => $addresses,
            'tags' => $tags
        ]);
    }
}
