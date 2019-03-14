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
                    <h1 class="page-header">Unesi polaznika</h1>
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
                                    <form role="form" action="<?php echo URLROOT;?>/polaznici/insert" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Ime polaznika</label>
                                            <input type="text" name="ime" value="<?php echo isset($data["ime"]) ? htmlspecialchars($data["ime"]) : "";?>" class="form-control" placeholder="Unesi ime">
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
                                            <label>Prezime polaznika</label>
                                            <input type="text" name="prezime" value="<?php echo isset($data["prezime"]) ? htmlspecialchars($data["prezime"]) : "";?>" class="form-control" placeholder="Unesi prezime">
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
                                            <label>Broj telefona</label>
                                            <input type="text" name="broj" value="<?php echo isset($data["broj"]) ? htmlspecialchars($data["broj"]) : "";?>" class="form-control" placeholder="Unesi broj">
                                            <?php 
						                        if (isset($data['broj_error'])) {
						                            foreach($data['broj_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" value="<?php echo isset($data["email"]) ? htmlspecialchars($data["email"]) : "";?>" class="form-control" placeholder="Unesi email">
                                            <?php 
						                        if (isset($data['email_error'])) {
						                            foreach($data['email_error'] as $errorMessage) {
						                                ?>
						                                    <span style="color:red;"><b><?php echo $errorMessage;?></b></span>
						                                <?php
						                            }
						                        }
						                    ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Datum rodjenja</label>
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
                                        <button type="submit" name="click" value="Save" class="btn btn-success">Snimi polaznika</button>
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
