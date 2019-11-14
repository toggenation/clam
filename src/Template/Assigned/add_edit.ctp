<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>


<ul class="nav nav-pills">
    <li class="heading">Edit</li>
    <?php foreach ($schedules as $sch) : ?>
        <li class="nav-item">
            <?= $this->Html->link(
                    $sch->month . ' ' . $sch->year,
                    ['action' => 'edit-assignments', $sch->id],
                    ['class' => 'nav-link']
                ); ?></li>
    <?php endforeach; ?>
</ul>
