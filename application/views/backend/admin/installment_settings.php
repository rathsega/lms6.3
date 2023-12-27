<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('installment_settings'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
              <div class="col-lg-12">
                <form class="required-form" action="<?php echo site_url('admin/update_installment_settings'); ?>" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="installments_count"><?php echo get_phrase('number_of_installments'); ?><span class="required">*</span> </label>
                        <input type="number" class="form-control" name="installments_count" value="<?php echo $installment_settings['installments_count']; ?>" id="installments_count" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="installment_percentages"><?php echo get_phrase('installment_percentages'); ?><span class="required">*</span> </label>
                        <div id="installment_percentages">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="graceful_payment_duration"><?php echo get_phrase('Graceful Payment Duration In Days'); ?><span class="required">*</span> </label>
                        <input type="number" class="form-control" value="<?php echo $installment_settings['graceful_payment_duration']; ?>" name="graceful_payment_duration" id="graceful_payment_duration" required min="1">
                    </div>
                  

                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('update'); ?></button>
                </form>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script>
$(document).ready(function() {
    
    //Student and enrolment Dependable dropdown
    $('#installments_count').change(function(){
        var selectedValue = $(this).val();
        let fields = "";
        let data = `<?php echo $installment_settings['installment_percentages']; ?>`;
        data = data !="null" && data!="" ? JSON.parse(data) : [0];
        for(i=1; i<=parseInt(selectedValue); i++){
            fields += '<input type="number" placeholder= "installment '+i+' percentage" value="'+parseInt(data[i-1])+'"  class="form-control mb-1" name="installment_percentages[]" required>';
        }
        $('#installment_percentages').html(fields);
        
    });

    let fields = "";
    let data = `<?php echo $installment_settings['installment_percentages']; ?>`;
    data = data !="null" && data!="" ? JSON.parse(data) : [0];
    for(i=1; i<=parseInt(<?php echo $installment_settings['installments_count']; ?>); i++){
        fields += '<input type="number" placeholder= "installment '+i+' percentage" value="'+parseInt(data[i-1])+'" class="form-control mb-1" name="installment_percentages[]" required>';
    }
    $('#installment_percentages').html(fields);
});
</script>
