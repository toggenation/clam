<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assigned Entity.
 *
 * @property int $id
 * @property int $part_id
 * @property \App\Model\Entity\Part $part
 * @property int $minutes
 * @property string $part_title
 * @property int $meeting_id
 * @property \App\Model\Entity\Meeting $meeting
 * @property int $person_id
 * @property \App\Model\Entity\Person $person
 * @property int $assistant_id
 * @property \App\Model\Entity\Assistant $assistant
 */
class Assigned extends Entity
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
