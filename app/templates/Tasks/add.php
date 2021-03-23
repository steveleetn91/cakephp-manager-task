<h1>Add Task</h1>
<?php
    echo $this->Form->create($task);
    // Hard code the user for now.
    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => '3']); ?>
    <div class="input textarea required">
        <label for="body">Assign</label>
        <select name="assign">
            <?php foreach($users as $k => $v ) { ?> 
                <option value="<?php echo $v->id; ?>"><?php echo $v->email; ?></option>
            <?php } ?>
        </select>
    </div>
    <?php echo $this->Form->button(__('Save task'));
    echo $this->Form->end();
?>