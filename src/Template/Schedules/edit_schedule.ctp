<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$ctr = 0;
?>

<h1>Schedule for month of <?= $schedule->month; ?></h1>

<?= $this->Form->create('Assigned', ['url' => ['controller' => 'assigned', 'action' => 'saveSchedule']]); ?>

<table class="table table-bordered table-condensed table-striped table-responsive">

    <?php foreach ($schedule->meetings as $meetings): ?>
        <tr><th colspan="7">Meeting Date <?= h($meetings->date) ?><div class="pull-right"><?= $this->Form->submit(); ?></div></th></tr>
        <?php foreach ($parts as $part): ?>
            <tr>
                <td><?= h($part->partname); ?></td>
                <?= $this->Form->hidden('Assigned.' . $ctr . '.part_id', ['value' => $part->id]); ?>
                <?= $this->Form->hidden('Assigned.' . $ctr . '.meeting_id', ['value' => $meetings->id]); ?>
               <?= $this->Form->hidden('Assigned.' . $ctr . '.schedule_id', ['value' => $schedule->id]); ?>
                <td><?= $this->Form->input('Assigned.' . $ctr . '.part_title',[
                    'value' => $part->partname
                ]

                        ); ?></td>
                <td><?= $this->Form->input('Assigned.' . $ctr . '.start_time'); ?></td>
                <td><?= $this->Form->input('Assigned.' . $ctr . '.minutes', [
                    'value' => $part->minutes
                ]); ?></td>
                <td><?php
        echo $this->Form->input('Assigned.' . $ctr . '.person_id', [
            'empty' => '(please select)',
            'options' => $people,
            'label' => 'Assigned/Student']);
                ?></td>
                <td><?php
                    echo $this->Form->input('Assigned.' . $ctr . '.assistant_id', [
                        'label' => 'Assistant/Reader',
                        'empty' => '(please select)',
                        'options' => $people,
                    ]);
                    ?></td>

            </tr>
        <?php $ctr++ ?>
    <?php endforeach; ?>

    </li>


<?php endforeach; ?>
</table>
<?= $this->Form->end(); ?>

<?php debug($parts->toArray()); ?>
<?php
debug($schedule->toArray());
