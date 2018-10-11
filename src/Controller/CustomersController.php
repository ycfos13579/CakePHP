<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['add']);
    }

    
    public function isAuthorized($user)
    {
        parent::isAuthorized($user);   
        $action = $this->request->getParam('action');
        if (isset($user['role']) && $user['role'] === 'admin') {
            if(in_array($action, ['add', 'view', 'edit', 'delete'])){
                return true;
            }
            return true;
        }
        /*
        
        $valide = false;
        
        if ($user) {
            if ($user['role'] === 'customer') {
                if (in_array($action, [])) {
                    $valide = true;
                }
            } else if ($user['role'] === 'toBe') {
                
            }
        }

        if (in_array($action, ['view'])) {
            
            $valide = true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {

           /* if(isset($user['role']) && $user['role'] === 'customer'){
                $customer_id = (int) $this->request->getParam('pass.0');
                $customer = $this->Students->get($customer_id);
                
                //Si user_id du customer correspond au id de l'user courrant
                if($customer['user_id'] == $user['id']){
                    $valide = false;
                }
                $valide = false;
            }   
            
           
        }

        if (in_array($action, ['delete'])) {
            $valide = false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'toBeCustomer') {
             $valide = false;
        }

        return ($valide) ? $valide : parent::isAuthorized($user);*/ 
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Addresses']
        ];
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Addresses']
        ]);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $addresses = $this->Customers->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'addresses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $addresses = $this->Customers->Addresses->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'addresses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
