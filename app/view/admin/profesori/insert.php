<?php
require APPROOT . '/view/admin/include/head.php';
?> 
<script src="//cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<?php
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Unesi profesora</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php echo URLROOT;?>/profesori/insert" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Titula na srpskom</label>
                                            <input type="text" name="titula_srp" value="<?php echo isset($data["titula_srp"]) ? htmlspecialchars($data["titula_srp"]) : "";?>" class="form-control" placeholder="Unesi titulu srpski">
                                            <?php 
						                        if (isset($data['titula_srp_error'])) {
						                            foreach($data['titula_srp_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Titula na engleskom</label>
                                            <input type="text" name="titula_eng" value="<?php echo isset($data["titula_eng"]) ? htmlspecialchars($data["titula_eng"]) : "";?>" class="form-control" placeholder="Unesi titulu engleski">
                                            <?php 
						                        if (isset($data['titula_eng_error'])) {
						                            foreach($data['titula_eng_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Ime profesora</label>
                                            <input type="text" name="ime" value="<?php echo isset($data["ime"]) ? htmlspecialchars($data["ime"]) : "";?>" class="form-control" placeholder="Unesi ime profesora">
                                            <?php 
						                        if (isset($data['ime_error'])) {
						                            foreach($data['ime_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Prezime profesora</label>
                                            <input type="text" name="prezime" value="<?php echo isset($data["prezime"]) ? htmlspecialchars($data["prezime"]) : "";?>" class="form-control" placeholder="Unesi prezime profesora">
                                            <?php 
						                        if (isset($data['prezime_error'])) {
						                            foreach($data['prezime_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Opis na srpskom</label>
                                            <textarea class="form-control" rows="3" name="editor1"><?php echo isset($data["editor1"]) ? htmlspecialchars($data["editor1"]) : "";?></textarea>
                                            <?php 
						                        if (isset($data['editor1_error'])) {
						                            foreach($data['editor1_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Opis na engleskom</label>
                                            <textarea class="form-control" rows="3" name="editor2"><?php echo isset($data["editor2"]) ? htmlspecialchars($data["editor2"]) : "";?></textarea>
                                            <?php 
						                        if (isset($data['editor2_error'])) {
						                            foreach($data['editor2_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Unesi sliku profesora</label>
                                            <input  type="file" name="image">
                                            <?php 
						                        if (isset($data['image_error'])) {
						                            foreach($data['image_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <br>
			                            
                                        <button type="submit" name="click" value="Save" class="btn btn-success">Snimi profesora</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script>
	CKEDITOR.replace( 'editor1' );
</script>
<script>
	CKEDITOR.replace( 'editor2' );
</script>
<?php
 require APPROOT.'/view/admin/include/footer.php';
?> 
