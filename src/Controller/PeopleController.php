<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController {

    public function viewWho($schedule_id) {

        $assignments = $this->People->getAssignments($schedule_id);

        $this->loadModel('Schedules');

        $schedule = $this->Schedules->find()->
                where(['id' => $schedule_id])->first();

        $this->set(compact('assignments', 'schedule'));

        $this->set('_serialize', ['assignments']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {


        $people = $this->paginate($this->People, [ 'order' => [
					'firstname' => 'ASC',
					'lastname' => 'ASC'

					]]);

        $people_lookup = $this->People
                        ->find()
                        ->select(['id', 'firstname', 'lastname'])
                        ->formatResults(function($results) {
                            /* @var $results \Cake\Datasource\ResultSetInterface|\Cake\Collection\CollectionInterface */
                            return $results->combine(
                                            'id', function($row) {
                                        return $row['full_name'];
                                    }
                            );
                        })->order(['firstname' => "ASC"]);
        $this->set(compact('people', 'people_lookup'));
        $this->set('_serialize', ['people']);
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $person = $this->People->get($id, [
            'contain' => ['Privileges', 'Assigned' => ['Meetings']]
        ]);

        $this->set('person', $person);
        $this->set('_serialize', ['person']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $person = $this->People->newEntity();
        if ($this->request->is('post')) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success(__('The person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person could not be saved. Please, try again.'));
            }
        }
        $privileges = $this->People->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('person', 'privileges'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        if (empty($id)) {
            if (!empty($this->request->query('person'))) {
                $id = $this->request->query('person');
            }
        }

        if (empty($id)) {
            return $this->redirect(['action' => 'index']);
        }

        $person = $this->People->get($id, [
            'contain' => ['Privileges']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success(__('The person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The person could not be saved. Please, try again.'));
            }
        }
        $privileges = $this->People->Privileges->find('list', ['limit' => 200]);
        $this->set(compact('person', 'privileges'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->People->get($id);
        if ($this->People->delete($person)) {
            $this->Flash->success(__('The person has been deleted.'));
        } else {
            $this->Flash->error(__('The person could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
