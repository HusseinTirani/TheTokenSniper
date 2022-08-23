<?php 
if(!isset($_SESSION)) 
{ 
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
    .addcoin-wrapper{
        padding-bottom: 30px;
    }
    .coin-tag span{
        color: inherit;
        font-weight: inherit;
    }
</style>

<!-- ads slider -->
<div class="slider-parent hide-on-search py-2">
    <div class="ads-class">
        <?php
            $sql = mysqli_query($con,"SELECT * FROM `slider` ");
            foreach ($sql as $key => $value) {
              $src = explode('../',$value['image'])[1];
              echo '<div class="slice-ad-items-1" ><img src="'.$src.'" alt=""></div>';
            } 
          ?>
    </div>
</div>

<div class="container " style="margin-top:100px;">
    <div class="wrapper-1 addcoin-wrapper " >
        <div class="coin-tag"><span><h2>Welcome to our Privacy Policy and Term of use</h2></span> </div>

        <span><h3  style="margin-top:50px;">Your privacy is critically important to us.</h3></span>
        <span><h5>Thetoken sniper</h5></span>

        <p>
           It is Thetoken sniper’s policy to respect your privacy regarding any information we may collect while operating our website. This Privacy Policy applies to https://www.Thetokensniper.com (hereinafter, "us", "we", or "https://www.Thetoken sniper.com"). We respect your privacy and are committed to protecting personally identifiable information you may provide us through the Website. We have adopted this privacy policy ("Privacy Policy") to explain what information may be collected on our Website, how we use this information, and under what circumstances we may disclose the information to third parties. This Privacy Policy applies only to information we collect through the Website and does not apply to our collection of information from other sources.
        </p>
        <p>
            This Privacy Policy, together with the Terms and conditions posted on our Website, set forth the general rules and policies governing your use of our Website. Depending on your activities when visiting our Website, you may be required to agree to additional terms and conditions.
        </p>


        <span>Website Visitors</span>

        <p>Like most website operators, Thetoken sniper collects non-personally-identifying information of the sort that web browsers and servers typically make available, such as the browser type, language preference, referring site, and the date and time of each visitor request. Thetoken sniper’s purpose in collecting non-personally identifying information is to better understand how Thetoken sniper’s visitors use its website. From time to time, Thetoken sniper may release non-personally-identifying information in the aggregate, e.g., by publishing a report on trends in the usage of its website.
        </p>
        
        <p>Thetoken sniper also collects potentially personally-identifying information like Internet Protocol (IP) addresses for logged in users and for users leaving comments on https://www.Thetoken sniper.com blog posts. Thetoken sniper only discloses logged in user and commenter IP addresses under the same circumstances that it uses and discloses personally-identifying information as described below.
        </p>

        <span>Gathering of Personally-Identifying Information</span>

        <p>Certain visitors to Thetoken sniper’s websites choose to interact with Thetoken sniper in ways that require Thetoken sniper to gather personally-identifying information. The amount and type of information that Thetoken sniper gathers depends on the nature of the interaction. For example, we may ask visitors to sign up at https://www.Thetokensniper.com to provide a username and email address.
        </p>

        <span>Security</span>

        <p> The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.</p>

        <span>Advertisements</span>

        <p> Ads appearing on our website may be delivered to users by advertising partners, who may set cookies. These cookies allow the ad server to recognize your computer each time they send you an online advertisement to compile information about you or others who use your computer. This information allows ad networks to, among other things, deliver targeted advertisements that they believe will be of most interest to you. This Privacy Policy covers the use of cookies by Thetoken sniper and does not cover the use of cookies by any advertisers.</p>

        <span>Links To External Sites</span>

        <p>Our Service may contain links to external sites that are not operated by us. If you click on a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy and terms and conditions of every site you visit.</p>
         <p>We have no control over, and assume no responsibility for the content, privacy policies or practices of any third party sites, products or services.</p>
         
        <span>Protection of Certain Personally-Identifying Information</span>
        <p>Thetoken sniper discloses potentially personally-identifying and personally-identifying information only to those of its employees, contractors and affiliated organizations that </p>

        <p> 1.Need to know that information in order to process it on Thetoken sniper’s behalf or to provide services available at Thetoken sniper’s website</p>
        <p>2.That have agreed not to disclose it to others. Some of those employees, contractors and affiliated organizations may be located outside of your home country; by using Thetoken sniper’s website, you consent to the transfer of such information to them. Thetoken sniper will not rent or sell potentially personally-identifying and personally-identifying information to anyone. Other than to its employees, contractors and affiliated organizations, as described above, Thetoken sniper discloses potentially personally-identifying and personally-identifying information only in response to a subpoena, court order or other governmental request, or when Thetoken sniper believes in good faith that disclosure is reasonably necessary to protect the property or rights of Thetoken sniper, third parties or the public at large.</p>
        <p>If you are a registered user of https://www.Thetoken sniper.com and have supplied your email address, Thetoken sniper may occasionally send you an email to tell you about new features, solicit your feedback, or just keep you up to date with what’s going on with Thetoken sniper and our products. We primarily use our blog to communicate this type of information, so we expect to keep this type of email to a minimum. If you send us a request (for example via a support email or via one of our feedback mechanisms), we reserve the right to publish it in order to help us clarify or respond to your request or to help us support other users. Thetoken sniper takes all measures reasonably necessary to protect against the unauthorized access, use, alteration or destruction of potentially personally-identifying and personally-identifying information.</p>
        
        <span>Aggregated Statistics</span>

        <p>Thetoken sniper may collect statistics about the behavior of visitors to its website. Thetoken sniper may display this information publicly or provide it to others. However, Thetoken sniper does not disclose your personally-identifying information.</p>
    

<span>Cookies</span></span>
       
<p>To enrich and perfect your online experience, Thetoken sniper uses "Cookies", similar technologies and services provided by others to display personalized content, appropriate advertising and store your preferences on your computer.</p>
<p>A cookie is a string of information that a website stores on a visitor’s computer, and that the visitor’s browser provides to the website each time the visitor returns. Thetoken sniper uses cookies to help Thetoken sniper identify and track visitors, their usage of https://www.Thetokensniper.com, and their website access preferences. Thetoken sniper visitors who do not wish to have cookies placed on their computers should set their browsers to refuse cookies before using Thetoken sniper’s websites, with the drawback that certain features of Thetoken sniper’s websites may not function properly without the aid of cookies.
</p>
<p>
   By continuing to navigate our website without changing your cookie settings, you hereby acknowledge and agree to Thetoken sniper's use of cookies.
</p>
     
   
<span>Privacy Policy Changes</span>

<p>Although most changes are likely to be minor, Thetoken sniper may change its Privacy Policy from time to time, and in Thetoken sniper’s sole discretion. Thetoken sniper encourages visitors to frequently check this page for any changes to its Privacy Policy. Your continued use of this site after any change in this Privacy Policy will constitute your acceptance of such change.
</p>


<span class="mt-5"><h3>Terms and Conditions for thetoken sniper</h3></span>


<span>Introduction</span>

<p>These Website Standard Terms and Conditions written on this webpage shall manage your use of our website, thetoken sniper accessible at www.thetokensniper.com.</p>
        <p>
            These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions. These Terms and Conditions have been generated with the help of the Terms And Conditiions Sample Generator
        </p>

        
<p>
    Minors or people below 18 years old are not allowed to use this Website.

</p>
        
<span>
    Intellectual Property Rights
</span>
      

<p>
Other than the content you own, under these Terms, thetoken sniper and/or its licensors own all the intellectual property rights and materials contained in this Website.
</p>
<p>
    You are granted limited license only for purposes of viewing the material contained on this Website
</p>


<span>
    Restrictions
</span>

<p>
    You are specifically restricted from all of the following:

</p>

<ul>
    <li>Publishing any Website material in any other media</li>
    <li>Selling, sublicensing and/or otherwise commercializing any Website material</li>
    <li>Publicly performing and/or showing any Website material</li>
    <li>Using this Website in any way that is or may be damaging to this Website</li>
    <li>Using this Website in any way that impacts user access to this Website</li>
    <li>Using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity</li>
    <li>Engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website</li>
    <li>Using this Website to engage in any advertising or marketing.</li>
</ul>
<p>

   Certain areas of this Website are restricted from being access by you and thetoken sniper may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.

</p>
<span>Your Content</span>
<p>
In these Website Standard Terms and Conditions, "Your Content" shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant thetoken sniper a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.

</p>
<p>
    Your Content must be your own and must not be invading any third-party’s rights. thetoken sniper reserves the right to remove any of Your Content from this Website at any time without notice.
</p>

      
    <span>Your Privacy</span>
    <p>Please read Privacy Policy.</p>
    <span>No warranties</span>
     <p>
        This Website is provided "as is," with all faults, and thetoken sniper express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you. You are responsible for your investment, make your research and take you own decision to invest, there is a lot of fake coins that remains undetected, you have pay attention before taking high risks.
    </p> 
    

     <span>Limitation of liability</span>
    <p>
        In no event shall thetoken sniper, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract.  thetoken sniper, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.
    </p>

<span>Indemnification</span>
<p> 
   You hereby indemnify to the fullest extent thetoken sniper from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.
</p>

<span>Severability</span>
<p> 
   If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>
    <span>Variation of Terms</span>

<p>  thetoken sniper is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>

<span>Assignment</span>
<p>  
   The thetoken sniper is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.
</p>
<span>Entire Agreement</span>
<p> These Terms constitute the entire agreement between thetoken sniper and you in relation to your use of this Website and supersede all prior agreements and understandings.
</p>
<span>Governing Law & Jurisdiction</span>

<p>These Terms will be governed by and interpreted in accordance with the laws of France, and you submit to the non-exclusive jurisdiction of the state and federal courts of that country for the resolution of any disputes</p>

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
        responsive: [
            {
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