<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Login History'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
              <h4 class="mb-3 header-title"><?php echo get_phrase('Login History'); ?></h4>
              <div class="row justify-content-md-center">
                  <div class="col-xl-12">
                      <form class="form-inline" action="<?php echo site_url('admin/user_login_history') ?>" method="post">
                            
                          <div class="col-xl-4">
                            <div class="form-group">
                                <label for="multiple_user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
                                <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="multiple_user_id" required>
                                    <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                                    <?php $user_list = $this->user_model->get_user()->result_array();
                                        foreach ($user_list as $user):?>
                                        <option  value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-xl-2">
                              <button type="submit" class="btn btn-info" id="submit-button"> <?php echo get_phrase('filter');?></button>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="table-responsive-sm mt-4">
                  <?php if (count($user_login_history->result_array()) > 0): ?>
                      <table class="table table-striped table-centered mb-0">
                          <thead>
                              <tr>
                                  <th><?php echo get_phrase('user_name'); ?></th>
                                  <th><?php echo get_phrase('device'); ?></th>
                                  <th><?php echo get_phrase('os'); ?></th>
                                  <th><?php echo get_phrase('browser'); ?></th>
                                  <th><?php echo get_phrase('ip_address'); ?></th>
                                  <th><?php echo get_phrase('date_time'); ?></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($user_login_history->result_array() as $history):
                                  $user_data = $this->db->get_where('users', array('id' => $history['user_id']))->row_array();
                                //   log_message('error', 'Enrol ID : ' . $enrol['id'] . " , User ID : " . $enrol['user_id'] . " , Email : " . $user_data['email']);
                                //   $course_data = $this->db->get_where('course', array('id' => $enrol['course_id']))->row_array();?>
                                  <tr class="gradeU">
                                      <td>
                                          <b><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></b><br>
                                          <small><?php echo get_phrase('email').': '.$user_data['email']; ?></small>
                                      </td>
                                      <td><?php echo $history['device']; ?></td>
                                      <td><?php echo $history['os']; ?></td>
                                      <td><?php echo $history['browser']; ?></td>
                                      <td><?php echo $history['ip_address']; ?></td>
                                      <td><?php echo $history['date_time']; ?></td>
                                      
                                  </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  <?php endif; ?>
                  <?php if (count($user_login_history->result_array()) == 0): ?>
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
