<!DOCTYPE HTML>
<html>
<? include "main_template/header.php"; ?>
<body>
<? include "main_template/top_header.php"; ?>
<? include "main_template/navigation.php"; ?>

<? include "main_template/section_paralax_room_list.php"; ?>




<!-- Filter -->
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-pills" id="filters">
        <li class="active"><a href="#" data-filter="*">All</a></li>
        <li><a href="#" data-filter=".single">Single Room</a></li>
        <li><a href="#" data-filter=".double">Double Room</a></li>
        <li><a href="#" data-filter=".executive">Executive Room</a></li>
        <li><a href="#" data-filter=".apartment">Apartment</a></li>
      </ul>
    </div>
  </div>
</div>

<? include "main_template/section_room_list_rooms.php"; ?>
<? include "main_template/footer.php"; ?>



<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</body>
</html>
