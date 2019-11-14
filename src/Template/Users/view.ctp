<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
<nav class="large-3 col-lg-2 medium-4 columns" id="actions-sidebar">
<ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</nav>
<div class="users col-lg-10 view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Person Record') ?></th>
            <td><?= $user->has('person') ? $user->person->full_name : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
</div>
