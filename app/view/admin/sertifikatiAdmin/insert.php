<?php 
require APPROOT . '/view/admin/include/head.php'; 
?> 
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<?php
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Unesi sertifikat</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <p style="color:red;font-size:24px;"><b><?php echo isset($data["status"]) ? htmlspecialchars($data["status"]) : "";?></b></p>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php echo URLROOT;?>/certificate/insert" method="post" enctype="multipart/form-data">
                                    
                                        <div class="form-group">
                                            <label>Polaznik</label>
                                            <select class="form-control" name="polaznik" style="text-align:center;">
                                               <option value="">--Izaberi polaznika--</option>
                                               <?php foreach ($data['polaznici'] as $polaznik):?>
                                               <option value="<?php echo $polaznik->id;?>"<?php echo isset($data['polaznik']) && $data['polaznik'] == $polaznik->id ? " selected=\"\"" : "";?>><?php echo $polaznik->ime." ".$polaznik->prezime;?></option>
                                               <?php endforeach;?>
                                            </select>
                                            <?php 
						                        if (isset($data['polaznik_error'])) {
						                            foreach($data['polaznik_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Kurs</label>
                                            <select class="form-control" name="kurs" style="text-align:center;">
                                              <option value="">--Izaberi kurs--</option>
                                              <?php foreach ($data['kursevi'] as $kurs):?>
                                              <option value="<?php echo $kurs->id;?>"<?php echo isset($data['kurs']) && $data['kurs'] == $kurs->id ? " selected=\"\"" : "";?>><?php echo $kurs->naziv_srp;?></option>
                                              <?php endforeach;?>
                                            </select>
                                            <?php 
						                        if (isset($data['kurs_error'])) {
						                            foreach($data['kurs_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Datum dobijanja sertifikata</label>
                                            <input id="datepicker" type="text" name="datum" value="<?php echo isset($data["datum"]) ? htmlspecialchars($data["datum"]) : "";?>" class="form-control" placeholder="Unesi datum">
                                            <?php 
						                        if (isset($data['datum_error'])) {
						                            foreach($data['datum_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <br>
                                        <button type="submit" name="click" value="Save" class="btn btn-success">Snimi sertifikat</button>
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
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
</script>
<?php
 require APPROOT.'/view/admin/include/footer.php';
?> 
