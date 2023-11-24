<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('enrol_history'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<html>
<head>
    <title>Export Data to Excel in Codeigniter using PHPExcel</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
 <div>
  <h3 align="center">Export Data to Excel in Codeigniter using PHPExcel</h3>
  <br />
  <div align="center">
    <form method="post" name="exp_form" action="<?php echo base_url(); ?>excel_export/action">
    <input type="text" style="display:none;" name="datas" value="<?php echo json_encode($data); ?>" />
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>
  <div class="table-responsive">
   <table class="table table-bordered">
    <tr>
     <th>Name</th>
     <th>Email</th>
     <th>Phone</th>
     <th>Course</th>
     <th>Added Date</th>
     <th>Expired Date</th>
     <th>Status</th>
    </tr>
  <?php $data=[]; if (count($enrol_history->result_array()) > 0): ?>
    <?php foreach ($enrol_history->result_array() as $enrol): 
         $data[] = $enrol;
          echo '
          <tr>
           <td>'.$enrol['first_name']. " ". $enrol['last_name'] .'</td>
           <td>'.$enrol['email'].'</td>
           <td>'.$enrol['phone'].'</td>
           <td>'.$enrol['title'].'</td>
           <td>'.date('Y-m-d', $enrol['date_added']).'</td>
           <td>'.$enrol['expiry_date'].'</td>
           <td>'.$enrol['status']  .'</td>
          </tr>
          ';
        ?>
        
    <?php endforeach; ?>
  <?php endif; ?>
   </table>
   
   <br />
   <br />
  </div>
 </div>
</body>
</html>
