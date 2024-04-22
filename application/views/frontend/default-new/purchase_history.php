<?php $this->db->where('user_id', $this->session->userdata('user_id'));
$purchase_history = $this->db->get('payment',$per_page, $this->uri->segment(3)); ?>

<?php 
$query = "SELECT e.user_id, e.course_id, e.course_fee, e.id, e.date_added, mp.amount, mp.datetime FROM `manual_payments` as mp left join enrol as e on e.id = mp.enrolment_id where e.user_id=".$this->session->userdata('user_id')." group by e.id";
$manual_purchase_history = $this->db->query($query); ?>
<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php include "breadcrumb.php"; ?>

  <!-------- Wish List body section start ------>
<section class="wish-list-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="purchase-body common-card">
                    <table class="table">
                        <thead class="table-head">
                            <tr>
                                <th scope="col"><h6><?php echo get_phrase('Purchased courses') ?></h6></th>
                                <th scope="col"><h6><?php echo get_phrase('Payment method') ?></h6></th>
                                <th scope="col"><h6><?php echo get_phrase('Price') ?></h6></th>
                                <th scope="col"><h6><?php echo get_phrase('Purchased Date') ?></h6></th>
                                <th scope="col" class="w-auto"><h6 class="text-end"><?php echo get_phrase('Invoice') ?></h6></th>
                            </tr>
                        </thead>
                        <div class="purchase-2">
                            <tbody>
                                <?php if ($purchase_history->num_rows() > 0):
                                    foreach($purchase_history->result_array() as $each_purchase):
                                    $course_details = $this->crud_model->get_course_by_id($each_purchase['course_id'])->row_array();
                                    if($course_details['slug_count'] == 1 || $course_details['slug_count'] == 2){
                                        $slug = $course_details['slug'];
                                    }else if($course_details['slug_count'] == 3 || $course_details['slug_count'] == 4){
                                        $slug = $course_details['category_slug'] .'/' . $course_details['sub_category_slug'] .'/' . $course_details['slug'];
                                    }else{
                                        $slug = $course_details['slug'];
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="purchase-2-img align-items-center">
                                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">
                                                    <a href="<?php echo site_url($slug); ?>" class="text-15px text-dark ps-3 text-wrap">
                                                        <?php echo $course_details['title']; ?>
                                                    </a>
                                                </div>
                                            </th>
                                            <td><h5><?php echo ucfirst($each_purchase['payment_type']); ?></h5></td>
                                            <td><h4><?php echo currency($each_purchase['amount']); ?></h4></td>
                                            <td><h5><?php echo date('d M Y', $each_purchase['date_added']); ?></h5></td>
                                            <td>
                                                <button class="purchase-btn">
                                                    <a href="<?php echo site_url('home/invoice/'.$each_purchase['id']); ?>"><?php echo get_phrase('Invoice'); ?></a>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>


                                <?php if ($manual_purchase_history->num_rows() > 0):
                                    foreach($manual_purchase_history->result_array() as $each_purchase):
                                    $course_details = $this->crud_model->get_course_by_id($each_purchase['course_id'])->row_array();
                                    if($course_details['slug_count'] == 1 || $course_details['slug_count'] == 2){
                                        $slug = $course_details['slug'];
                                    }else if($course_details['slug_count'] == 3 || $course_details['slug_count'] == 4){
                                        $slug = $course_details['category_slug'] .'/' . $course_details['sub_category_slug'] .'/' . $course_details['slug'];
                                    }else{
                                        $slug = $course_details['slug'];
                                    }
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="purchase-2-img align-items-center">
                                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">
                                                    <a href="<?php echo site_url($slug); ?>" class="text-15px text-dark ps-3 text-wrap">
                                                        <?php echo $course_details['title']; ?>
                                                    </a>
                                                </div>
                                            </th>
                                            <td><h5><?php echo "Manual Payment"; ?></h5></td>
                                            <td><h4><?php echo currency($each_purchase['course_fee']); ?></h4></td>
                                            <td><h5><?php echo date('d M Y', $each_purchase['date_added']); ?></h5></td>
                                            <td>
                                                <button class="purchase-btn">
                                                    <a href="<?php echo site_url('home/manual_payment_invoice/'.$each_purchase['id']); ?>"><?php echo get_phrase('Invoice'); ?></a>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>