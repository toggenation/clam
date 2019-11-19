<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PeopleRoles Controller
 *
 * @property \App\Model\Table\PeopleRolesTable $PeopleRoles
 */
class PeopleRolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['People', 'Roles']
        ];
        $peopleRoles = $this->paginate($this->PeopleRoles);

        $this->set(compact('peopleRoles'));
        $this->set('_serialize', ['peopleRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id People Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $peopleRole = $this->PeopleRoles->get($id, [
            'contain' => ['People', 'Roles']
        ]);

        $this->set('peopleRole', $peopleRole);
        $this->set('_serialize', ['peopleRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $peopleRole = $this->PeopleRoles->newEntity();
        if ($this->request->is('post')) {
            $peopleRole = $this->PeopleRoles->patchEntity($peopleRole, $this->request->data);
            if ($this->PeopleRoles->save($peopleRole)) {
                $this->Flash->success(__('The people role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The people role could not be saved. Please, try again.'));
            }
        }
        $people = $this->PeopleRoles->People->find('list', ['limit' => 200]);
        $roles = $this->PeopleRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('peopleRole', 'people', 'roles'));
        $this->set('_serialize', ['peopleRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id People Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $peopleRole = $this->PeopleRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $peopleRole = $this->PeopleRoles->patchEntity($peopleRole, $this->request->data);
            if ($this->PeopleRoles->save($peopleRole)) {
                $this->Flash->success(__('The people role has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The people role could not be saved. Please, try again.'));
            }
        }
        $people = $this->PeopleRoles->People->find('list', ['limit' => 200]);
        $roles = $this->PeopleRoles->Roles->find('list', ['limit' => 200]);
        $this->set(compact('peopleRole', 'people', 'roles'));
        $this->set('_serialize', ['peopleRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id People Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $peopleRole = $this->PeopleRoles->get($id);
        if ($this->PeopleRoles->delete($peopleRole)) {
            $this->Flash->success(__('The people role has been deleted.'));
        } else {
            $this->Flash->error(__('The people role could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
