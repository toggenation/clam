<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Privileges Controller
 *
 * @property \App\Model\Table\PrivilegesTable $Privileges
 */
class PrivilegesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $privileges = $this->paginate($this->Privileges);

        $this->set(compact('privileges'));
        $this->set('_serialize', ['privileges']);
    }

    /**
     * View method
     *
     * @param string|null $id Privilege id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $privilege = $this->Privileges->get($id, [
            'contain' => ['Parts', 'People']
        ]);

        $this->set('privilege', $privilege);
        $this->set('_serialize', ['privilege']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $privilege = $this->Privileges->newEntity();
        if ($this->request->is('post')) {
            $privilege = $this->Privileges->patchEntity($privilege, $this->request->data);
            if ($this->Privileges->save($privilege)) {
                $this->Flash->success(__('The privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The privilege could not be saved. Please, try again.'));
            }
        }
        $parts = $this->Privileges->Parts->find('list', ['limit' => 200]);
        $people = $this->Privileges->People->getPeopleWithIcon();
        $this->set(compact('privilege', 'parts', 'people'));
        $this->set('_serialize', ['privilege']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Privilege id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $privilege = $this->Privileges->get($id, [
            'contain' => ['Parts', 'People']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $privilege = $this->Privileges->patchEntity($privilege, $this->request->data);
            if ($this->Privileges->save($privilege)) {
                $this->Flash->success(__('The privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The privilege could not be saved. Please, try again.'));
            }
        }
        $parts = $this->Privileges->Parts->find('list', ['limit' => 200])
            ->order([
                'sort_order' => "ASC"
            ]);

        $people = $this->Privileges->People->getPeopleWithIcon();

        $this->set(compact('privilege', 'parts', 'people'));
        $this->set('_serialize', ['privilege']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Privilege id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $privilege = $this->Privileges->get($id);
        if ($this->Privileges->delete($privilege)) {
            $this->Flash->success(__('The privilege has been deleted.'));
        } else {
            $this->Flash->error(__('The privilege could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
