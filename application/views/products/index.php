<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="card">
    <div class="card-header">
        Products
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
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col">Image File</th>
                    <th scope="col" width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $row): ?>
                    <tr>
                        <td><?php echo $row['prod_name']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td class="text-right"><?php echo $row['prod_price']; ?></td>
                        <td><?php if ($row['prod_image'] != ''): ?><img src="<?php echo base_url($row['prod_image']); ?>" width="100"><?php endif; ?></td>
                        <td>
                            <a href="<?php echo site_url('products/edit/' . $row['prod_id']); ?>" class="btn btn-primary btn-sm float-left mr-1" role="button"><i class="fas fa-pen"></i> Edit</a>
                            <?php echo form_open('products/delete/' . $row['prod_id']); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');"><i class="fas fa-trash"></i> Delete</button>
                            <?php echo form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo site_url('products/create'); ?>';"><i class="fas fa-plus"></i> Add Product</button>
    </div>
</div>