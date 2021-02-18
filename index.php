<?php
    include "include/config.php";
    session_start();
?>


<!-- Add your content of head and header -->
<!DOCTYPE html>
<html lang="en">
    
    <head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <meta content="description" name="description">
  <meta name="google" content="notranslate" />
  
  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">
  <title>Home | Memos Tonight</title>  
  
  <link href="./assets/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="./assets/favicon.ico" rel="icon">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">   
  <link href="./css/stylesheet.css" rel="stylesheet">
    </head>
    
    <body>
  
<!-- HEADER STARTS -->
<?php 
     include "include/header.php";

?>
<!-- HEADER ENDS -->
        
        
        <!-- Add your site or app content here -->
        <!-- <div class="background-image-container white-text-container" style="background-image: url('./assets/images/img-05.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12"> -->
                    <div class="jumbotron jumbotron-fluid hero-image mh-100 background-image-container white-text-container" style="background-image: url('./assets/images/img-05.jpg')">
	                  <div class="hero-text">                        
                        <h1>MEMOS TONIGHT</h1>
                        <h3 >YOUR FAVORITE CELEBRITIES AT YOUR FINGERTIPSR</p>
                        <a href="./book.php" class="btn " title="Phonebook">View Phonebook</a>
                      </div>
                    </div>
                        <!-- </div>
                </div>
            </div>
        </div> -->
        <br><br>
        
        
        <!-- <div class="section-container section-half-background-image-container"> -->
        <div class="section-container container">
            <!-- <div class="img-fluid mission" style="background-image: url('./assets/images/img-01.jpg')"></div> -->
            
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-6 col-md-offset-6 section-label reveal"> -->
                    <div class="col-md-4">
                        <p><img src="./assets/images/img-01.jpg" alt="" class="img-fluid"></p>
                    </div>
                    <div class="col-md-6 ">
                        <h2>Our Mission</h2>               
                        <p>We understand how much you cherish all your favorite celebrities and would do anything to know them more.
        
                            Therefore, we have decided to make the ultimate celebrity phonebook to keep you in touch with all your favorite celebrities all in one place.</p>

                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="section-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 section-container-spacer">
                    <h2 class="text-center">Memos Tonight</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <img src="./assets/images/img-02.jpg" alt="" class="img-fluid">
                    <h3 class="text-center">Fast and Efficient</h3>
                    <p>This website, built with modern technology, brings you faster results!</p>
                </div>
    
                <div class="col-xs-12 col-md-4">
                    <img src="./assets/images/img-03.jpg" alt="" class="img-fluid">
                    <h3 class="text-center">Safe and Secure</h3>
                    <p>With the latest security measures, your data is completely secure!</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <img src="./assets/images/img-04.jpg" alt="" class="img-fluid">
                    <h3 class="text-center">Global and Diverse</h3>
                    <p>Find all your favorite celebrities from around the world!</p>
                </div>
            </div>
        </div>
        </div>
        
        <div class="section-container" id="contact-section-container">
        <div class="container contact-form-container">
            <div class="row">
                <div class="col-xs-12 col-md-offset-2 col-md-8">
                    <div class="section-container-spacer">
                        <h2 class="text-center">Get in touch</h2>
                    </div>
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Enter your message"></textarea>
                        </div>
    
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" value="option1">Email me a copy
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" value="option2">I am a human
                            </label>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Send message</button>
                        <a href="" class="btn btn-default">Reset</a>
                    </form>
                </div>
            </div>
        </div>
        </div>
        
<!-- FOOTER STARTS -->
<?php include "include/footer.php"; ?>
<!-- FOOTER ENDS -->
        
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
      navbarToggleSidebar();
    });
</script>        
<script type="text/javascript" src="./main.faaf51f9.js"></script>
<script src="https://kit.fontawesome.com/41a0117d0b.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/all.js"></script>
<script src="script.js"></script>
<script type="text/javascript">  
            function googleTranslateElementInit() {  
                new google.translate.TranslateElement( 
                    {pageLanguage: 'en'},  
                    'google_translate_element' 
                );  
            }  
</script>      
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"> 
</script>  
            
    </body>
</html>