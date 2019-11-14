<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PeoplePrivileges Controller
 *
 * @property \App\Model\Table\PeoplePrivilegesTable $PeoplePrivileges
 */
class PeoplePrivilegesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['People', 'Privileges']
        ];
        $peoplePrivileges = $this->paginate($this->PeoplePrivileges);

        $this->set(compact('peoplePrivileges'));
        $this->set('_serialize', ['peoplePrivileges']);
    }

    /**
     * View method
     *
     * @param string|null $id People Privilege id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $peoplePrivilege = $this->PeoplePrivileges->get($id, [
            'contain' => ['People', 'Privileges']
        ]);

        $this->set('peoplePrivilege', $peoplePrivilege);
        $this->set('_serialize', ['peoplePrivilege']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $peoplePrivilege = $this->PeoplePrivileges->newEntity();
        if ($this->request->is('post')) {
            $peoplePrivilege = $this->PeoplePrivileges->patchEntity($peoplePrivilege, $this->request->data);
            if ($this->PeoplePrivileges->save($peoplePrivilege)) {
                $this->Flash->success(__('The people privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The people privilege could not be saved. Please, try again.'));
            }
        }
        $people = $this->PeoplePrivileges->People->find('list', ['limit' => 200]);
        $privileges = $this->PeoplePrivileges->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('peoplePrivilege', 'people', 'privileges'));
        $this->set('_serialize', ['peoplePrivilege']);
    }

    /**
     * Edit method
     *
     * @param string|null $id People Privilege id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $peoplePrivilege = $this->PeoplePrivileges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $peoplePrivilege = $this->PeoplePrivileges->patchEntity($peoplePrivilege, $this->request->data);
            if ($this->PeoplePrivileges->save($peoplePrivilege)) {
                $this->Flash->success(__('The people privilege has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The people privilege could not be saved. Please, try again.'));
            }
        }
        $people = $this->PeoplePrivileges->People->find('list', ['limit' => 200]);
        $privileges = $this->PeoplePrivileges->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('peoplePrivilege', 'people', 'privileges'));
        $this->set('_serialize', ['peoplePrivilege']);
    }

    /**
     * Delete method
     *
     * @param string|null $id People Privilege id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $peoplePrivilege = $this->PeoplePrivileges->get($id);
        if ($this->PeoplePrivileges->delete($peoplePrivilege)) {
            $this->Flash->success(__('The people privilege has been deleted.'));
        } else {
            $this->Flash->error(__('The people privilege could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
