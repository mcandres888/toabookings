<!-- Reservation form -->
<section id="reservation-form" class="mt50 clearfix">
  <div class="col-sm-12 col-md-4">
    <form class="reservation-vertical clearfix" role="form" method="post" action="php/reservation.php" name="reservationform" id="reservationform">
      <h2 class="lined-heading"><span>Reservation</span></h2>
      <div class="price">
        <h4>Double Room</h4>
        &euro; 99,-<span> a night</span></div>
      <div id="message"></div>
      <!-- Error message display -->
      <div class="form-group">
        <label for="email" accesskey="E">E-mail</label>
        <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail"/>
      </div>
      <div class="form-group">
        <select class="hidden" name="room" id="room">
          <option selected="selected">Double Room</option>
        </select>
      </div>
      <div class="form-group">
        <label for="checkin">Check-in</label>
        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
        <i class="fa fa-calendar infield"></i>
        <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
      </div>
      <div class="form-group">
        <label for="checkout">Check-out</label>
        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
        <i class="fa fa-calendar infield"></i>
        <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
      </div>
      <div class="form-group">
        <div class="guests-select">
          <label>Guests</label>
          <i class="fa fa-user infield"></i>
          <div class="total form-control" id="test">1</div>
          <div class="guests">
            <div class="form-group adults">
              <label for="adults">Adults</label>
              <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="+18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
              <select name="adults" id="adults" class="form-control">
                <option value="1">1 adult</option>
                <option value="2">2 adults</option>
                <option value="3">3 adults</option>
              </select>
            </div>
            <div class="form-group children">
              <label for="children">Children</label>
              <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="0 till 18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
              <select name="children" id="children" class="form-control">
                <option value="0">0 children</option>
                <option value="1">1 child</option>
                <option value="2">2 children</option>
                <option value="3">3 children</option>
              </select>
            </div>
            <button type="button" class="btn btn-default button-save btn-block">Save</button>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Book Now</button>
    </form>
  </div>
</section>
