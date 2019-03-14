<?php
require APPROOT . '/view/admin/include/head.php';
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lista Predavac - Kurs</h1>
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
                                <th style="width:20px;">Ime</th>
                                <th style="width:100px;">Prezime</th>
                                <th style="width:100px;">Naziv</th>
                                <th style="width:100px;">Pocetak</th>
                                <th style="width:100px;">Zavrsetak</th>
                                <th style="width:100px;">Izmeni</th>
                                <th style="width:100px;">Obrisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php foreach ($data['rasporedi'] as $raspored):?>
                            <tr class="odd gradeX">
                                <td style="vertical-align: middle;"><?php echo $raspored->ime;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $raspored->prezime;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $raspored->naziv;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $raspored->pocetak;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $raspored->zavrsetak;?></td>
                                <td class="center" style="vertical-align: middle;"><a href="<?php echo URLROOT;?>/rasporedi/showEdit/<?php echo $raspored->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;"></i></a></td>
                                <td class="center" style="vertical-align: middle;"><a href="<?php echo URLROOT;?>/rasporedi/delete/<?php echo $raspored->id;?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;"></i></a></td>
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
