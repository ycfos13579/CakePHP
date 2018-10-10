<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employes Controller
 *
 * @property \App\Model\Table\EmployesTable $Employes
 *
 * @method \App\Model\Entity\Enterprise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployesController extends AppController
{

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
        $employes = $this->paginate($this->Employes);

        $this->set(compact('employes'));
    }

    /**
     * View method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employe = $this->Employes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('employe', $employe);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        //debug($user_id);
        $this->set('user_id', $user_id);
        $employe = $this->Employes->newEntity();
        
        if ($this->request->is('post') && isset($user_id)) {
            $employe = $this->Employes->patchEntity($employe, $this->request->getData());
            
            $employe->user_id = $user_id;
            //debug($employe);
            if ($this->Employes->save($employe)) {
                $this->Flash->success(__('The employe has been saved.'));
                $this->redirect([
                    'controller' => 'Users', 
                    'action' => 'confirmEmploye', $user_id
                ]);
                echo 'test';
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employe could not be saved. Please, try again.'));
        }
        $users = $this->Employes->Users->find('list', ['limit' => 200]);
        $this->set(compact('employe', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employe = $this->Employes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employe = $this->Employes->patchEntity($employe, $this->request->getData());
            if ($this->Employes->save($employe)) {
                $this->Flash->success(__('The employe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employe could not be saved. Please, try again.'));
        }
        $users = $this->Employes->Users->find('list', ['limit' => 200]);
        $this->set(compact('employe', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enterprise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employe = $this->Employes->get($id);
        if ($this->Employes->delete($employe)) {
            $this->Flash->success(__('The employe has been deleted.'));
        } else {
            $this->Flash->error(__('The employe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        parent::isAuthorized($user);
        /*
        $action = $this->request->getParam('action');

        $valide = false;

        if (in_array($action, ['view'])) {
            $valide = true;
        }

        // Autorisations pour l'action edit
        if (in_array($action, ['edit'])) {
            
            if(isset($user['role']) && $user['role'] === 'employe'){
                $employe_id = (int) $this->request->getParam('pass.0');
                
                $employe = $this->Employes->get($employe_id);
                
                //Si user_id de l'entreprise correspond au id de l'user courrant
                if($employe['user_id'] == $user['id']){
                    $valide = true;
                }
                $valide = false;
            }    
        }

        if (in_array($action, ['delete'])) {
            $valide = false;
        }

        if (in_array($action, ['add']) && isset($user['role']) && $user['role'] === 'toBeEmploye') {
             $valide = true;
        }
        
        return ($valide) ? $valide : parent::isAuthorized($user);*/
    }
}
