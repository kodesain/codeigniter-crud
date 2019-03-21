<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="card">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col" width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $row): ?>
                    <tr>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['cat_description']; ?></td>
                        <td>
                            <a href="<?php echo site_url('categories/edit/' . $row['cat_id']); ?>" class="btn btn-primary btn-sm float-left mr-1" role="button"><i class="fas fa-pen"></i> Edit</a>
                            <?php echo form_open('categories/delete/' . $row['cat_id']); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');"><i class="fas fa-trash"></i> Delete</button>
                            <?php echo form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo site_url('categories/create'); ?>';"><i class="fas fa-plus"></i> Add Category</button>
    </div>
</div>