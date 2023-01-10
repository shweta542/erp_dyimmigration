
    <!-- Main wrapper  -->
    <div id="main-wrapper">
       
        
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Compose Email</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Compose Email</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Compose Email</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-content">
                                        <div class="mt-4">

                                            <form action="<?= base_url('admin/main/email') ?>" method="POST" id="emailform">
                                                <div class="form-group">
                                                     <label>To</label>
                                                             <div>
                                                    <input type="email" class="form-control" placeholder="To" name="toemail" required="true">
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                     <label>Subject</label>
                                                             <div>
                                                    <input type="text" class="form-control" placeholder="Subject" name="subject" required="true">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Message</label>
                                                             <div>
                                                    <textarea name="dec" id="dec" rows="8" cols="80" class="form-control" style="height:300px" placeholder="Write Here" required="true"></textarea>
                                                </div>
                                                </div>

                                                <div class="form-group m-b-0">
                                                    <div class="text-left">
                                                       <!--  <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-floppy-o"></i></button> -->
                                                        <button type="button" id="reset" class="btn btn-success waves-effect waves-light m-r-5"><i class="fa fa-refresh"></i></button>
                                                        <button class="btn btn-purple waves-effect waves-light"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                        <!-- end card-->

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
  