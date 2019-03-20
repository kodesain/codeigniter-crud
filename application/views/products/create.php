<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="card">
    <div class="card-header">
        Add Product
    </div>
    <div class="card-body">
        <?php if (!empty(validation_errors())): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('products/create'); ?>
        <div class="form-group">
            <label for="prod_name">Product</label>
            <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $this->input->post('prod_name'); ?>" required>
        </div>
        <div class="form-group">
            <label for="cat_id">Category</label>
            <select class="form-control" id="cat_id" name="cat_id">
                <?php foreach ($categories as $row): ?>
                    <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="prod_description">Description</label>
            <input type="text" class="form-control" id="prod_description" name="prod_description" value="<?php echo $this->input->post('prod_description'); ?>" required>
        </div>
        <div class="form-group">
            <label for="prod_price">Price</label>
            <input type="number" class="form-control text-right" id="prod_price" name="prod_price" value="<?php echo $this->input->post('prod_price'); ?>" required>
        </div>
        <div class="form-group">
            <label for="image_file">Image File</label>
            <input type="file" class="form-control" id="image_file" name="image_file">
        </div>
        <div class="form-group text-right">
            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?php echo site_url('products'); ?>';"><i class="fas fa-times"></i> Close</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Create Product</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>