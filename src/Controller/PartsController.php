<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 */
class PartsController extends AppController
{


    public $paginate = [

            'order' =>
            [ 'Parts.sort_order' => 'asc'],
            'limit' => 6
    ];


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate += [
            'contain' => ['Sections']
        ];
        $parts = $this->paginate($this->Parts);

        $this->set(compact('parts'));
        $this->set('_serialize', ['parts']);
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => [
                'Sections',
                'Roles',
                'Assigned' => [
                    'Meetings',
                    'Assistants',
                    'People'
                ]]
        ]);

        $this->set('part', $part);
        $this->set('_serialize', ['part']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $part = $this->Parts->newEntity();
        if ($this->request->is('post')) {
            $part = $this->Parts->patchEntity($part, $this->request->data);
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The part has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The part could not be saved. Please, try again.'));
            }
        }

        $link_parts = $this->Parts->find('list',
                ['keyField' => 'id',
                    'valueField' => 'partname']

                );

        $sections = $this->Parts->Sections->find('list', ['limit' => 200]);
        $roles = $this->Parts->Roles->find('list', ['limit' => 200]);
        $this->set(compact('part', 'link_parts', 'sections', 'roles'));
        $this->set('_serialize', ['part']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $part = $this->Parts->get($id, [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $part = $this->Parts->patchEntity($part, $this->request->data);
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('The part has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The part could not be saved. Please, try again.'));
            }
        }

         $link_parts = $this->Parts->find('list',
                ['keyField' => 'id',
                    'valueField' => 'partname']

                );
        $sections = $this->Parts->Sections->find('list', ['limit' => 200]);
        $roles = $this->Parts->Roles->find('list', ['limit' => 200]);
        $this->set(compact('part', 'sections', 'roles', 'link_parts'));
        $this->set('_serialize', ['part']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The part has been deleted.'));
        } else {
            $this->Flash->error(__('The part could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
