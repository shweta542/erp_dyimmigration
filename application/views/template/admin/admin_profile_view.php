
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Profile</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">User Profile</h4>
                            </div>
                            <div class="card-body m-t-15">
                                 <div class="form-validation">
                                    <form  id="editprofileForm">
                                       
                                        <div class="form-group ">
                                            <label>Username</label>
                                         
                                                <input type="text" class="form-control"  name="ADMIN_NAME" placeholder="Enter a username.." required="true"  value="<?=$adminData['ADMIN_NAME']?>">
                                           
                                        </div>
                                        <div class="form-group ">
                                            <label>Email</label>
                                                <input type="text" class="form-control"  name="ADMIN_EMAIL" placeholder="Your valid email.." required="true"  value="<?=$adminData['ADMIN_EMAIL']?>">
                                           
                                        </div>
                                         <div class="form-group ">
                                            <label>Phone</label>
                                                <input type="text" class="form-control"  name="ADMIN_PHONE" placeholder="Your valid Phone.." required="true" value="<?=$adminData['ADMIN_PHONE']?>">
                                           
                                        </div>
                                       
                                        <div class="form-group ">
                                            <div class="col-lg-12 ">
                                               <button type="submit" class="btn btn-info ">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
           