<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo "Contact Us"; ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
              <h4 class="mb-3 header-title"><?php echo "Contact Us"; ?></h4>
              <div class="row justify-content-md-center">
                
                  
              </div>
              <div class="table-responsive-sm mt-4">
                
                  <?php if (count($contactus->result_array()) > 0): ?>
                      <table class="table table-striped table-centered mb-0">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Course</th>
                                  <th>Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($contactus->result_array() as $contact):
                                  $user_data = $this->db->get_where('users', array('id' => $contact['email']))->row_array();?>
                                  <tr class="gradeU">
                                      <td>
                                          <?php echo $contact['name']; ?>
                                      </td>
                                      <td><?php echo $contact['email']; ?></td>
                                      <td><?php echo $contact['phone']; ?></td>
                                      <td><?php echo $contact['title']; ?></td>
                                      <td><?php echo date('D, d-M-Y H:i A', $contact['datetime']); ?></td>
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
