<?php
if (!isset($_SESSION)) {
    session_start();
}
include('header.php');
include('admin/config.php');

if (!isset($_GET['coin'])) {
    header('location:index.php');
}

?>



<div class="container " style="margin-top: 200px;">

    <a href="index.php" class="back"> <i class="fa fa-angle-left "></i> </a>

    <h4 class="mb-3 d-none">News</h4>

    <div class=" py-4 justify-content-center" style="display: none;" id="news_loader">
        <div class="spinner-border text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="news-div  mb-5 p-3" id="news_div">


    </div>


    <div id="coin_container">
        <div class="ws-card p-3 mb-4">

            <div class=" py-4 justify-content-center" style="display: flex;" id="coin_loader">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>
    </div>

    <div>

        <div class=" py-4 justify-content-center" style="display: flex;" id="trans_loader">
            <div class="spinner-border text-info" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="ws-card p-3 mb-4 px-4" id="trans_div">
            <h5>Transactions</h5>


        </div>
    </div>

    <div class="d-flex justify-content-between" id="filter_tabs">
        <div>
            <h5>Filters</h5>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn-time me-2 active" onclick="get_chart(1,this)">1 Day</button>
            <button class="btn-time me-2" onclick="get_chart(3,this)">3 Days</button>
            <button class="btn-time me-2" onclick="get_chart(7,this)">7 Days</button>
            <button class="btn-time me-2" onclick="get_chart(30,this)">1 Month</button>
            <button class="btn-time me-2" onclick="get_chart(365,this)">1 Year</button>
        </div>
    </div>

    <div class=" py-4 justify-content-center" style="display: flex;" id="chart_loader">
        <div class="spinner-border text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>



    <div class="mb-4">
        <canvas id="myChart"></canvas>
    </div>




</div>





<?php
include('footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.2.0/chartjs-plugin-zoom.min.js"></script>


<script>
    let getId = '<?php echo $_GET['coin'] ?>'
    let getAddress = '<?php echo $_GET['address'] ?>'

    // K6Y58N4QNMHRA4FF3JZ5HSXBPXU45N3UAZ


    const get_new = async (id) => {

        let news_div = document.querySelector('#news_div')


        await fetch(`https://newsapi.org/v2/everything?q=${id}&apiKey=e39602d775cd4e8b8fab0b7f09d5dcbds`)
            .then(response => response.json())
            .then(function(news_data) {
                if (news_data.articles == []) {
                    news_div.innerHTML = `<small style="font-weight:500;" class='w-100  text-center'>Not Found</small>`
                    // document.querySelector('#news_loader').style.display = "none"

                } else if (news_data.status == 'error') {
                    document.querySelector('#news_loader').style.display = "none"
                    news_div.innerHTML = `<small style="font-weight:500;" class='w-100  text-center'>Api Key Error / Limit Exceed :( </small>`
                } else {

                    for (let i = 0; i < news_data.articles.length; i++) {
                        if (i === 10) {
                            break;
                        }
                        news_data.articles
                        let get_date = news_data.articles[i].publishedAt
                        get_date = get_date.split('T')[i]
                        news_div.innerHTML += `
                        <div class='d-flex w-100 pb-4 '>
                        <div class="d-flex flex-column col ">
                            <h5>${news_data.articles[i].title}</h5>
                            <a href="${news_data.articles[i].url}" class="link" target="_blank"> ${news_data.articles[i].url}</a>
                            <p class="col-lg-8 col-12 desc mb-1">${news_data.articles[i].title}</p>
                            
                        </div>
                        <img style="border-radius: 4px; width:130px" src="${news_data.articles[i].urlToImage}" alt="">
                        </div>
                        `
                    }

                }
            });


        news_div.style.display = "none"


        document.querySelector('#news_loader').style.display = "none"

    }
    get_new(getId)


    const get_coin = async (id) => {

        let coin_container = document.querySelector('#coin_container')

        let bs_total_supply = null
        let bs_cs_total_supply = null

        if (getAddress != "") {

            await fetch(`https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=${getAddress}&apikey=K6Y58N4QNMHRA4FF3JZ5HSXBPXU45N3UAZ`)
                .then(res => res.json())
                .then(function(_bs_total_supply) {
                    bs_total_supply = _bs_total_supply;
                })
            await fetch(`https://api.bscscan.com/api?module=stats&action=tokenCsupply&contractaddress=${getAddress}&apikey=K6Y58N4QNMHRA4FF3JZ5HSXBPXU45N3UAZ`)
                .then(res => res.json())
                .then(function(_bs_cs_total_supply) {
                    bs_cs_total_supply = _bs_cs_total_supply;
                })
        }



        await fetch(`https://api.coingecko.com/api/v3/coins/${id}`)
            .then(response => response.json())
            .then(function(coin_data) {

                if (coin_data.error) {
                    coin_container.innerHTML = `<h5 class='w-100 py-4 text-center'>Not Found</h5>`
                    document.querySelector('#coin_loader').style.display = "none"
                }

                let output = "";
                if (id != "") {

                    output = `
               
                        <div class="ws-card p-3 mb-4">

                        <div class="d-flex align-items-center ">
                            <div class="d-flex col   flex-column">
                                <div class="d-flex align-items-start">
                                    <h2 style="font-weight: 600;" class="mb-0">${coin_data.name}</h2>
                                    <h5 class=" ms-1 mb-0 "> <span class="badge bg-primary text-uppercase">${coin_data.symbol}</span> </h5>
                                </div>
                                <a href="${coin_data.links.homepage[0]}" class="mb-2" style="font-weight: 500; font-size:14px;">${coin_data.links.homepage[0]}</a>
                            </div>
                            <img src="${coin_data.image.small}" style="width: 50px;" alt="">
                        </div>
                        <p class="decs-list mb-1 pe-lg-5 pe-0">${coin_data.description.en}"</p>
                        
                        
                        <div class="row mx-0 py-1 pt-0">
                            <div class="col-lg-3 px-0 text-small">Current price</div>
                            <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >$${coin_data.market_data.current_price.usd}</div>
                        </div>
                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Market Cap</div>
                            <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >$${coin_data.market_data.market_cap.usd} (Rank #${coin_data.market_cap_rank})</div>
                        </div>
                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Total Volume</div>
                            <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" > $${coin_data.market_data.total_volume.usd}</div>
                        </div>
                    `
                    if (getAddress != "") {

                        output += `
                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Total Supply</div>
                            <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >${bs_total_supply.result} </div>
                        </div>
                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Circulating Supply</div>
                            <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >${bs_cs_total_supply.result} </div>
                        </div>
              
                        `
                    }
                    output += `
                    </div>

                        <div class="ws-card p-3 mb-4">

                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Price Change In 24h</div>
                            <div class="col  px-0 text-small ${coin_data.market_data.price_change_24h > 0 ? "text-success" : "text-danger"} " style="font-weight: 600;">${coin_data.market_data.price_change_24h}</div>
                        </div>
                        <div class="row mx-0 py-1">
                            <div class="col-lg-3 px-0 text-small">Market Cap Change In 24h</div>
                            <div class="col  px-0 text-small ${coin_data.market_data.market_cap_change_24h > 0 ? "text-success" : "text-danger"}" style="font-weight: 600;">${coin_data.market_data.market_cap_change_24h}</div>
                        </div>

                        </div>
                        <div class="ws-card p-3 mb-4">

                        <div class="row mx-0">
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">facebook likes </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.facebook_likes}</span>
                            </div>
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">Twitter Followers </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.twitter_followers}</span>
                            </div>
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">Reddit average posts 48h </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.reddit_average_posts_48h}</span>
                            </div>
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">Reddit average comments 48 </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.reddit_average_comments_48h}</span>
                            </div>

                        </div>
                        <div class="row mx-0 pt-2 ">
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">Reddit Subscribers </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.reddit_subscribers}</span>
                            </div>
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                <span class="text-small" style="font-size: 12px;">Reddit accounts active 48h: </span>
                                <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.reddit_accounts_active_48h}</span>
                            </div>
                            <div class="col-lg-3 ps-0 col-12 d-flex flex-column">
                                            <span class="text-small" style="font-size: 12px;">Telegram channel user count </span>
                                            <span class="text-small fs-6" style="font-weight: 600;">${coin_data.community_data.telegram_channel_user_count}</span>
                                        </div>
                                    </div>
                                    </div>
        
                `
                }
                if (getAddress != "" && id == "") {
                    output = `
                        <div class="ws-card p-3 mb-4">
                            <div class="row mx-0 py-1">
                                <div class="col-lg-3 px-0 text-small">Total Supply</div>
                                <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >${bs_total_supply.result} </div>
                            </div>
                            <div class="row mx-0 py-1">
                                <div class="col-lg-3 px-0 text-small">Circulating Supply</div>
                                <div class="col  px-0 text-small " style="opacity:.9; font-weight:600;" >${bs_cs_total_supply.result} </div>
                            </div>
                        </div>
                        `
                }


                coin_container.innerHTML = output

            });





        document.querySelector('#coin_loader').style.display = "none"

    }
    get_coin(getId)


    const get_trans = async (add) => {

        if (add != "") {


            let trans_div = document.querySelector('#trans_div')

            trans_div.style.display = "none"

            await fetch(`https://api.bscscan.com/api?module=account&action=txlist&address=${add}&startblock=0&endblock=99999999&page=1&offset=10&sort=asc&apikey=K6Y58N4QNMHRA4FF3JZ5HSXBPXU45N3UAZ`)
                .then(response => response.json())
                .then(function(trans_data) {

                    trans_data = trans_data.result
                    console.log(trans_data);

                    trans_div.style.display = "block"

                    trans_div.innerHTML += `
                <div class="row mx-0 pb-2 d-lg-flex d-none">
                <div class="col-2 ps-0  d-flex flex-column">
                    <span class="" style="font-size: 15px; font-weight:600;">Block  </span>
                </div>
                <div class="col-2 ps-0  d-flex flex-column">
                    <span class="" style="font-size: 15px; font-weight:600;">Value </span>
                </div>
                <div class="col-2 ps-0  d-flex flex-column">
                    <span class="" style="font-size: 15px; font-weight:600;">Gas Price </span>
                </div>
                <div class="col-3 ps-0  d-flex flex-column">
                    <span class="" style="font-size: 15px; font-weight:600;">From </span>
                </div>
                <div class="col-3 ps-0  d-flex flex-column">
                    <span class="" style="font-size: 15px; font-weight:600;">To </span>
                </div>
             
                 </div>
                `

                    trans_data.forEach(tra_data => {



                        trans_div.innerHTML += `
                    <div class="row mx-0 py-2" style="border-top:1px solid #ededed;">
                        <div class="col-lg-2 col-12 ps-0  d-flex flex-column">
                            <span class="" style="font-size: 13px; font-weight:500;">${tra_data.blockNumber} </span>
                        </div>
                        <div class="col-lg-2 col-12 ps-0  d-flex flex-column">
                            <span class="" style="font-size: 13px; font-weight:500;">${tra_data.value} </span>
                        </div>
                        <div class="col-lg-2 col-12 ps-0  d-flex flex-column">
                            <span class="" style="font-size: 13px; font-weight:500;">${tra_data.gasPrice}</span>
                        </div>
                        <div class="col-lg-3 col-12 ps-0  d-flex flex-column">
                            <span class="text-primary" style="font-size: 13px; font-weight:500; overflow-x:hidden;">${tra_data.from} </span>
                        </div>
                        <div class="col-lg-3 col-12 ps-0  d-flex flex-column">
                            <span class="text-primary" style="font-size: 13px; font-weight:500; overflow-x:hidden;">${tra_data.to} </span>
                        </div>
              
                     </div>`
                    });

                });
        } else {
            trans_div.style.display = "none"
        }

        document.querySelector('#trans_loader').style.display = "none"

    }

    get_trans(getAddress)



    let is_first = true;
    let myChart = "";
    async function get_chart(filter, btn) {

        if (getId!= "") {

            if (btn != null) {
                document.querySelectorAll('.btn-time').forEach(element => {
                    element.classList.remove('active')
                });
                btn.classList.add('active')
            }



            document.querySelector('#chart_loader').style.display = "flex";
            let cordinates = [];

            await fetch(`https://api.coingecko.com/api/v3/coins/${getId}/market_chart?vs_currency=usd&days=${filter}`)
                .then(res => res.json())
                .then(function(data) {

                    if (data.error) {
                        document.querySelector('#chart_loader').style.display = "none";
                        document.querySelector('#filter_tabs').style.display = "none"
                    }
                    cordinates = data.prices;
                })


            let labels = []

            let skip = 0


            let prev_val = null;

            let final_price = [];


            cordinates.forEach(element => {


                skip = 0

                let hosut_host;
                let final_date;

                let ms = element[0];

                function msToHMS(duration) {

                    var milliseconds = parseInt((duration % 1000) / 100),
                        seconds = parseInt((duration / 1000) % 60),
                        minutes = parseInt((duration / (1000 * 60)) % 60),
                        hours = parseInt((duration / (1000 * 60 * 60)) % 24);

                    hours = (hours < 10) ? "0" + hours : hours;
                    minutes = (minutes < 10) ? "0" + minutes : minutes;
                    seconds = (seconds < 10) ? "0" + seconds : seconds;
                    hosut_host = hours
                    // return (hours);
                    // final_date = hours + ":" + minutes + ":" + seconds;

                    month = ["", "Jan", "Fab", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                    final_date = new Date(duration)

                    var AmOrPm = final_date.getHours() >= 12 ? 'pm' : 'am';

                    covert_hours = (final_date.getHours() % 12) || 12

                    final_date = month[final_date.getMonth()] + " " + final_date.getDate() + " " + covert_hours + ":" + final_date.getMinutes() + " " + AmOrPm
                }
                // console.log(msToHMS(ms));

                msToHMS(ms);

                // if (prev_val != hosut_host) {
                labels.push(final_date)
                final_price.push([final_date, element[1]]);
                prev_val = hosut_host
                // }
                skip++

            });


            const data = {
                // labels: ["10:00:00","11:00:00","12:00:00","13:00:00"],
                labels: labels,
                // labels:["20:04:19","20:07:43","20:14:25","20:17:43"],
                datasets: [{
                    label: 'Price Chart',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    // data: temp_arr
                    data: cordinates
                    // data: final_price
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {

                    plugins: {
                        zoom: {
                            pan: {
                                enabled: true,
                                mode: 'x',
                                threshold: 5,
                            },
                            zoom: {
                                wheel: {
                                    enabled: true
                                },
                                pinch: {
                                    enabled: true
                                },
                                mode: 'x',
                            },
                        }
                    },
                    scales: {
                        x: {
                            position: 'bottom',
                            ticks: {
                                autoSkip: true,
                                autoSkipPadding: 50,
                                maxRotation: 0
                            }
                        }
                    }
                }
            };

            if (is_first == false) {
                myChart.destroy();
            }

            if (is_first == true) {
                is_first = false
            }

            myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            document.querySelector('#chart_loader').style.display = "none";
        }
        else{
            document.querySelector('#chart_loader').style.display = "none";
            document.querySelector('#filter_tabs').innerHTML = ""
        }
    }


    get_chart(1, null);
</script>