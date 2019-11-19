<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PeopleRole Entity.
 *
 * @property int $id
 * @property int $person_id
 * @property \App\Model\Entity\Person $person
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 */
class PeopleRole extends Entity
{

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
        'id' => false,
    ];
}
