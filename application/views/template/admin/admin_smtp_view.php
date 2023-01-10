
    <!-- Main wrapper  -->
    <div id="main-wrapper">
       
        
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">SMTP</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">SMTP</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container">
                <!-- Start Page Content -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">SMTP Setting</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-content">
                                        <div class="mt-4">
                                            <form   id="smtpform">
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                             <label>Host</label>
                                                             <div>
                                                                  <input type="text" class="form-control" placeholder="Enter Host" name="SMTP_HOST" required="true" value="<?= $smtpData->SMTP_HOST ?>">
                                                             </div>
                                                   
                                                </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                            <label>Port</label>
                                                            <div>
                                                                <input type="text" class="form-control" placeholder="Enter Port" name="SMTP_PORT" required="true" value="<?= $smtpData->SMTP_PORT ?>">
                                                            </div>
                                                    
                                                </div>
                                                    </div>
                                               
                                                
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                             <label>Email</label>
                                                             <div>
                                                                 <input type="email" class="form-control" placeholder="Enter Email" name="SMTP_EMAIL" required="true" value="<?= $smtpData->SMTP_EMAIL ?>">
                                                             </div>
                                                    
                                                </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                         <div class="form-group">
                                                             <label>Password</label>
                                                             <div>
                                                                 <input type="password" class="form-control" placeholder="Enter Password" name="SMTP_PASSWORD" required="true" value="<?= $smtpData->SMTP_PASSWORD ?>">
                                                             </div>
                                                    
                                                </div>
                                                    </div>
                                               

                                                

                                                <div class="form-group ">
                                            <div class="col-lg-12 ">
                                               <button type="submit" class="btn btn-info ">Submit</button>
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
  