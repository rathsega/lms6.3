<style>

    .toggle-button {
        display: none;
        position: fixed;
        right: 10px;
        top: 10px;
        background-color: #333;
        color: white;
        border: none;
        padding: 10px;
        font-size: 18px;
        cursor: pointer;
        z-index: 1000;
    }

    .social-strip {
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f8f8f8;
        /* Adjust as needed */
        padding: 10px;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .social-icon {
        margin: 10px 0;
        color: black;
        font-size: 24px;
        text-decoration: none;
        transition: color 0.3s;
    }

    .social-icon:hover {
        color: #007bff;
        /* Change color on hover */
    }

    /* Responsive design */
    @media screen and (max-width: 768px) {
        .toggle-button {
            display: block;
        }

        .social-strip.show {
            display: flex;
        }

        .social-icon {
            font-size: 20px;
            margin: 8px 0;
        }
    }
</style>

<?php $facebook = get_frontend_settings('facebook'); ?>
<?php $twitter = get_frontend_settings('twitter'); ?>
<?php $linkedin = get_frontend_settings('linkedin'); ?>
<?php $instagram = "https://www.instagram.com/techleadsit/"; ?>
<?php $youtube = "https://www.youtube.com/@TechLeadsIT"; ?>

<!-- <button id="toggle-button" class="toggle-button">☰</button> -->
<div id="social-strip" class="social-strip">
    <a href="<?php echo $facebook; ?>" target="_blank" class="social-icon">
        <i class="fa-brands fa-facebook-f"></i>
    </a>
    <a href="<?php echo $twitter; ?>" target="_blank" class="social-icon">
        <i class="fa-brands fa-twitter"></i>
    </a>
    <a href="<?php echo $linkedin; ?>" target="_blank" class="social-icon">
        <i class="fa-brands fa-linkedin"></i>
    </a>
    <a href="<?php echo $instagram; ?>" target="_blank" class="social-icon">
        <i class="fab fa-brands fa-square-instagram"></i>
    </a>
    <a href="<?php echo $youtube; ?>" target="_blank" class="social-icon">
        <i class="fab fa-youtube"></i>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-button');
        const socialStrip = document.getElementById('social-strip');

        toggleButton.addEventListener('click', function() {
            socialStrip.classList.toggle('show');
        });
    });
</script>