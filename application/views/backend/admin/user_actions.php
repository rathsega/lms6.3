<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('User Actions'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
              <h4 class="mb-3 header-title"><?php echo get_phrase('User Actions'); ?></h4>
              <div class="table-responsive-sm mt-4">
                  <?php date_default_timezone_set('Asia/Kolkata'); if (count($user_actions->result_array()) > 0): ?>
                      <table id="basic-datatable" class="table table-striped table-centered mb-0" data-order="[[ 5, &quot;desc&quot; ]]">
                          <thead>
                              <tr>
                                  <th><?php echo get_phrase('User'); ?></th>
                                  <th><?php echo get_phrase('Phone'); ?></th>
                                  <th><?php echo get_phrase('Course'); ?></th>
                                  <th><?php echo get_phrase('Action From'); ?></th>
                                  <th><?php echo get_phrase('date_time'); ?></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($user_actions->result_array() as $user_action):;?>
                                  <tr class="gradeU">
                                      <td>
                                          <b><?php echo $user_action['name']; ?></b><br>
                                          <small><?php echo get_phrase('email').': '.$user_action['email']; ?></small>
                                      </td>
                                      <td><?php echo $user_action['phone']; ?></td>
                                      <td><?php echo $user_action['title']; ?></td>
                                      <td><?php echo $user_action['action_from'] == 'demo_video'? "Demo Video" : "Broucher Link"; ?></td>
                                      <td data-sort='<?php echo $user_action['datetime']; ?>'><?php echo date('d-M-Y H:i', $user_action['datetime']); ?></td>
                                      
                                  </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  <?php endif; ?>
                  <?php if (count($user_actions->result_array()) == 0): ?>
                      <div class="img-fluid w-100 text-center">
                        <img style="opacity: 1; width: 100px;" src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                        <?php echo get_phrase('no_data_found'); ?>
                      </div>
                  <?php endif; ?>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
