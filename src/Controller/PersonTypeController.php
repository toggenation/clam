<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PersonType Controller
 *
 * @property \App\Model\Table\PersonTypeTable $PersonType
 */
class PersonTypeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $personType = $this->paginate($this->PersonType);

        $this->set(compact('personType'));
        $this->set('_serialize', ['personType']);
    }

    /**
     * View method
     *
     * @param string|null $id Person Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $personType = $this->PersonType->get($id, [
            'contain' => []
        ]);

        $this->set('personType', $personType);
        $this->set('_serialize', ['personType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $personType = $this->PersonType->newEntity();
        if ($this->request->is('post')) {
            $personType = $this->PersonType->patchEntity($personType, $this->request->data);
            if ($this->PersonType->save($personType)) {
                $this->Flash->success(__('The person type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('personType'));
        $this->set('_serialize', ['personType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Person Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $personType = $this->PersonType->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $personType = $this->PersonType->patchEntity($personType, $this->request->data);
            if ($this->PersonType->save($personType)) {
                $this->Flash->success(__('The person type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('personType'));
        $this->set('_serialize', ['personType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $personType = $this->PersonType->get($id);
        if ($this->PersonType->delete($personType)) {
            $this->Flash->success(__('The person type has been deleted.'));
        } else {
            $this->Flash->error(__('The person type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
