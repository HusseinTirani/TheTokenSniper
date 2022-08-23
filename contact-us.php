<?php
if (!isset($_SESSION)) {
    session_start();
}
include('header.php');
include('admin/config.php');

?>

<style>
    span {
        color: #00E4FF;
        font-weight: 500;
    }

    p {
        padding-top: 15px;
    }

    .addcoin-wrapper {
        padding-bottom: 30px;
    }

    .coin-tag span {
        color: inherit;
        font-weight: inherit;
    }
</style>




<div class="row mx-0 justify-content-center px-2 mt-5 pt-5 py-5 ">
    <div class="col-lg-6 col-12 pt-5">
        <div class="ws-card p-lg-5 p-4">
            <div class="text-center fs-4">Contact Us</div>

            <?php
            if(isset($_SESSION['contact_msg'])){
                echo $_SESSION['contact_msg'];
                unset($_SESSION['contact_msg']);
            }
            ?>
            <form action="contact-us-db.php" method="POST">
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label ">Name</label>
                    <input type="text" name="name" class="ws-inp w-100 "  required>
                </div>
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label ">Email</label>
                    <input type="email" name="email" class="ws-inp w-100 "  required>
                </div>
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label ">Message</label>
                    <textarea  name="message" class="ws-inp w-100 " required></textarea>
                </div>
                <input name="submit" type="submit" class="b1 w-100 mt-3" value="SEND">
            </form>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
<script>
    $('.ads-class').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        prevArrow: false,
        nextArrow: false,
        responsive: [{
                breakpoint: 700,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
</script>