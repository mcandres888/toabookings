
<!-- Header -->
<header>
  <!-- Navigation -->
  <div class="navbar yamm navbar-default" id="sticky">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="<?=site_url()?>" class="navbar-brand">
        <!-- Logo -->
        <div id="logo"> <img id="default-logo" src="<?=base_url()?>main_data/images/logo.png" alt="Starhotel" style="height:44px;"> <img id="retina-logo" src="<?=base_url()?>main_data/images/logo-retina.png" alt="Starhotel" style="height:44px;"> </div>
        </a> </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown active"> <a href="<?=site_url()?>">Home</a>
          </li>
		  <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">Rooms<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?=site_url()?>/main/room_list">Room List View</a></li>
              <li><a href="<?=site_url()?>/main/room_detail">Room Detail</a></li>
            </ul>
          </li>
          <li> <a href="<?=site_url()?>/main/gallery">Gallery</a></li>
          <li> <a href="<?=site_url()?>/main/contact_us">Contact Us</a></li>

        </ul>
      </div>
    </div>
  </div>
</header>
