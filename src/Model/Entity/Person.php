<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity.
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Assigned[] $assigned
 * @property \App\Model\Entity\Role[] $roles
 */
class Person extends Entity
{

//    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    //{
    //        $this->log($data);
    //    foreach ($data as $key => $value) {
    //
    //        if (is_string($value)) {
    //            $data[$key] = trim($value);
    //        }
    //    }
    //}

    /**
     * @return mixed
     */
    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' .
        $this->_properties['lastname'];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
