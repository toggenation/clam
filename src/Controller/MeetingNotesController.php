<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MeetingNotes Controller
 *
 * @property \App\Model\Table\MeetingNotesTable $MeetingNotes
 */
class MeetingNotesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $mn = $this->MeetingNotes->find()->contain(['Meetings' => [
					'Schedules'
					]]);

					// didn't work to + [Meetings.date] onto a numerically indexed field list
					$whiteList = $this->MeetingNotes->getSchema()->columns() ;
					array_push( $whiteList, 'Meetings.date');

				$meetingNotes = $this->paginate($mn, [
					'limit' => 10,
					'sortWhitelist' => $whiteList, // have to add Meetings.date to whitelist in order for the order key to work
					'order' => [
						'Meetings.date' => 'DESC'
					]
				]);

        $this->set(compact('meetingNotes'));
        $this->set('_serialize', ['meetingNotes']);
    }

    /**
     * View method
     *
     * @param string|null $id Meeting Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $meetingNote = $this->MeetingNotes->get($id, [
            'contain' => []
        ]);

        $this->set('meetingNote', $meetingNote);
        $this->set('_serialize', ['meetingNote']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($meeting_id = null, $schedule_id = null )
    {
        $meetingNote = $this->MeetingNotes->newEntity();
        if ($this->request->is('post')) {
					  if (! empty ($this->request->data['callingScheduleId'])){
							$schedule_id = $this->request->data['callingScheduleId'];
						}
            $meetingNote = $this->MeetingNotes->patchEntity($meetingNote, $this->request->data);
            if ($this->MeetingNotes->save($meetingNote)) {
                $this->Flash->success(__('The meeting note has been saved.'));
								if ($schedule_id !== null) {
									return $this->redirect(['controller' => 'Assigned', 'action' => 'editAssignments', $schedule_id ]);
								}
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting note could not be saved. Please, try again.'));
            }
        }

        $meetings = $this->MeetingNotes->Meetings->find('list')->order(['date' => 'DESC']);

        if (! empty($meeting_id)){


             $this->request->data['meeting_id'] = $meeting_id;

        }

				if($schedule_id !== null ){
					$this->set('callingScheduleId', $schedule_id);
					$this->request->data['callingScheduleId'] = $schedule_id;
				}
        $this->set(compact('meetingNote', 'meetings'));
        $this->set('_serialize', ['meetingNote']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Meeting Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $schedule_id = null)
    {
        $meetingNote = $this->MeetingNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
					  if(! empty( $this->request->data['callingScreen'])) {
							$schedule_id = $this->request->data['callingScreen'];
						}

            $meetingNote = $this->MeetingNotes->patchEntity($meetingNote, $this->request->data);
            if ($this->MeetingNotes->save($meetingNote)) {
                $this->Flash->success(__('The meeting note has been saved.'));
								if($schedule_id !== null){
									return $this->redirect([
										'controller' => 'Assigned',
										'action' => 'editAssignments',
										$schedule_id
									]);
								}
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The meeting note could not be saved. Please, try again.'));
            }
        }

        $meetings = $this->MeetingNotes->Meetings->find('list');
				if( $schedule_id !== null) {
					$this->request->data['callingScheduleId'] = $schedule_id;
				}
        $this->set(compact('meetingNote', 'meetings'));
        $this->set('_serialize', ['meetingNote']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meeting Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $meetingNote = $this->MeetingNotes->get($id);
        if ($this->MeetingNotes->delete($meetingNote)) {
            $this->Flash->success(__('The meeting note has been deleted.'));
        } else {
            $this->Flash->error(__('The meeting note could not be deleted. Please, try again.'));
        }
		if ( isset($this->request->data['controller']) && $this->request->data['controller'] === 'Assigned' && $this->request->data['action'] === 'editAssignments') {

            return $this->redirect(
                [
                    'controller' => 'Assigned' , 'action' => 'editAssignments' ,
                    $this->request->data['pass'][0]
                ]
            );
        }

        return $this->redirect(['action' => 'index']);
    }
}
