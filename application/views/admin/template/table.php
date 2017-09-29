
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$subData['titleFirst']?>
        <small><?=$subData['titleSecond']?> </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-bus"></i> Home</a></li>
        <li class="active"><?=$subData['titleFirst']?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->

 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?=$subData['boxTitle']?></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="tableData" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <?
                    foreach ($subData['headers'] as $val) {
                      echo "<th>" . $val . "</th>";
                    }
                  ?>
                </tr>
                </thead>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
