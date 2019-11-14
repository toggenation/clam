<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string|null $congregation
 * @property string|null $application_name
 * @property int|null $meetings_per_page
 * @property string|null $author
 * @property string|null $custom_field_1
 * @property string|null $custom_field_2
 * @property string|null $custom_field_3
 * @property string|null $custom_field_4
 */
class Setting extends Entity
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
        'congregation' => true,
        'application_name' => true,
        'meetings_per_page' => true,
        'author' => true,
        'custom_field_1' => true,
        'custom_field_2' => true,
        'custom_field_3' => true,
        'custom_field_4' => true
    ];
}
