<?php
require APPROOT . '/view/admin/include/head.php';
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lista sertifikata</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-11">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="tabela">
                        <thead>
                            <tr>
                                <th style="width:80px;">Ime</th>
                                <th style="width:80px;">Prezime</th>
                                <th style="width:80px;">Naziv</th>
                                <th style="width:80px;">Broj</th>
                                <th style="width:80px;">datum dobijanja</th>
                                <th style="width:80px;">Obrisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php foreach ($data['lista'] as $lista):?>
                            <tr class="odd gradeX">
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $lista->ime;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $lista->prezime;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $lista->naziv;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $lista->broj;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $lista->datum;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><a href="<?php echo URLROOT;?>/certificate/delete/<?php echo $lista->id;?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;"></i></a></td>
                            </tr>
                        <?php endforeach;?> 
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
<?php
require APPROOT . '/view/admin/include/tablejQuery.php';
require APPROOT . '/view/admin/include/footer.php';
?> 
