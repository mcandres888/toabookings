<!DOCTYPE HTML>
<html>
<? include "main_template/header.php"; ?>
<body>
<? include "main_template/top_header.php"; ?>
<? include "main_template/navigation.php"; ?>

<? include "main_template/section_paralax_room_list.php"; ?>




<div class="container mt50">
  <div class="row">
    <!-- Slider -->
    <section class="standard-slider room-slider">
      <div class="col-sm-12 col-md-8">
        <div id="owl-standard" class="owl-carousel">
          <div class="item"> <a href="<?=base_url()?>main_data/images/rooms/slider/750x481.gif" data-rel="prettyPhoto[gallery1]"><img src="<?=base_url()?>main_data/images/rooms/slider/750x481.gif" alt="Image 2" class="img-responsive"></a> </div>
          <div class="item"> <a href="<?=base_url()?>main_data/images/rooms/slider/750x481.gif" data-rel="prettyPhoto[gallery1]"><img src="<?=base_url()?>main_data/images/rooms/slider/750x481.gif" alt="Image 2" class="img-responsive"></a> </div>
        </div>
      </div>
    </section>

    <? include "main_template/section_detail_reservation_form.php"; ?>
    <? include "main_template/section_room_content.php"; ?>

  </div>
</div>




<? include "main_template/section_room_detail_other_rooms.php"; ?>

<? include "main_template/footer.php"; ?>



<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>
</html>
