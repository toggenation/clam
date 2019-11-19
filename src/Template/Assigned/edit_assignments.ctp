<?php
echo $this->Html->script(
    [
        'moment-with-locales.min',
        'bootstrap4-timepicker/tempusdominus-bootstrap-4',
        'clam-assignments',
    ],
    ['block' => 'from_view']
);


$this->Html->css([
    'bootstrap4-timepicker/tempusdominus-bootstrap-4',
        'clam'
    ],
    [
        'block' => 'cssFromView'
        ]); ?>
<div class="btn-group btn-group-xs" role="group" aria-label="...">
  <?php foreach ($meetings as $mtg_key => $meeting): ?>
			<?=$this->Html->link(
    $this->Time->format($meeting->date, 'eee d MMM yyy'),
    '#' . $this->Time->format($meeting->date, 'yyyMMdd'),
    [
        "class" => "btn btn-default bring-forward"

    ]
); ?>
	<?php endforeach; ?>
</div>

    <?php $ctr = 0; ?>

<?php if (!$meetings->isEmpty()): ?>
    <h3 class="bring-forward">Assignments for month of <?=h($month); ?></h3>
    <?=$this->Form->create($assigned, [
    'class' => 'form-group form-group-sm',

]);
?>
    <?php foreach ($meetings as $mtg_key => $meeting): ?>

        <div class="card card-body bg-light meeting mb-4">

            <div class="row">
                <div class="col-lg-4">
                    <h4 class="jumptarget" id="<?= $this->Time->format($meeting->date, 'yyyMMdd'); ?>">
                        Meeting Date <?=$this->Time->format($meeting->date, 'eee d MMM yyy') ?>
                    </h4>

                </div>
                <div class="col">
                    <?=$this->Html->link(
    $this->Icon->faIcon('fas fa-arrow-up'),
    '#top',
    [
        'escape' => false,
        'class' => 'btn btn-link btn-sm float-right',
        'title' => "Back to top",
    ]
) ?>
                </div>
            </div>
            <div class="row">

                    <div class="col">
                    <div class='form-inline'>
                        <div class="mt-1">
                        <?=$this->Form->input('Meetings.' . $mtg_key . '.co_visit', [
    'type' => 'checkbox',
    'escape' => false,
    'label' => "&nbspCircuit Overseer Visit&nbsp;",
    'checked' => $meeting->co_visit,
]); ?> </div>
                        </div>
                    </div>
                    <div class="col">
                    <div class='form-inline'>
                        <?=$this->Form->input('Meetings.' . $mtg_key . '.person_id', [
    'options' => $meetingChairmen,
    'empty' => '(select)',
    'escape' => false,
    'class' => 'form-control-sm',
    'label' => 'Chairmen&nbsp;',
    'value' => $meeting->person_id,
]); ?>
                         </div>
                    </div>
                    <div class="col">
                    <div class='form-inline'>
                        <?=$this->Form->input(
    'Meetings.' . $mtg_key . '.auxiliary_counselor_id',
    [
        'label' => "Auxiliary Counselor&nbsp;",
        'class' => 'form-control-sm',
        'escape' => false,
        'options' => $auxCounselors,
        'empty' => '(select)',
        'value' => $meeting->auxiliary_counselor_id,
    ]
); ?>
                                   </div> <!-- form-inline -->
                    </div>

            </div> <!-- row -->
            <div class="row mt-3 mb-2">
                <div class="col offset-lg-8">
                    <?=$this->Form->input(
    'Meetings.' . $mtg_key . '.id',
    [
        'value' => $meeting->id,
    ]); ?>
                    <?=$this->Html->link(
    $this->Icon->faIcon('fas fa-eye') . ' Preview',
    [
        'controller' => 'schedules',
        'action' => 'pdf-view',
        $schedule_id,
    ],
    [
        'escape' => false,
        'class' => 'btn btn-sm',
        'target' => '_blank']
); ?>

                    <?=$this->Form->button(
    $this->Icon->faIcon('fas fa-save') . ' Save',
    [
        'type' => 'submit',
        'escape' => false,
        'class' => 'btn btn-sm btn-link',
    ]
); ?>

                    <?=$this->Form->postLink(
    $this->Icon->faIcon('fas fa-share-square') .
    ' Publish', [
        'controller' => 'Schedules',
        'action' => 'publishSchedule',
        $schedule_id,

    ], [
        'method' => "POST",
        'confirm' => "Do you want to publish this CLAM schedule",
        'block' => true,
        'class' => 'btn btn-sm',
        'escape' => false,
    ]);
?>

			</div>
        </div>


        <?php if (empty($meeting->assigned)): ?>

                <div class="row">
                    <div class="col-lg-12">
            <?=
//postLink(string $title, mixed $url = null, array $options = [])
$this->Form->postLink(
    $this->Icon->faIcon('far fa-plus-square') .
    ' Click to add parts', [
        'controller' => 'Assigned',
        'action' => 'add-assignments',
        $schedule_id,
        $meeting->id,
    ], [
        'escape' => false,
        'method' => "POST",
        'confirm' => "Do you want to add parts",
        'block' => true,
        'class' => 'btn btn-default bpad tpad',
    ]);
?>
    </div>
                </div>
            <?php else: ?>
                <div class="row">

                    <div class="col-lg-1 remove">
                        <?=$this->Html->tag(
    'span',
    '',
    [
        'role' => 'button',
        'class' => 'far fa-check-square',
    ]); ?>
                    </div>
                    <div class="col-lg-1 text-center">
                        <?=$this->Html->tag('span',
    '',
    [
        'role' => 'button',
        'class' => 'start-link far fa-clock',
        'title' => 'Update timings',
    ]
); ?>
                    </div>
                    <div class="col-lg-3"><h6 class="text-center">Part Title</h6></div>
                    <div class="col-lg-1 clam-minutes"><h6 class="text-center">
                        <?= $this->Html->image('baseline-timer-24px.svg', [
                            'style' => "width: 18px; height: 18 px;"
                        ]) ;?>
                    </h6></div>
                    <div class="col-lg-2"><h6 class="text-center">Auxiliary School</h6></div>
                    <div class="col-lg-1"><h6>History</h6></div>
                    <div class="col-lg-2"><h6 class="text-center">Main Hall</h6></div>
                    <div class="col-lg-1"><h6>History</h6></div>
                </div>
								<?php

$keys = array_keys($meeting->assigned);
$lastElementsOfParts = end($keys);

?>
            <?php foreach ($meeting->assigned as $elem => $part): ?>

                    <div class="row">
                        <div class="col-lg-1"><?php
echo $this->Form->input('Assigned.' . $ctr . '.remove', [

    'type' => 'checkbox',
    'label' => 'Remove',
    'class' => 'clam-cb form-control-sm',
]);
?></div>
                        <div class="col-lg-1"><?php
                        $controlName = 'Assigned.' . $ctr . '.start_time';
                        $controlId = str_replace('.', '', $controlName );
echo $this->Form->control(
    $controlName,
    [   'templates' => [
            'inputContainer' => '{{content}}',
    ],
        'div' => false,
        'id' => $controlId,
        //'data-toggle'=>"datetimepicker",
        'data-target'=> "#" . $controlId,
        //'append' => $this->Html->glIcon('time'),
         //'class' => 'datetimepicker-input start-time form-control-sm',
         'class' => 'start-time form-control-sm',
        'label' => false,
        'type' => 'text',
    ]
);
?>
</div>
                            <?=$this->Form->hidden('Assigned.' . $ctr . '.id'); ?>
                            <?=$this->Form->hidden('Assigned.' . $ctr . '.part_id'); ?>
                         <?=$this->Form->hidden('Assigned.' . $ctr . '.co_visit'); ?>
                            <?=$this->Form->hidden('Assigned.' . $ctr . '.meeting_id'); ?>

                        <div class="col-lg-3">

                <?php if (!empty($part->part->replace_token) && (strpos($part->part_title, $part->part->replace_token) !== false)): ?>
                    <?php
echo $this->Form->hidden('Assigned.' . $ctr . '.part_title', ['label' => false]);
echo $this->Form->hidden('Assigned.' . $ctr . '.replace_token', [
    'value' => $part->part->replace_token,
]);
echo $this->Form->input('Assigned.' . $ctr . '.replace_token_value', [
    'placeholder' => $part->part_title,
    'title' => "Enter a song number",
    'class' => 'form-control-sm',
    'label' => false]);
?>
                            <?php else: ?>
                                <?php
echo $this->Form->input('Assigned.' . $ctr . '.part_title', [
    'label' => false,
    'class' => 'form-control-sm',
]);
?>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-1">
                            <?php
echo $this->Form->input('Assigned.' . $ctr . '.minutes', [
    'class' => 'clam-minutes form-control-sm',

    'label' => false,
    'data-counsel_mins' => $part->part->counsel_mins,
]);
?></div>
                        <div class="col-lg-2">
													<?php

if ($part->part->has_auxiliary === true) {
    echo $this->Form->input('Assigned.' . $ctr . '.aux_person_id', [
        'templates' => [
            'inputContainer' => '<div class="form-group select">{{content}}</div>',
        ],
        'empty' => '(please select)',
        'class' => 'aux_assigned auxiliary form-control-sm',
        'options' => $roles[$part->part_id]['assigned'],
        'label' => [
            'class' => 'sr-only',

        ]]);

    if ($part->part->assistant === true) {
        if (!empty($roles[$part->part_id]['assistant'])) {
            $options = $roles[$part->part_id]['assistant'];
        } else {
            $options = $roles[$part->part_id]['assigned'];
        }

        if ($part->part->has_auxiliary === true) {
            echo $this->Form->input('Assigned.' . $ctr . '.aux_assistant_id', [
                'label' => false,
                'empty' => '(please select)',

                'options' => $options,
                'class' => 'aux_assistant auxiliary form-control-sm',
            ]);
        }
    }
}

?> </div>
                        <div class="col-lg-1">


														<?php

if (!($part->part->no_assign === true) && $part->part->has_auxiliary === true) {
    echo $this->Html->link(
        $this->Html->tag('span', '', [
            'title' => 'icon-1',
            'class' => 'icon-1 far fa-calendar-alt']),
        '#',
        [
            'class' => 'history-btn',
            'data-target_field' => 'aux_assigned',
            'data-toggle' => "modal",
            'data-target' => "#history",
            'escape' => false,
            'data-partname' => $part->part->partname,
            'data-schedule_id' => $meeting->schedule_id,
            'data-submit_url' => $this->Url->build(['action' => 'viewHistory', $part->part->id]),
        ],
        [
            'escape' => false,
        ]
    );
}
if ($part->part->assistant === true && $part->part->has_auxiliary === true) {
    ?> <div><?php
echo $this->Html->link(
        $this->Html->tag('span', '', [
            'title' => 'Icon 2',
            'class' => 'icon-2 far fa-calendar-alt']),
        '#',
        [
            'class' => 'history-btn',
            'data-target_field' => 'aux_assistant',
            'data-toggle' => "modal",
            'data-target' => "#history",
            'data-assistant' => $part->part->assistant,
            'escape' => false,
            'data-partname' => $part->part->partname,
            'data-schedule_id' => $meeting->schedule_id,
            'data-submit_url' => $this->Url->build(['action' => 'viewHistory', $part->part->id]),
        ],
        [
            'escape' => false,
        ]
    ); ?> </div> <?php
}

?>

                        </div>
                        <div class="col-lg-2"><!-- assigned -->

                <?php
if (!($part->part->no_assign === true)) {
    echo $this->Form->input('Assigned.' . $ctr . '.person_id', [
        'templates' => [
            'inputContainer' => '<div class="form-group select">{{content}}</div>',
        ],
        'empty' => '(please select)',
        'class' => 'person_id form-control-sm',
        'options' => $roles[$part->part_id]['assigned'],
        'label' => [
            'class' => 'sr-only',
        ]]);
}
if ($part->part->assistant === true) {
    if (!empty($roles[$part->part_id]['assistant'])) {
        $options = $roles[$part->part_id]['assistant'];
    } else {
        $options = $roles[$part->part_id]['assigned'];
    }

    echo $this->Form->input('Assigned.' . $ctr . '.assistant_id', [
        'label' => false,
        'empty' => '(please select)',
        'options' => $options,
        'class' => 'assistant_id form-control-sm',
    ]);
}

?>
                        </div>
                        <div class="col-lg-1">
                          <?php
if (!($part->part->no_assign === true)) {
    echo $this->Html->link(
        $this->Html->tag('span', '', [
            'title' => 'icon-3',
            'class' => 'icon-3 far fa-calendar-alt']),
        '#',
        [
            'class' => 'history-btn',
            'data-target_field' => 'person_id',
            'data-toggle' => "modal",
            'data-target' => "#history",
            'escape' => false,
            'data-partname' => $part->part->partname,
            'data-schedule_id' => $meeting->schedule_id,
            'data-submit_url' => $this->Url->build(['action' => 'viewHistory', $part->part->id]),
        ],
        [
            'escape' => false,
        ]
    );
}
if ($part->part->assistant === true) {
    if ($part->part->no_assign !== true) {
        ?> <div><?php
}
    /* adds specific class on 1 st row and last row */
    $iconClass = $elem === 0 || $elem === $lastElementsOfParts ? 'icon-4-top' : 'icon-4';
    echo $this->Html->link(
        $this->Html->tag('span', '', [
            'title' => 'icon-4',
            'class' => sprintf('%s far fa-calendar-alt', $iconClass),
        ]),
        '#',
        [
            'class' => 'history-btn',
            'data-target_field' => 'assistant_id',
            'data-toggle' => "modal",
            'data-target' => "#history",
            'data-assistant' => $part->part->assistant,
            'escape' => false,
            'data-partname' => $part->part->partname,
            'data-schedule_id' => $meeting->schedule_id,
            'data-submit_url' => $this->Url->build(['action' => 'viewHistory', $part->part->id]),
        ],
        [
            'escape' => false,
        ]
    );
    if ($part->part->no_assign !== true) {
        ?> </div><?php
}
}

?>
                        </div>


                    </div>

                <?php $ctr++ ?>
            <?php endforeach; ?>
        <?php endif; ?>
            <?php if ($meeting->has('meeting_note')): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-body">
                            <div class="card-title">
                                <h5><?=$meeting->meeting_note->heading; ?></h5>
                            </div>
                            <p class="card-text"><?=$meeting->meeting_note->note; ?> </p>
                            <div class="text-right">
							    <?=$this->Form->postLink(
                                    $this->Icon->faIcon('fas fa-trash-alt') .
                                    ' Delete meeting note',
                                    [
                                        'controller' => 'MeetingNotes',
                                        'action' => 'delete',
                                        $meeting->meeting_note->id,
                                    ],
                                    [
                                        'escape' => false,
                                        'method' => "POST",
                                        'data' => $this->request->params,
                                        'block' => true,
                                        'class' => 'btn btn-default btn-sm',
                                        'confirm' => 'Do you really want to delete this meeting note?',
                                    ]
                                ); ?>
                                <?=$this->Html->link(
                                    $this->Icon->faIcon('fas fa-edit') .
                                    ' Edit meeting note',
                                    [
                                        'controller' => 'meeting-notes',
                                        'action' => 'edit',
                                        $meeting->meeting_note->id, $schedule_id,
                                    ],
                                    [
                                        'escape' => false,
                                        'class' => 'btn btn-default btn-sm',
                                    ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
            <div class="row mt-3">
                <div class="offset-lg-8 col-lg-2">
            <?php if (!$meeting->has('meeting_note')): ?>
                <?=$this->Html->link(
    'Add meeting note',
    [
        'controller' => 'meeting-notes',
        'action' => 'add',
        $meeting->id,
        $schedule_id,
    ],
    [
        'class' => 'btn btn-default btn-sm',
    ]
); ?>
            <?php endif; ?>
                </div>

                    <div class="text-right">
                        <?=$this->Form->button(
                            $this->Icon->faIcon('fas fa-save') . ' Save',
    [
        'type' => 'submit',
        'escape' => false,
        'class' => 'btn-sm btn btn-link',
    ]); ?></div>
            </div>
        </div>

    <?php endforeach; ?>

    <?=$this->Form->end(); ?>
<?php else: ?>

    <h1>Click here to <?=
$this->Html->link('Add Meetings', [
    'controller' => 'meetings',
    'action' => 'add-meetings',
    $schedule_id]);
?></h1>

    <?php endif; ?>

<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                <em>History</em>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--        <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<?php // Create the sidebar block.
echo $this->fetch('postLink');
