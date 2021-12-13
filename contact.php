<?php 
$validFlag = false;

  if(isset($_POST['submit']) && !empty($_POST['email'])) {
    //Setting recaptcha
    $secret = "";
    $responseToken = $_POST["g-recaptcha-response"];
    $remoteIP =  getenv("REMOTE_ADDR");
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$responseToken&remoteip=$remoteIP";
    //the response is a JSON String
    $reCAPTCHAResponse = File_get_contents($url);
    //turned JSON String into PHP object for further processing
    $phpReCAPTCHAResponse = json_decode($reCAPTCHAResponse);
    
    //Processing form data
    $date = date('m/d/Y');
    $inEmail = strip_tags($_POST['email']);

    //Building Email
    $mailTo = "$inEmail, joshuaa2003@joshuaallen.info";
    $subject = "Gizzys Treasures Thanks You for contacting us $inEmail";
    $message = '
    <html>
    <head>
    <title>Gizzys Treasures</title>
    </head>
    <body style="background-color:#F6F6F6; padding: 30px 0 0 30px; color:black; height:300px; border-radius: 50px 20px; 
    ">
    <p>Dear ' . $inEmail . ',</p>
    <p>We received your request on ' . $date . ' and appreciate you contacting us.</p>
    <p>We look forward to seeing more of you. <strong><span style="text-transform: uppercase;font-size: 26px;"><span style="color:#494949;">Gizzys Treasures</span></span></strong></p>
    </body>
    </html>
    ';
    //Set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=ISO-8859-1" . "\r\n";
    $headers .= 'From: <joshuaa2003@joshuaallen.info>' . "\r\n";
   mail($mailTo,$subject,$message,$headers); 
    $validFlag = true;

    //checking reCAPTCHA response is successful before sending email
    if(!$phpReCAPTCHAResponse->success) {
      $errorMessage =  "Something went wrong";
      $validFlag = false; 
     }
     else {
      $errorMessage = "";
     }
   
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="This is a virtual storefront project written in PHP, HTML and CSS using PayPal processing">
  <meta name="keywords" content="ecommerce, PHP, HTML, CSS, PayPal, garage sale items, digital goods">
  <meta name="author" content="Joshua Allen">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="virtualStore.css">
  <title>Contact Page</title>
</head>

<body>
  <div class="container">
    <header>

      <nav>
        <div class="menu-icon">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z" />
          </svg>
        </div>
        <div class="logo"><a href="products.html"><img src="images/pancake-894w.JPG" width="894" height="899"
              alt="logo"><span>Gizzys Treasures</span></a></div>
        <div><a href="about.html">About</a></div>
        <div><a href="contact.php">Contact</a></div>
        <div><a href="#" target="_blank">Facebook</a>
        </div>
      </nav>
    </header>
    <main>
      <?php
          if($validFlag) {
      
      ?>
        <h1>Email Sent Successfully!!!</h1>
        
      <?php 
          //redirect
          header( "refresh:5;url=products.html" );
          //no fall through to the response object
          return;
          }
      ?>
      <h1>Contact Us</h1>
      <section id=content>
        <p>If you have any questions please feel free to contact us. If you need immediate service please call us at the
          number below during the hours of Monday through Friday 10 AM EST - 3 PM EST.</p>
        <p>Our physical store is currently relocating. </p>
        <p>If you are trying to return a product please call/email.</p>
        <address>
          Phone: (123)456-7890
          <br>
          Email: gizmo@abc.com
        </address>
      </section>
      <section class="form">
        <form action="contact.php" method="post" id="contact_form">
          <div>
          <input type="email" name="email" id="email" placeholder="john@abc.com" size="30" maxlength="64" minlength="3" autocomplete="off" autofocus placeholder="Enter Email Address"
            required>
            <span><?php echo $errorMessage = isset($errorMessage) ? $errorMessage : null ;?></span>
          </div>
          
          <button type="submit" name="submit">Submit</button>
          <div class="g-recaptcha" data-sitekey=""></div>
        </form>
      </section>
    </main>
    <footer>
      <div class="contact">
      <div class="logo">
          <img src="images/pancake-894w.JPG" width="894" height="899" alt="logo"><span>Gizzys Treasures</span>
        </div>
        <div><small>Copyright&#169;
          </small></div>
          <div class="social-media">
          <a href="#" target="_blank">
           
            <!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg
              enable-background="new 0 0 56.693 56.693" height="32px" id="Layer_1" version="1.1"
              viewBox="0 0 56.693 56.693" width="56.693px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink">
              <path
                d="M40.43,21.739h-7.645v-5.014c0-1.883,1.248-2.322,2.127-2.322c0.877,0,5.395,0,5.395,0V6.125l-7.43-0.029  c-8.248,0-10.125,6.174-10.125,10.125v5.518h-4.77v8.53h4.77c0,10.947,0,24.137,0,24.137h10.033c0,0,0-13.32,0-24.137h6.77  L40.43,21.739z" />
            </svg>
          </a>
        </div>
      </div>
      <hr>
      <div class="sitemap">
        <h2>Site Map</h2>
        <div><a href="about.html">About</a></div>
        <div><a href="contact.php">Contact</a></div>
      </div>
      <hr>
    </footer>
  </div>
  <!--end of container-->
</body>
</html>