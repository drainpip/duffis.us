<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta charset="utf-8">
    <title>Duff is us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Duff is us">
    <meta name="author" content="Shane">
    <meta name="keywords" content="Duff is us" />  
    <meta name="application-name" content="Duff is us" />
    <meta name="msapplication-tooltip" content="DI.U" />
    <meta name="msapplication-window" content="width=1024;height=768" />
    <meta name="msapplication-starturl" content="http://duffis.us" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Parisienne|Oswald' rel='stylesheet' type='text/css'>
    <link href="assets/css/bootstrap.3.0.0.RC1.css" rel="stylesheet" media="screen">
    <link href="assets/css/main.css" rel="stylesheet" media="screen">    
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond/respond.js"></script>
    <![endif]-->  
</head>

<body>

<div id="bg"></div>

<div class="main">

  <div id="menu">
  
    <h1>Duff is us</h1>
    
    <ul class="nav">
      <li><a href="#Wedding">Wedding</a></li>
      <li><a href="#RSVP">RSVP</a></li>
      <li><a href="#LBC">Long&nbsp;Beach</a></li>
      <li><a href="#Registry">Registry</a></li>
      <li><a href="#Photos">Photos</a></li>
    </ul>

  </div><!-- #menu -->
  
  <section id="Wedding">
    <div class="row">

      <h1 class="cursive">The Wedding</h1>

      <div class="col-sm-10 col-lg-10">
      
        <h3>Friday,&nbsp;October&nbsp;4th&nbsp;at&nbsp;5:30&nbsp;in&nbsp;the&nbsp;evening.</h3>
        
        <p>Betty H. Reckas Cultural Center - <a href="https://www.google.com/maps?q=5761+E+Colorado+St,+Long+Beach,+CA+90814&sll=33.76997969999964,-118.11925818020964&sspn=0.009586673670415446,0.020597766200602836&t=m&dg=opt&hnear=5761+E+Colorado+St,+Long+Beach,+Los+Angeles,+California+90814&z=16" target="_blank" title="View on Google Maps">Map</a></p>
        
        <address>
          5761 E Colorado Street<br>
          Long Beach, CA<br>
          90814
        </address>
        
        <h2 class="cursive"><a href="#RSVP">Please&nbsp;R.S.V.P.&nbsp;by&nbsp;September&nbsp;15th</a></h2>
        
        <p>We look forward to celebrating with you!</p>
        
      </div><!-- .col-sm-10.col-lg-10 -->

    </div><!-- .row -->
  </section><!-- #Wedding -->
  
  <section id="RSVP">
    <div class="row">

      <h1 class="cursive">R.S.V.P.</h1>

      <div class="col-12">
      
      <?php
      $rsvp = false;
      if (isset($_POST['RSVP_Submit'])) {
        $primary_name = $_POST['primary-name'];
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $valid_email = true;
        } else {
          $valid_email = false;
        }
        $phone = $_POST['phone'];
        $chicken = $_POST['chicken'];
        $eggplant = $_POST['eggplant'];
        $guests = $_POST['guests'];
        
        $guest_body = '';
        if ($guests > 1) {
          for ($i = 1; $i < $guests; $i++) {
            $name = $_POST['guest-'.$i.'-name'];
            $guest_body .= '<p>Guest #'.$i.': '.$name.'</p>';
          }
        }
        
        if (isset($_POST['notes'])) {
          $notes = '<h4>Notes</h4>';
          $notes .= $_POST['notes'];
        }
        
        if ($valid_email) {
          $to = 'rfreistat@me.com';
          $subject = 'RSVP from [name]';
          $message = '
          <html>
            <head>
              <title>Nonsensical Latin</title>
              <style type="text/css">
                html, body {font-family:sans-serif;}
              </style>
            </head>
            <body>
              <h1>R.S.V.P. from '.$primary_name.'</h1>
              <p>Email: '.$email.'</p>
              <p>Phone: '.$phone.'</p>
              '.$guest_body.'
              <p>Chicken: '.$chicken.'</p>
              <p>Eggplant: '.$eggplant.'</p>
              '.$notes.'
            </body>
          </html>
          ';
          $headers = "From: RSVP Form<me@shaneis.me>\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
          mail($to,$subject,$message,$headers);
          
          if ($guests > 0) {
            echo '<h3 class="alert alert-success">Thank you for sending in this information. We look forward to celebrating with you!</h3>';
          } else {
            echo '<h3 class="alert alert-success">We\'re sorry you can\'t come, but thanks for submitting this R.S.V.P.</h3>';
          }
          $rsvp = 'sent';
        } else {
          $rsvp = 'main_form';
          echo '<h3 class="alert alert-danger">Could you try again? I don\'t think that\'s a valid email.</h3>';
        }
      }
      
      if (isset($_POST['RSVP_guests'])) {
        $rsvp = 'main_form';
        $guests = $_POST['guests'];
      }
      
      if ($rsvp === 'main_form') {
      ?>
      
        <form action="#RSVP" method="post" class="form-horizontal">
          <legend>Primary contact information</legend>
          <div class="form-group">
            <label for="primary-name" class="col-sm-2 col-lg-2 control-label">Name</label>
            <div class="col-sm-10 col-lg-10">
              <input type="text" name="primary-name" class="form-control" placeholder="First and Last" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 col-lg-2 control-label">Email</label>
            <div class="col-sm-10 col-lg-10">
              <input type="text" name="email" class="form-control" placeholder="you@whatever.com" required>
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-2 col-lg-2 control-label">Phone</label>
            <div class="col-sm-10 col-lg-10">
              <input type="text" name="phone" class="form-control" placeholder="(000) 000-0000" required>
            </div>
          </div>
          <?php 
          if ($guests <> '0') {
            if ($guests > '1') {
          ?>
          <legend>Guest information</legend>
          <?php
              for ($i = 1; $i < $guests; $i++) {
          ?>
              <div class="form-group">
                <label for="guest-<?php echo $i ?>-name" class="col-sm-2 col-lg-2 control-label">Name</label>
                <div class="col-sm-10 col-lg-10">
                  <input type="text" name="guest-<?php echo $i ?>-name" class="form-control" placeholder="First and Last" required>
                </div>
              </div> 
          <?php
              }
            }
          ?>
          <legend class="cursive">Provencial Chicken</legend>
          <p class="help-block">Breast of chicken stuffed with spinach, mushrooms, wild rice, and pine nuts with a chardonnay leek sauce.</p>
          <div class="form-group">
            <label for="chicken" class="col-sm-2 col-lg-2 control-label">Plates</label>
            <div class="col-sm-2 col-lg-2">
              <select name="chicken" class="form-control">
                <?php
                for ($i = 0; $i <= $guests; $i++) {
                ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <legend class="cursive">Eggplant Napoleon</legend>
          <p class="help-block">Parmesan breaded eggplant stack with a boursin and goat cheese mousse.</p>
          <div class="form-group">
            <label for="eggplant" class="col-sm-2 col-lg-2 control-label">Plates</label>
            <div class="col-sm-2 col-lg-2">
              <select name="eggplant" class="form-control">
                <?php
                for ($i = 0; $i <= $guests; $i++) {
                ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <?php
          }
          ?>          
          <legend>Notes</legend>
          <div class="form-group">
            <div class="col-12">
              <textarea class="form-control" name="notes" rows="3"></textarea>
              <p class="help-block">Anything we missed?</p>
            </div>
          </div>
          <div class="form-group">
            <div class="text-center">
              <input type="hidden" name="guests" value="<?php echo $guests; ?>">
              <button type="submit" name="RSVP_Submit" value="Submit" class="btn btn-default">Submit</button>
            </div>
          </div>
        </form>
        
      <?php
      } else if (!$rsvp) {
      ?>
      
        <form action="#RSVP" method="post" class="form-horizontal">
          <legend>Please enter the number of guests in your party</legend>
          <p class="help-block">If you cannot attend, please select 0.</p>
          <div class="form-group">
            <label for="guests" class="col-sm-2 col-lg-2 control-label">Guests</label>
            <div class="col-sm-3 col-lg-3">
              <select name="guests" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10 col-lg-10 col-offset-2">
              <button type="submit" name="RSVP_guests" value="Submit" class="btn btn-default">Submit</button>
            </div>
          </div>
        </form>
              
      <?php
      }
      ?>
      
        
      </div><!-- .col-12 -->

    </div><!-- .row -->
  </section><!-- #RSVP -->
  
  <section id="LBC">
    <div class="row">
      <h1 class="cursive">We Heart LBC</h1>
      <div class="col-sm-6 col-lg-6">
      
        <h3>Our favorite restaurants</h3>
        
        <h4><a href="http://www.yelp.com/biz/the-coffee-cup-caf%C3%A9-long-beach-2" title="The Coffee Cup Cafe on Yelp">The Coffee Cup Cafe</a></h4>
        <p>3734 E 4th Street<br>Long Beach, CA<br>90814</p>
        <p>562.433.3292</p>
        <p>Possibly the best breakfast in Long Beach, cash only, veggie friendly</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/los-compadres-long-beach-2" title="Los Compadres on Yelp">Los Compadres</a></h4>
        <p>3229 E Anaheim St<br>Long Beach, CA<br>90804</p>
        <p>562.961.0061</p>
        <p>Legit mexican food, expect a wait in the evenings</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/320-main-seal-beach" title="320 Main on Yelp">320 Main</a></h4>
        <p>320 Main Street<br>Seal Beach, CA<br>90740</p>
        <p>562.799.6246</p>
        <p>Our favorite restaurant, get a reservation and cocktails</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/beachwood-bbq-seal-beach" title="Beachwood BBQ on Yelp">Beachwood BBQ</a></h4>
        <p>131 1/2 Main Street<br>Seal Beach, CA<br>90740</p>
        <p>562.493.4500</p>
        <p>Our favorite BBQ, great and constantly changing beer selection, get the wings, expect a wait and don't bring large parties</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/koi-sushi-seal-beach" title="Koi Sushi on Yelp">Koi Sushi</a></h4>
        <p>600 Pacific Coast Highway<br>Seal Beach, CA<br>90740</p>
        <p>562.431.1186</p>
        <p>Best sushi in the area hands down</p>
        
      </div><!-- .col-sm-6.col-lg-6 -->
      
      <div class="col-sm-6 col-lg-6">
      
        <h3>Good hotels near the ceremony</h3>
        
        <h4><a href="http://www.yelp.com/biz/the-westin-long-beach-long-beach" title="The Westin, Long Beach on Yelp">The Westin, Long Beach</a></h4>
        <p>333 East Ocean Blvd.<br>Long Beach, CA<br>90802</p>
        <p>562.436.3000, reservations: 888.627.8403</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/hyatt-the-pike-long-beach-long-beach" title="Hyatt The Pike, Long Beach on Yelp">Hyatt The Pike, Long Beach</a></h4>
        <p>285 Bay Street<br>Long Beach, CA<br>90802</p>
        <p>reservations: 866.678.6350</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/best-western-golden-sails-hotel-long-beach-2" title="Best Western Golden Sails, Long Beach on Yelp">Best Western Golden Sails, Long Beach</a></h4>
        <p>6285 E Pacific Coast Hwy<br>Long Beach, CA<br>90803</p>
        <p>562.596.1631</p>
        <p>(Closest to ceremony)</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/hampton-inn-and-suites-seal-beach#query:Hampton%20Inn%2C%20Seal%20Beach" title="Hampton Inn, Seal Beach on Yelp">Hampton Inn, Seal Beach</a></h4>
        <p>2401 Seal Beach Blvd.<br>Seal Beach, CA<br>90740</p>
        <p>562.594.3939</p>
        
        <h3>Fun places in the area</h3>
        
        <h4><a href="http://www.yelp.com/biz/art-theatre-long-beach" title="Art Theatre Long Beach on Yelp">Art Theatre</a></h4>
        <p>2025 E 4th St<br>Long Beach, CA<br>90814</p>
        <p>562.438.5435</p>
        <p>Cool venue for LA/NY only films</p>
        
        <hr>
        
        <h4><a href="http://www.yelp.com/biz/aquarium-of-the-pacific-long-beach" title="Aquarium of the Pacific Long Beach on Yelp">Aquarium of the Pacific</a></h4>
        <p>100 Aquarium Way<br>Long Beach, CA<br>90802</p>
        <p>562.590.3100</p>
        <p>Kid friendly, lots to see and do</p>
        
      </div><!-- .col-sm-6.col-lg-6 -->
    </div><!-- .row -->
  </section><!-- #LBC -->
  
  <section id="Registry">
    <div class="row">
      <h1 class="cursive">Registry</h1>
      <div class="col-sm-6 col-lg-6">
      </div>
      <div class="col-sm-6 col-lg-6">
      </div>
    </div>
  </section><!-- Registry -->
  
  <section id="Photos">
    <div class="row">
      <h1 class="cursive">Us On Film</h1>
      <div class="col-sm-6 col-lg-6">
      </div>
      <div class="col-sm-6 col-lg-6">
      </div>
    </div>
  </section><!-- #Photos -->
  
</div><!-- .main -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery.1.9.1.min.js">\x3C/script>')</script>
<script src="assets/js/jquery.ba-bbq.min.js"></script>
<script src="assets/js/fading-pages.1.3.0.js"></script>
<script src="assets/js/main.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40064172-1', 'duffis.us');
  ga('send', 'pageview');
</script>
</body>
</html>