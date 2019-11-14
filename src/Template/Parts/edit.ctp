<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $part->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $part->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($part) ?>
    <fieldset>
        <legend><?= __('Edit Part') ?></legend>

				<div class="col-lg-6">
					<?php
							echo $this->Form->input('active');
							echo $this->Form->input('has_auxiliary', [ 'label' => "Part is also done in Auxiliary Classroom"]);
							 echo $this->Form->input('chairman_part');
                             echo $this->Form->input('school_part');
							 ?>
				</div>
				<div class="col-lg-6">
						<?php   echo $this->Form->input('assistant');
	            echo $this->Form->input('no_assign');
                             echo $this->Form->input('co_visit');
                             echo $this->Form->input('not_co_visit');
							 ?>
				</div>

						 <?php
            echo $this->Form->input('partname');

              echo $this->Form->input('link_to', [
                  'title' => "Link to another part",
                'type' => 'select',
                'options' => $link_parts,
                'empty' => '(link to another part if that part has the same person doing it as this one)'
             ]);

              echo $this->Form->input('replace_token');
            echo $this->Form->input('start_time', [ 'timeFormat' => 12]);
            echo $this->Form->input('minutes');
						  echo $this->Form->input('assistant_prefix');
             echo $this->Form->input('counsel_mins');
            echo $this->Form->input('min_suffix');

            echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]);
            echo $this->Form->input('sort_order');
            echo $this->Form->input('privileges._ids', ['options' => $privileges]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
