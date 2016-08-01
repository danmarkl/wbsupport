<?php echo $this->start('title'); ?>
<?php echo ucwords($user['User']['FirstName'].' '.$user['User']['LastName']); ?>
<?php echo $this->end(); ?>
<div class="row">
    <div class="col-md-2">
        <a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'add')); ?>" class="btn btn-sm btn-block btn-default">Create User</a>
        <a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'changepassword', $user['User']['Id'])); ?>" class="btn btn-sm btn-block btn-default">Change Password</a>
        <a href="<?php echo $this->Html->Url(array('controller' => 'user', 'action' => 'edit', $user['User']['Id'])); ?>" class="btn btn-sm btn-block btn-default">Update Info</a>
        <a href="<?php echo $this->Html->Url(array('controller' => 'admin', 'action' => 'user')); ?>" class="btn btn-sm btn-block btn-default">Back to List</a>
    </div>
    <div class="col-md-10">
        <table class="table-condensed">
            <tbody>
                <tr>
                    <td><strong>Email</strong></td>
                    <td><?php echo trim($user['User']['EmailAddress']); ?></td>
                </tr>
                <tr>
                    <td><strong>Role</strong></td>
                    <td><?php echo ucfirst($user['User']['Role']); ?></td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td><?php echo ucwords($user['User']['FirstName'].' '.$user['User']['LastName']); ?></td>
                </tr>
                <tr>
                    <td><strong>Client</strong></td>
                    <td><?php echo ucwords($user['Team']['Name']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->start('footerScripts'); ?>
<script>
    
</script>
<?php echo $this->end(); ?>