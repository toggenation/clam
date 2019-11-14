<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Section Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $sort_order
 * @property bool $heading
 * @property \App\Model\Entity\Part[] $parts
 */
class Section extends Entity
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
