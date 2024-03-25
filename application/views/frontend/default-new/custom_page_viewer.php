<?php include "breadcrumb.php"; ?>

<div class="container py-5">
	<?php echo remove_js(htmlspecialchars_decode_($page_content)); ?>
</div>

<style>
    /* Common styles for all devices */

    /* Styles for desktop and laptop screens */
    @media only screen and (min-width: 1024px) {
      /* Your desktop and laptop styles go here */
      .container p img{
          width: 734.609px !important;
      }
    }
    
    /* Additional styles for larger screens if needed */
    @media only screen and (min-width: 1200px) {
      /* Additional styles for larger screens go here */
      .container p img{
          width: 734.609px !important;
      }
    }

    @media only screen and (max-width: 767px) {
      .container p img{
          width: 325px !important;
      }
    }

</style>