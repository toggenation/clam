<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MeetingSections Controller
 *
 * @property \App\Model\Table\MeetingSectionsTable $MeetingSections
 */
class MeetingSectionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $meetingSections = $this->paginate($this->MeetingSections);

        $this->set(compact('meetingSections'));
        $this->set('_serialize', ['meetingSections']);
    }

    /**
     * View method
     *
     * @param string|null $id Meeting Section id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $meetingSection = $this->MeetingSections->get($id, [
            'contain' => ['Parts']
        ]);

        $this->set('meetingSection', $meetingSection);
        $this->set('_serialize', ['meetingSection']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $meetingSection = $this->MeetingSections->newEntity();
        if ($this->request->is('post')) {
            $meetingSection = $this->MeetingSections->patchEntity($meetingSection, $this->request->data);
            if ($this->MeetingSections->save($meetingSection)) {
                $this->Flash->success(__('The meeting section has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting section could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('meetingSection'));
        $this->set('_serialize', ['meetingSection']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meeting Section id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $meetingSection = $this->MeetingSections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $meetingSection = $this->MeetingSections->patchEntity($meetingSection, $this->request->data);
            if ($this->MeetingSections->save($meetingSection)) {
                $this->Flash->success(__('The meeting section has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting section could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('meetingSection'));
        $this->set('_serialize', ['meetingSection']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meeting Section id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $meetingSection = $this->MeetingSections->get($id);
        if ($this->MeetingSections->delete($meetingSection)) {
            $this->Flash->success(__('The meeting section has been deleted.'));
        } else {
            $this->Flash->error(__('The meeting section could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
