<?php
 $this->Html->script([
     'moment-with-locales.min',
    'bootstrap4-timepicker/tempusdominus-bootstrap-4',
    'clam'
     ], ['block' => 'from_view']);

echo $this->Html->css([
   'bootstrap4-timepicker/tempusdominus-bootstrap-4'
    ],
    [
        'block' => true
        ]);
?>

<div class="row">

<div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['controller' => 'Meetings', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-5">
    <?= $this->Form->create($schedule) ?>
    <legend><?= __('Add Schedule') ?></legend>
    <div class="row">
        <div class="col-lg-12">
       <?php $this->Form->templates([
    'inputContainer' => '{{content}}'
]); ?>
         <div class="form-group">
            <label class="control-label">Start and End Dates</label>
            <div id="schedule-container">
                <div class="input-group input-group-sm input-daterange">
                <?= $this->Form->control(
                            'start_date', [
                                'autocomplete' => 'off',
                                'error' => false,
                                'label' => false,
                                'type' => 'text',
                                'data-toggle'=>"datetimepicker",
                                'id' => 'datetimepicker1',
                                'data-target'=>"#datetimepicker1",
                                'class' => "datetimepicker-input input-sm form-control"
                                ]
                        );
                        ?>
                <div class="input-group-prepend input-group-append">
                    <div class="input-group-text">to</div>
                </div>
                <?= $this->Form->control('end_date',
                        [
                            'autocomplete' => 'off',
                            'id' => 'datetimepicker2',
                            'data-target'=>"#datetimepicker2",
                            'class' => "datetimepicker-input input-sm form-control",
                            'data-toggle'=>"datetimepicker",
                            'error' => false,
                            'label' => false,
                            'type' => 'text']
                        );
                        ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php echo $this->Form->input('comment', [
        'class' => 'form-control-sm mb-4'
    ]); ?>
    <?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
</div>
</div>
