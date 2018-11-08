<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Addresses Controller
 *
 * @property \App\Model\Table\AddressesTable $Addresses
 *
 * @method \App\Model\Entity\Address[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AddressesController extends AppController
{

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['tags']);
    }

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        // All other actions require a slug.
        $id = $this->request->getParam('pass.0');
        if (!$id) {
            return false;
        }

        // Check that the article belongs to the current user.
        $address = $this->Addresses->findById($id)->first();

        return $address->user_id === $user['id'];
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $addresses = $this->paginate($this->Addresses);

        $this->set(compact('addresses'));
    }

    /**
     * View method
     *
     * @param string|null $id Address id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $address = $this->Addresses->get($id, [
            'contain' => ['Users', 'Files', 'Tags', 'Customers', 'Cities']
        ]);

        $this->set('address', $address);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $address = $this->Addresses->newEntity();
        
        if ($this->request->is('post')) {
            $address = $this->Addresses->patchEntity($address, $this->request->getData());
            
            $address->user_id = $this->Auth->user('id');
            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }
        // Bâtir la liste des Provinces  
        $this->loadModel('Provinces');
        $provinces = $this->Provinces->find('list', ['limit' => 200]);

        // Extraire le id de la première province
        $provinces = $provinces->toArray();
        reset($provinces);
        $province_id = key($provinces);

        // Bâtir la liste des villes reliées à cette province
        $cities = $this->Addresses->cities->find('list', [
            'conditions' => ['Cities.province_id' => $province_id],
        ]);

        $users = $this->Addresses->Users->find('list', ['limit' => 200]);
        $files = $this->Addresses->Files->find('list', ['limit' => 200]);
        $tags = $this->Addresses->Tags->find('list', ['limit' => 200]);
        $this->set(compact('address', 'users', 'files', 'tags', 'cities', 'provinces'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Address id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $address = $this->Addresses->get($id, [
            'contain' => ['Files', 'Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $address = $this->Addresses->patchEntity($address, $this->request->getData());
            if ($this->Addresses->save($address)) {
                $this->Flash->success(__('The address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The address could not be saved. Please, try again.'));
        }
       //$users = $this->Addresses->Users->find('list', ['limit' => 200]);
        $files = $this->Addresses->Files->find('list', ['limit' => 200]);
        $tags = $this->Addresses->Tags->find('list', ['limit' => 200]);
        $this->set(compact('address', 'users', 'files', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Address id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $address = $this->Addresses->get($id);
        if ($this->Addresses->delete($address)) {
            $this->Flash->success(__('The address has been deleted.'));
        } else {
            $this->Flash->error(__('The address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function tags() {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ArticlesTable to find tagged articles.
        $addresses = $this->Addresses->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'addresses' => $addresses,
            'tags' => $tags
        ]);
    }
}
