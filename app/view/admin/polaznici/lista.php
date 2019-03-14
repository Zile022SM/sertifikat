<?php
require APPROOT . '/view/admin/include/head.php';
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lista polaznika</h1>
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
                                <th style="width:80px;">Broj</th>
                                <th style="width:80px;">Email</th>
                                <th style="width:80px;">Datum</th>
                                <th style="width:80px;">Izmeni</th>
                                <th style="width:80px;">Obrisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php foreach ($data['polaznici'] as $polaznik):?>
                            <tr class="odd gradeX">
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $polaznik->ime;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $polaznik->prezime;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $polaznik->broj_telefona;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $polaznik->email;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $polaznik->datum_rodjenja;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><a href="<?php echo URLROOT;?>/polaznici/showEdit/<?php echo $polaznik->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;"></i></a></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><a href="<?php echo URLROOT;?>/polaznici/delete/<?php echo $polaznik->id;?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;"></i></a></td>
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
