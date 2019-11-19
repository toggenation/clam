<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PartsRoles Controller
 *
 * @property \App\Model\Table\PartsRolesTable $PartsRoles
 */
class PartsRolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parts', 'Roles']
        ];
        $partsRoles = $this->paginate($this->PartsRoles);

        $this->set(compact('partsRoles'));
        $this->set('_serialize', ['partsRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Parts Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partsRole = $this->PartsRoles->get($id, [
            'contain' => ['Parts', 'Roles']
        ]);

        $this->set('partsRole', $partsRole);
        $this->set('_serialize', ['partsRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partsRole = $this->PartsRoles->newEntity();
        if ($this->request->is('post')) {
            $partsRole = $this->PartsRoles->patchEntity($partsRole, $this->request->data);
            if ($this->PartsRoles->save($partsRole)) {
                $this->Flash->success(__('The parts role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parts role could not be saved. Please, try again.'));
            }
        }
        $parts = $this->PartsRoles->Parts->find('list', ['limit' => 200]);
        $roles = $this->PartsRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('partsRole', 'parts', 'roles'));
        $this->set('_serialize', ['partsRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parts Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partsRole = $this->PartsRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partsRole = $this->PartsRoles->patchEntity($partsRole, $this->request->data);
            if ($this->PartsRoles->save($partsRole)) {
                $this->Flash->success(__('The parts role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parts role could not be saved. Please, try again.'));
            }
        }
        $parts = $this->PartsRoles->Parts->find('list', ['limit' => 200]);
        $roles = $this->PartsRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('partsRole', 'parts', 'roles'));
        $this->set('_serialize', ['partsRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parts Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partsRole = $this->PartsRoles->get($id);
        if ($this->PartsRoles->delete($partsRole)) {
            $this->Flash->success(__('The parts role has been deleted.'));
        } else {
            $this->Flash->error(__('The parts role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
