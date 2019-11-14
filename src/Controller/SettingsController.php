<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Log\LogTrait;

/**
 * Settings Controller
 *
 */

class SettingsController extends AppController
{
    use LogTrait;

    public function index()
    {
            return     $this->redirect(['action' => 'configure']);
    }
    public function configure()
    {

        if ($this->request->is(['PUT', 'POST'])) {
            Configure::write('CLAM', $this->request->data);
            Configure::dump('clam', 'clam', ['CLAM', 'MORESETTINGS']);
        }

        $appSettings = Configure::read('CLAM');
        $deleteValuesArray = array_keys($appSettings);
        $deleteValues = array_combine($deleteValuesArray, $deleteValuesArray);
        $this->set(compact('appSettings', 'deleteValues'));
        $this->set('_serialize', true);
    }
    public function addSetting()
    {
        if ($this->request->is(['PUT', 'POST'])) {
            $appSettings = Configure::read('CLAM');

            $newValue = $this->request->data['newSettingValue'];

            if (!in_array($newValue, $appSettings)) {
                $appSettings += [
                    $newValue => '',
                ];
            }
            if (!empty($newValue)) {
                Configure::write(
                    'CLAM',
                    $appSettings
                );

                Configure::dump('clam', 'clam', ['CLAM', 'MORESETTINGS']);

                sleep(3);
            }

            $this->redirect(['action' => 'configure']);
        }
    }
    public function delete()
    {
        if ($this->request->is(['POST', 'PUT'])) {
            $this->log($this->request->data);
            Configure::delete('CLAM.' . $this->request->data['delete']);
            Configure::dump('clam', 'clam', ['CLAM', 'MORESETTINGS']);
            sleep(3);
            $this->redirect(['action' => 'configure']);
        }
    }
}
