<h1><?= h($task->title) ?></h1>
<p><?= h($task->body) ?></p>
<p><small>Created: <?= $task->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $task->slug]) ?></p>