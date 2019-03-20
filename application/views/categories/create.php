<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="card">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">
        <?php if (!empty(validation_errors())): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open('categories/create'); ?>
        <div class="form-group">
            <label for="cat_name">Category</label>
            <input type="text" class="form-control" id="cat_name" name="cat_name" value="<?php echo $this->input->post('cat_name'); ?>" required>
        </div>
        <div class="form-group">
            <label for="cat_description">Description</label>
            <input type="text" class="form-control" id="cat_description" name="cat_description" value="<?php echo $this->input->post('cat_description'); ?>" required>
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url('categories'); ?>';"><i class="fas fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Create Category</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>