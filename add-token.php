<?php
if (!isset($_SESSION)) {
    session_start();
}
include('header.php');
include('admin/config.php');

?>



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
            <form id="" class="d-flex flex-column" action="addcoin.php" method="POST" enctype="multipart/form-data">
                <div class="row mx-0">
                    <div class="col-lg-6 col-12 ">
                        <label for="exampleInputEmail1" class="form-label font-weight-600">Name <span class="text-danger">*</span></label>
                        <input type="text" name="coinname" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Name" required="">
                        <div class="pt-3">
                            <label for="exampleInputEmail1" class="form-label font-weight-600">Symbol <span class="text-danger">*</span></label>
                            <input type="text" name="Symbol" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="BTC" required="">
                        </div>
                         <div class="pt-3">
                            <label for="exampleInputEmail1" class="form-label font-weight-600">Chain <span class="text-danger">*</span></label>
                            <input type="text" name="chain" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="BSC" required="">
                        </div>
                        <div class="my-3">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Description <span class="text-danger">*</span></label>
                            <textarea type="text" name="Description" id="Description" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Describe your coin here. What is the goal, plans, why is this coin unique?"></textarea>
                        </div>
                        <div class="my-3" >
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Market Cap <span class="text-danger">*</span></label>
                            <input type="number"  step="0.000001" name="Marketcap" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="0.000" >
                        </div>
                        <div class="my-3" >
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.000000000001" name="price" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="0.000" >
                        </div>
    
                        <div class="my-3">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Launching Date <span class="text-danger">*</span></label>
                            <input type="date" name="Launchdate" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder=""  required="">
                        </div>
            
                        
                        <div class="my-3" id="contract_add">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Address <span class="text-danger">*</span></label>
                            <input type="text" name="contract_address" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="" >
                        </div> 
                    </div>
                    <div class="col-lg-6 col-12 ">
                        
                        <div class="my-3 mt-0">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Website </label>
                            <input type="text" name="Website" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="" >
                        </div>
                       
                        <div class="my-3">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Telegram </label>
                            <input type="text" name="Telegram" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="" >
                        </div>
                        <div class="my-3">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Twitter </label>
                            <input type="text" name="Twitter" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;"placeholder="" >
                        </div>
                        
                       
                        <div class="">
                            <label for="exampleInputEmail1" class="form-label font-weight-600 ">Logo <span class="text-danger">*</span></label>
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input"  name="Logo" id="Logo" required="">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="my-3">
                            <label for="exampleInputPassword1" class="form-label font-weight-600">Additional information, other links and addresses</label>
                            <textarea type="text" name="information" id="information" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder=""></textarea>
                        </div>
                       
                    </div>
                </div>
                
    
                <div class="row mx-0 justify-content-center mb-3">
                    <input type="submit" id="coinsubbtn" name="submit" class="btn btn-outline-primary mt-3 col me-2" value="Submit Coin">
                </div>
            </form>
            <!--<form action="coinevent.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Coin<span class="text-danger">*</span> </label>
                    <select name="coinid" id="" class="form-select fs-7" style="padding:14px 20px; border-radius:25px;">
                        <option>Select Coins</option>
                        <?php
                        $coin=mysqli_query($con,"SELECT * FROM `coins`");
                        foreach($coin as $coindetail)
                        {?>
                            <option value="<?php echo $coindetail['id']; ?>"><?php echo $coindetail['coinname']; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Title<span class="text-danger">*</span> </label>
                    <input type="text" name="title" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Title (25 characters max)" required>
                </div>
                <div class="mb-4 mt-4 d-flex flex-column">
                    <label for="exampleInputEmail1" class="form-label fw-500 ">Category<span class="text-danger">*</span> </label>
                    <select name="category" id="" class="form-select fs-7" style="padding:14px 20px; border-radius:25px;">
                        <option>Select Category</option>
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
                    <input class="form-control" name="proof" type="file" id="formFile" accept="image/jpeg,image/png">
                </div>
                <div class="row mx-0 w-100">
                    <div class="col-lg-4 ps-0 col-12">
                        <label for="exampleInputEmail1" class="form-label fw-500 ">Your reward address</label>
                        <select name="symbol" id="" class="form-select fs-7" style="padding:14px 20px; border-radius:25px;">
                        
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
                    <div class="col-lg-8 ps-0 col-12">
                        <label for="exampleInputEmail1" class="form-label fw-500 "><span class="text-light">*</span> </label>
                        <input type="text" name="address" class="form-control fs-7" style="padding:14px 20px; border-radius:25px;" placeholder="Your Address">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <label for="exampleInputEmail1"  class="form-label fw-500 pt-4">Your Twitter account </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" name="twitter" class="form-control py-2 ps-3" placeholder="yourtwitteraccount">
                    </div>
                </div>
                <button class="btn btn-outline-primary mt-3 col me-2" name="submit">Submit the event</button>
            </form>-->
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