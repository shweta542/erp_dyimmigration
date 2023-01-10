
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Banner</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Banner</li>
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
                                <h4 class="m-b-0 text-white">Banner Setting</h4>
                            </div>
                            <div class="card-body m-t-15">
                                 <div class="form-validation">
                                    <?php if (!isset($currentBannerData)): ?>
                        <form class="" id="addBannerForm">
                            
                            <div class="form-group">
                                <label>Title</label>
                                <div>
                                    <input class="form-control" name="TITLE" placeholder="Enter Title" type="text" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>DESCRIPTION</label>
                                <div>
                                    <textarea type="text" class="form-control" name="DESCRIPTION"  required="true" placeholder="Enter DESCRIPTION"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Read More</label>
                                <input class="form-control" name="READ_MORE" placeholder="Enter Read More" type="text" >
                            </div> 
                            <div class="form-group">
                                <label>Seo Title</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_TITTLE" placeholder="Enter Seo Title"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Seo Keyword</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_KEYWORD" placeholder="Enter Seo Keyword" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Seo Description</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_DESCRIPTION" placeholder="Enter Seo Description" />
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                            <div class="form-group">
                                <label >Banner Image</label>
                                <input name="BANNER_IMAGE" type="file" class="inputFile">
                            </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                     <img src="https://login.sabia.ufrn.br//static/images/default.png" class="img_preview">   </div>
                                </div>
                            </div> 
                            <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-info"> Submit </button>
                                
                            </div>
                        </div>
                        </form>
                        <?php else: ?>   
                            <form class="" id="editBannerForm">
                                 <input type="hidden" name="BANNER_ID" value="<?=$currentBannerData['BANNER_ID']?>">
                              <div class="form-group">
                                <label for="CLASS_NAME">Title</label>
                                <input class="form-control" name="TITLE" placeholder="Enter Title" type="text" required="true" value="<?=$currentBannerData['TITTLE']?>">
                            </div>  
                               
                             <div class="form-group">
                                <label for="CLASS_NAME">Description</label>
                                 <textarea type="text" class="form-control" name="DESCRIPTION"  required="true"><?=$currentBannerData['DESCRIPTION']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="CLASS_NAME">Read More</label>
                                <input class="form-control" name="READ_MORE" placeholder="Enter Read More" type="text"  value="<?=$currentBannerData['READ_MORE']?>">
                            </div> 
                            <div class="form-group">
                                <label>Seo Title</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_TITLE" placeholder="Enter Seo Title"  value="<?= $currentBannerData['SEO_TITTLE']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Seo Keyword</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_KEYWORD" placeholder="Enter Seo Keyword" value="<?= $currentBannerData['SEO_KEYWORD']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Seo Description</label>
                                <div>
                                    <input type="text" class="form-control"  name="SEO_DESCRIPTION" placeholder="Enter Seo Description" value="<?= $currentBannerData['SEO_DESCRIPTION']?>"/>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                            <div class="form-group">
                                <label >Banner Image</label>
                                <input  name="BANNER_IMAGE" type="file" class="inputFile">
                            </div>  
                                </div>
                                <div class="col-md-6">
                                 <img src="<?=$currentBannerData['BANNER_IMAGE']?>" class="img_preview" >   
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-info"> Submit </button>
                                
                            </div>
                        </div>
                        </form>
                        <?php endif ?>
                                </div>
                            </div>
                        </div>
                         <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Banner List</h4>
                                <!-- <h6 class="card-subtitle">Data table example</h6> -->
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                             <tr>
                                                    <th width="10">#S.no</th>
                                                    <th width="10">Title</th>
                                                   
                                                    <th width="45">Description</th>
                                                    <th width="10">Read More</th>
                                                    <th width="10">Banner Image</th>
                                                    <th width="5">Last Update</th>
                                                    <th width="10">Action</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                                    <?php foreach ($bannerData as $key){?>
                                                        <tr>
                                                            <td width="10"><?=$i?></td>
                                                            <td width="10"><?=$key->TITTLE?></td>
                                                           
                                                            <td width="45"><?=$key->DESCRIPTION?></td>
                                                            <td width="10"><?=$key->READ_MORE?></td>
                                                            <td width="10" align="center"><img src="<?=$key->BANNER_IMAGE?>" height="50" width="50"></td>
                                                             <td width="5" align="center"><?=date('d-M-Y',strtotime($key->BANNER_MODIFY_DATETIME))?></td>
                                                            <td width="10" align="center">
                                                                <button onclick="window.location.href = '<?=base_url('admin/main/banner/'.$key->BANNER_ID)?>'" type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                                                <button onclick="deletebanner(<?=$key->BANNER_ID?>)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                            <?php
                                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
           