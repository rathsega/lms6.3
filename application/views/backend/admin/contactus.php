<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo "Contact Us"; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <form class="form-inline" action="<?php echo base_url(); ?>excel_export/contactus" method="get">
                    <div class="col-xl-1">
                            <button type="submit" class="btn btn-info" id="submit-button"> <?php echo "Download";?></button>
                    </div>
                </form>

</div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
              <div class="table-responsive-sm">
                
                  <?php if (count($contactus->result_array()) > 0): ?>
                      <table id="basic-datatable" class="table table-striped table-centered mb-0">
                          <thead>
                              <tr>
                                  <th>User</th>
                                  <th>Phone</th>
                                  <th>City</th>
                                  <th>Course</th>
                                  <th>Message</th>
                                  <th>Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($contactus->result_array() as $contact):
                                    date_default_timezone_set('Asia/Kolkata');
                                  $user_data = $this->db->get_where('users', array('email' => $contact['email']))->row_array();?>
                                  <tr class="gradeU"  style="color: <?php echo $user_data && $user_data['id'] ? 'green' : 'blue'; ?>;">
                                      <td>
                                            <b><?php echo $contact['name']; ?></b><br>
                                          <small><?php echo $contact['email']; ?></small>
                                      </td>
                                      <td><?php echo $contact['phone']; ?></td>
                                      <td><?php echo $contact['city']; ?></td>
                                      <td><?php echo $contact['title']; ?></td>
                                      <td><?php echo $contact['message']; ?></td>
                                      <td><?php echo date('d-M-Y H:i', $contact['datetime']); ?></td>
                                  </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  <?php endif; ?>
                  <?php if (count($contactus->result_array()) == 0): ?>
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
<script type="text/javascript">
    function update_date_range()
    {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }

    function redirect_to($url){

    }
</script>
