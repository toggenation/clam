<?php
$this->Html->script('clam-assignments', ['block' => 'from_view']);
$this->Html->css('bootstrap-timepicker.min', ['block' => 'cssFromView']);
$ctr = 0;
?>

<ul  class="nav nav-pills">
    <?php foreach ($schedules as $sch): ?>
        <li class="nav-item"><?= $this->Html->link($sch->month . ' ' . $sch->year, ['action' => 'add-assignments', $sch->id], ['class' => 'nav-link' ]); ?></li>
    <?php endforeach; ?>
</ul>

<?php ?>
<?php if (!$meetings->isEmpty()): ?>

    <h3>Add Parts to CL&M for <?= h($month); ?></h3>

    <?= $this->Form->create($schedule, ['class' => 'form-group-sm']); ?>

    <div class="col-lg-12">

        <?php foreach ($meetings as $mtg_key => $meeting): ?>
            <div class="well">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="pull-left">Meeting Date <?= h($meeting->date) ?></h4><div class="pull-right"><?= $this->Form->submit(); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 remove"><?= $this->Html->tag('span', '', ['class' => 'pull-left glyphicon glyphicon-check']); ?></div>
                    <div class="col-lg-3"><b>Start Time</b></div>

                    <div class="col-lg-6"><b>Part Title</b></div>
                    <div class="col-lg-1"><b>Mins.</b></div>
        <!--                <th>Assistant, Reader, Prayer</th>
                  <th>Assigned</th>-->

                </div>


                <?php foreach ($parts as $part): ?>
                    <?php if (!in_array($part->id, array_keys($skip[$mtg_key]))): ?>
                        <div class="row">
                            <div class="col-lg-2"><?php
                                echo $this->Form->input('Assigned.' . $ctr . '.remove', ['type' => 'checkbox'
                                ]);
                                ?></div>
                            <?= $this->Form->hidden('Assigned.' . $ctr . '.id', ['label' => false]); ?>
                            <?= $this->Form->hidden('Assigned.' . $ctr . '.part_id', ['value' => $part->id, 'label' => false]); ?>
                            <?= $this->Form->hidden('Assigned.' . $ctr . '.meeting_id', ['value' => $meeting->id, 'label' => false]); ?>
                <?= $this->Form->hidden('Assigned.' . $ctr . '.schedule_id', ['value' => $meeting->schedule_id, 'label' => false]); ?>

                            <div class="col-lg-3"><?php
                                echo $this->Form->input('Assigned.' . $ctr . '.start_time', [
                                    'type' => 'time',
                                    'value' => $part->start_time,
                                    'label' => false,
                                    'timeFormat' => 12
                                ]);
                                ?></div>
                            <div class="col-lg-6"><?php
                                echo $this->Form->input('Assigned.' . $ctr . '.part_title', [
                                    'value' => $part->partname,
                                    'label' => false
                                        ]
                                );
                                ?></div>
                            <div class="col-lg-1"><?php
                                echo $this->Form->input('Assigned.' . $ctr . '.minutes', [
                                    'value' => $part->minutes,
                                    'label' => false
                                ]);
                                ?></div>
                <!--                        <td><?php
                            echo $this->Form->input('Assigned.' . $ctr . '.person_id', [
                                'empty' => '(please select)',
                                'options' => $people,
                                'label' => 'Assigned/Student',
                                'label' => false
                            ]);
                            ?></td>
                            <td><?php
                            echo $this->Form->input('Assigned.' . $ctr . '.assistant_id', [
                                'label' => 'Assistant/Reader',
                                'empty' => '(please select)',
                                'options' => $people,
                                'label' => false
                            ]);
                            ?></td>-->

                        </div>
                    <?php endif ?>
                    <?php $ctr++ ?>
                <?php endforeach; ?>
                <?php if ($meeting->has('meeting_note')): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><?= $meeting->meeting_note->heading; ?>

                                    <?= $this->Html->link('Edit meeting note', ['controller' => 'meeting-notes', 'action' => 'edit', $meeting->meeting_note->id], ['class' => 'btn btn-default btn-xs pull-right'], ['class' => 'nav-link' ]); ?>
                                </div>
                                <div class="panel-body">

                                    <p><?= $meeting->meeting_note->note; ?> </p>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>
    <?= $this->Form->end(); ?>
<?php else: ?>
    <h1>Please add some meetings to <?= $month ?></h1><p><?=
        $this->Html->link(
                "Click here", ['controller' => 'meetings',
            'action' => 'add-meetings',
            $schedule_id
        ]);
        ?></p>

<?php endif; ?> <!-- end of if empty meetings -->

