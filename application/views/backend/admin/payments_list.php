<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/add_payments'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_payment'); ?></a>
                    <a href="<?php echo base_url(); ?>excel_export/payments" class="btn btn-outline-primary btn-rounded alignToTitle"><?php echo get_phrase('download'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('name'); ?></th>
                                <th><?php echo get_phrase('email'); ?></th>
                                <th><?php echo get_phrase('Phone'); ?></th>
                                <th><?php echo get_phrase('Enrolment'); ?></th>
                                <th><?php echo get_phrase('Amount'); ?></th>
                                <th><?php echo get_phrase('Date'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($payments_list->result_array() as $key => $payment) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $payment['name']; ?></td>
                                    <td><?php echo $payment['email']; ?></td>
                                    <td><?php echo $payment['phone']; ?></td>
                                    <td><?php echo $payment['title']; ?></td>
                                    <td><?php echo $payment['amount']; ?></td>
                                    <td><?php echo $payment['datetime']; ?></td>
                                    <td>
                                    <a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_payment/' . $payment['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                        <?php if (true) : ?>
                                            <!-- <div class="dropright dropright">
                                                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="<?php echo site_url('admin/edit_payments/' . $payment['id']) ?>"><?php echo get_phrase('edit'); ?></a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/delete_payment/' . $payment['id']); ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                                </ul>
                                            </div> -->
                                        <?php else : ?>
                                            <!-- <span class="badge badge-success"><?php echo ucwords(get_phrase('root_admin')); ?></span> -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>