
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>


        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <?= $this->Form->create($part) ?>
    <fieldset>
        <legend><?= __('Add Part') ?></legend>

				<div class="col-lg-6">
					<?php
							echo $this->Form->input('active');
							echo $this->Form->input('has_auxiliary', [ 'label' => "Also in Auxiliary Classroom"]);
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

            echo $this->Form->input('link_to', [
                'type' => 'select',
                'options' => $link_parts,
                'empty' => '(link to another part if same person will do this one)'
             ]);
            echo $this->Form->input('partname');

             echo $this->Form->input('replace_token');
            echo $this->Form->input('start_time', [ 'timeFormat' => 12]);
            echo $this->Form->input('minutes');
            echo $this->Form->input('counsel_mins');
            echo $this->Form->input('min_suffix');

            echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]);
            echo $this->Form->input('sort_order');
            echo $this->Form->input('roles._ids', ['options' => $roles]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
