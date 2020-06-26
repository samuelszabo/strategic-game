<?php
/**
 * @var \Cake\View\View $this
 * @var \App\Ideas\Idea $idea
 */
echo $this->Html->tag('h3', $idea->title);
echo '<p>';
echo $idea->intro;
echo '</p>';
