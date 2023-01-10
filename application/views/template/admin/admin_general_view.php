
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">General</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">General</li>
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
                                <h4 class="m-b-0 text-white">Update General Setting</h4>
                            </div>
                            <div class="card-body m-t-15">
                                 <div class="form-validation">
                                    <form  id="editgeneralForm">
                                       
                                       <div class="form-group">
                                <label for="CLASS_NAME">Email</label>
                                <input class="form-control" name="EMAIl" placeholder="Enter Email" type="email" required="true" value="<?php echo $gemeralData->EMAIL?>">
                                <input class="form-control" name="GENERAL_ID" placeholder="Enter Email" type="hidden" required="true" value="<?php echo $gemeralData->GENERAL_ID?>">
                            </div>  
                              <div class="form-group">
                                <label for="CLASS_NAME">Phone</label>
                                <input class="form-control" name="PHONE" placeholder="Enter Phone" type="text" required="true" value="<?php echo $gemeralData->PHONE?>">
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Address</label>
                                <input class="form-control" name="ADDRESS" placeholder="Enter Address" type="text" required="true" value="<?php echo $gemeralData->ADDRESS?>">
                            </div> 
                             <div class="form-group">
                                <label for="CLASS_NAME">Facebook</label>
                                <input class="form-control" name="FACEBOOK_LINK" placeholder="Enter Facebook" type="text" required="true" value="<?php echo $gemeralData->FACEBOOK_LINK?>">
                            </div>
                             <div class="form-group">
                                <label for="CLASS_NAME">Twitter</label>
                                <input class="form-control" name="TWITTER_LINK" placeholder="Enter Twitter" type="text" required="true" value="<?php echo $gemeralData->TWITTER_LINK?>" >
                            </div>
                             <div class="form-group">
                                <label for="CLASS_NAME">Google Plus</label>
                                <input class="form-control" name="GOOGLE_PLUS_LINK" placeholder="Enter Google Plus" type="text" required="true" value="<?php echo $gemeralData->GOOGLE_PLUS_LINK?>" >
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Pinterest</label>
                                <input class="form-control" name="PINTEREST_LINK" placeholder="Enter Pinterest" type="text" required="true" value="<?php echo $gemeralData->PINTEREST_LINK?>" >
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Instagram</label>
                                <input class="form-control" name="INSTAGRAM_LINK" placeholder="Enter Instagram" type="text" required="true" value="<?php echo $gemeralData->INSTAGRAM_LINK?>" >
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Youtube</label>
                                <input class="form-control" name="YOUTUBE_LINK" placeholder="Enter youtube" type="text" required="true" value="<?php echo $gemeralData->YOUTUBE_LINK?>" >
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Footer About</label>
                                <textarea class="form-control" name="FOOTER_ABOUT" placeholder="Enter About" required="true"><?php echo $gemeralData->FOOTER_ABOUT?></textarea>
                            </div> 
                             <div class="form-group">
                                <label for="CLASS_NAME">Section First</label>
                                <textarea class="form-control" name="SECTION_FIRST" placeholder="Enter Section" required="true"><?php echo $gemeralData->SECTION_FIRST?></textarea>
                            </div> 
                             <div class="form-group">
                                <label for="CLASS_NAME">Section Second</label>
                                <textarea class="form-control" name="SECTION_SECOND" placeholder="Enter Section" required="true"><?php echo $gemeralData->SECTION_SECOND?></textarea>
                            </div> 
                             <div class="form-group">
                                <label for="CLASS_NAME">Section Third</label>
                                <textarea class="form-control" name="SECTION_THIRD" placeholder="Enter Section" required="true"><?php echo $gemeralData->SECTION_THIRD?></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="CLASS_NAME">News Letter</label>
                                <textarea class="form-control" name="NEWS_LETTER" placeholder="Enter News Letter" required="true"><?php echo $gemeralData->NEWS_LETTER?></textarea>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                            <div class="form-group">
                                <label for="CLASS_NAME">LOGO</label>
                                <input  name="LOGO" type="file" class="inputFile">
                            </div>  
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                <img    src="<?php echo $gemeralData->LOGO ?>" class="img_preview"></div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-info "> Submit </button>
                                
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
           