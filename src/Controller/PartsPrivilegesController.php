<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PartsPrivileges Controller
 *
 * @property \App\Model\Table\PartsPrivilegesTable $PartsPrivileges
 */
class PartsPrivilegesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parts', 'Privileges']
        ];
        $partsPrivileges = $this->paginate($this->PartsPrivileges);

        $this->set(compact('partsPrivileges'));
        $this->set('_serialize', ['partsPrivileges']);
    }

    /**
     * View method
     *
     * @param string|null $id Parts Privilege id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partsPrivilege = $this->PartsPrivileges->get($id, [
            'contain' => ['Parts', 'Privileges']
        ]);

        $this->set('partsPrivilege', $partsPrivilege);
        $this->set('_serialize', ['partsPrivilege']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partsPrivilege = $this->PartsPrivileges->newEntity();
        if ($this->request->is('post')) {
            $partsPrivilege = $this->PartsPrivileges->patchEntity($partsPrivilege, $this->request->data);
            if ($this->PartsPrivileges->save($partsPrivilege)) {
                $this->Flash->success(__('The parts privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parts privilege could not be saved. Please, try again.'));
            }
        }
        $parts = $this->PartsPrivileges->Parts->find('list', ['limit' => 200]);
        $privileges = $this->PartsPrivileges->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('partsPrivilege', 'parts', 'privileges'));
        $this->set('_serialize', ['partsPrivilege']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parts Privilege id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partsPrivilege = $this->PartsPrivileges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partsPrivilege = $this->PartsPrivileges->patchEntity($partsPrivilege, $this->request->data);
            if ($this->PartsPrivileges->save($partsPrivilege)) {
                $this->Flash->success(__('The parts privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parts privilege could not be saved. Please, try again.'));
            }
        }
        $parts = $this->PartsPrivileges->Parts->find('list', ['limit' => 200]);
        $privileges = $this->PartsPrivileges->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('partsPrivilege', 'parts', 'privileges'));
        $this->set('_serialize', ['partsPrivilege']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parts Privilege id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partsPrivilege = $this->PartsPrivileges->get($id);
        if ($this->PartsPrivileges->delete($partsPrivilege)) {
            $this->Flash->success(__('The parts privilege has been deleted.'));
        } else {
            $this->Flash->error(__('The parts privilege could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
