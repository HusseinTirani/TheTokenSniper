<?php
if (!isset($_SESSION)) {
    session_start();
}

include('admin/config.php');
include('header.php');
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>
    .select2-selection{
        height: 51px !important;
        border-radius: 25px !important;
        border: 1px solid #ced4da;
    }
    .select2-selection__rendered{
        padding: 11px 20px !important;
    }
    .select2-selection__arrow{
        padding: 11px 20px !important;
        height: 51px  !important;
    }
    .select2-dropdown{
        max-width: 223px;
        margin-left: 23px;
    }
</style>

<div class="row mx-0 justify-content-center px-2 mt-5 pt-5 py-5 ">
    <div class="col-lg-9 col-12 pt-5">
        <div class="ws-card p-lg-5 p-4">
            <div class="text-center fs-5">Main reasons why events are not published:</div>
            <div class="text-center fs-7 pb-4">Bad writing | Past event | No date in the proof/source | Weak proof/source | Duplicate | ICO/IEO | Contest/Giveaway/Trading Competition</div>

            <?php
            if (isset($_SESSION['contact_msg'])) {
                echo $_SESSION['contact_msg'];
                unset($_SESSION['contact_msg']);
            }
            ?>
            <form action="coinevent.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Coin<span class="text-danger">*</span> </label>
                    <select name="coinid" id="" class="form-select fs-7 select2" style="padding:14px 20px; border-radius:25px;">
                        <option>Select Coins</option>
                        <?php
                        $coin=mysqli_query($con,"SELECT * FROM `coins`");
                        foreach($coin as $coindetail)
                        {?>
                            <option value="<?php echo $coindetail['id']; ?>"><?php echo $coindetail['coinname']; ?></option>
                        <?php }
                        ?>
                        <!-- <option>bitcoin</option>
                        <option>bitcoin</option>
                        <option>bitcoin</option>
                        <option>bitcoin</option> -->
                    </select>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Title<span class="text-danger">*</span> </label>
                    <input type="text" name="title" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Title (25 characters max)" required>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Category<span class="text-danger">*</span> </label>
                    <select name="category" id="" class="form-select fs-7 select2" style="padding:14px 20px; border-radius:25px;">
                        <option>Select Category</option>
                        <option value="NFT">NFT</option>
                        <option value="Team Update">Team Update</option>
                        <option value="Airdrop/Snapshot">Airdrop/Snapshot</option>
                        <option value="AMA">AMA</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Other">Other</option>
                        <option value="Whitepaper U">Whitepaper U</option>
                        <option value="Branding">Branding</option>
                        <option value="Meetup">Meetup</option>
                        <option value="Conference">Conference</option>
                        <option value="Exchange">Exchange</option>
                        <option value="Release">Release</option>
                        <option value="Integration">Integration</option>
                        <option value="Staking/Farming">Staking/Farming</option>
                        <option value="Roadmap Update">Roadmap Update</option>
                        <option value="Tokenomics">Tokenomics</option>
                    </select>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Date<span class="text-danger">*</span> </label>
                    <input type="date" name="lunchdate" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Date" required>
                </div>
                <!-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Or earlier (if it can occur before the date stated)
                    </label>
                </div> -->
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Description</label>
                    <textarea name="description" class="form-control fs-7" placeholder="Description (140 characters max)" style="padding:14px 20px; border-radius:25px;" required></textarea>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Source<span class="text-danger">*</span> </label>
                    <input type="text" name="sourcelink" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Source" required>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Proof <span class="text-danger">*</span> </label>
                    <input class="form-control fs-7" style="line-height: 37px; border-radius:25px;" name="proof" type="file" id="formFile" accept="image/jpeg,image/png">
                </div>
                <div class="row mx-0 w-100">
                    <div class="col-lg-4 ps-0 col-12">
                        <label for="exampleInputEmail1" class="form-label fw-500 ">Your reward address</label>
                        <select name="symbol" id="" class="form-select fs-7 select2" style="padding:14px 20px; border-radius:25px;">
                        
                        <option>Select Coins</option>
                        <?php
                        $coin=mysqli_query($con,"SELECT * FROM `coins`");
                        foreach($coin as $coindetail)
                        {?>
                            <option value="<?php echo $coindetail['id']; ?>"><?php echo $coindetail['Symbol']; ?></option>
                        <?php }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-8 p-0 col-12">
                        <label for="exampleInputEmail1" class="form-label fw-500 "><span class="text-light">*</span> </label>
                        <input type="text" name="address" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Your Address">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <label for="exampleInputEmail1"  class="form-label fw-500 pt-4">Your Twitter account </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1" style="padding:14px 20px; border-radius: 25px 0 0 25px;">@</span>
                        <input type="text" name="twitter" class="form-control fs-7" style="padding:14px 20px; border-radius:0 25px 25px 0;" placeholder="yourtwitteraccount">
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-3 col me-2" name="submit">Submit the event</button>
            </form>
        </div>
    </div>
</div>


<?php
include('footer.php');
?>
<script>
    $('.select2').select2();
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

<script>
    // for file input
    document.querySelector('#logo-btn').onclick = () => {
        document.querySelector('#Logo').click()
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            if (input.files[0].type == 'image/png' || input.files[0].type == 'image/jpg' || input.files[0].type == 'image/jpeg') {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#logo-name').innerText = input.files[0].name
                    console.log(input.files)
                };

                reader.readAsDataURL(input.files[0]);
                if (input.files) {

                }
            } else {
                window.alert("Please select valid image format Ex:( PNG , JPG , JPEG)")
                input.value = ""
                document.querySelector('#logo-name').innerText = "No file chosen"
            }
        }
    }
    // !!! for file input
    document.querySelector('#btnsubmit').onclick = (e) => {
        e.preventDefault();
        document.querySelector('#coinname').value.length < 1 ? document.querySelector('#coinname').classList.add('input-alert') : document.querySelector('#coinname').classList.remove('input-alert');
        document.querySelector('#Symbol').value.length < 1 ? document.querySelector('#Symbol').classList.add('input-alert') : document.querySelector('#Symbol').classList.remove('input-alert');
        document.querySelector('#Price').value.length < 1 ? document.querySelector('#Price').classList.add('input-alert') : document.querySelector('#Price').classList.remove('input-alert');
        document.querySelector('#Marketcap').value.length < 1 ? document.querySelector('#Marketcap').classList.add('input-alert') : document.querySelector('#Marketcap').classList.remove('input-alert');
        document.querySelector('#Launchdate').value.length < 1 ? document.querySelector('#Launchdate').classList.add('input-alert') : document.querySelector('#Launchdate').classList.remove('input-alert');
        document.querySelector('#Website').value.length < 1 ? document.querySelector('#Website').classList.add('input-alert') : document.querySelector('#Website').classList.remove('input-alert');
        if (document.querySelectorAll('.input-alert').length == 0) {
            document.querySelector('#coinform').submit()
        }
    }
</script>