<?php 
require APPROOT . '/view/admin/include/head.php'; 
?> 
<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
<?php
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Izmeni kurs</h1>
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
                                    <form role="form" action="<?php echo URLROOT;?>/kursevi/edit" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Duzina trajanja srpski</label>
                                            <input type="text" name="duzina_trajanja_srp" value="<?php echo isset($data["duzina_trajanja_srp"]) ? htmlspecialchars($data["duzina_trajanja_srp"]) : "";?>" class="form-control" placeholder="Duzina trajanja srpski">
                                            <?php 
						                        if (isset($data['duzina_trajanja_srp_error'])) {
						                            foreach($data['duzina_trajanja_srp_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Duzina trajanja engleski</label>
                                            <input type="text" name="duzina_trajanja_eng" value="<?php echo isset($data["duzina_trajanja_eng"]) ? htmlspecialchars($data["duzina_trajanja_eng"]) : "";?>" class="form-control" placeholder="Duzina trajanja engleski">
                                            <?php 
						                        if (isset($data['duzina_trajanja_eng_error'])) {
						                            foreach($data['duzina_trajanja_eng_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Naziv kursa srpski</label>
                                            <input type="text" name="naziv_srp" value="<?php echo isset($data["naziv_srp"]) ? htmlspecialchars($data["naziv_srp"]) : "";?>" class="form-control" placeholder="Naziv srpski">
                                            <?php 
						                        if (isset($data['naziv_srp_error'])) {
						                            foreach($data['naziv_srp_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Naziv kursa engleski</label>
                                            <input type="text" name="naziv_eng" value="<?php echo isset($data["naziv_eng"]) ? htmlspecialchars($data["naziv_eng"]) : "";?>" class="form-control" placeholder="Naziv engleski">
                                            <?php 
						                        if (isset($data['naziv_eng_error'])) {
						                            foreach($data['naziv_eng_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Opis na srpskom</label>
                                            <textarea class="form-control" rows="3"  name="opis_srp"><?php echo isset($data["opis_srp"]) ? htmlspecialchars($data["opis_srp"]) : "";?></textarea>
                                            <?php 
						                        if (isset($data['opis_srp_error'])) {
						                            foreach($data['opis_srp_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Opis na engleskom</label>
                                            <textarea class="form-control" rows="3" name="opis_eng"><?php echo isset($data["opis_eng"]) ? htmlspecialchars($data["opis_eng"]) : "";?></textarea>
                                            <?php 
						                        if (isset($data['opis_eng_error'])) {
						                            foreach($data['opis_eng_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo isset($data['id']) ? htmlspecialchars($data['id']) : "";?>">
                                        <br>
                                        <button type="submit" name="click" value="Edit" class="btn btn-success">Snimi kurs</button>
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
    CKEDITOR.replace( 'opis_srp' );
</script>
<script>
	CKEDITOR.replace( 'opis_eng' );
</script>
<?php
 require APPROOT.'/view/admin/include/footer.php';
?> 
