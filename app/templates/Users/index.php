<h1>Users</h1>
<table>
    <tr>
        <th>Email</th>
        <th>Modified</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td>
        <?= h($user->email) ?>
        </td>
        <td>
        <?= h($user->modified) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>