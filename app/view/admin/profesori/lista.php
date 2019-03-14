<?php
require APPROOT . '/view/admin/include/head.php';
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lista profesora</h1>
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
                                <th style="width:20px;">Id</th>
                                <th style="width:100px;">Slika</th>
                                <th style="width:100px;">Titula</th>
                                <th style="width:100px;">Ime</th>
                                <th style="width:100px;">Przime</th>
                                <th style="width:100px;">Izmeni</th>
                                <th style="width:100px;">Obrisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php foreach ($data['profesori'] as $profesor):?>
                            <tr class="odd gradeX">
                                <td style="vertical-align: middle;"><?php echo $profesor->id;?></td>
                                <td class="center" style="vertical-align: middle;"><img src="<?php echo URLROOT.'/img/profesori/'.$profesor->slika;?>" alt="" style="width:70px;height:auto;" class="img-thumbnail"/></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $profesor->titula_srp;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $profesor->ime;?></td>
                                <td class="center" style="vertical-align: middle;"><?php echo $profesor->prezime;?></td>
                                <td class="center" style="vertical-align: middle;"><a href="<?php echo URLROOT;?>/profesori/showEdit/<?php echo $profesor->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;"></i></a></td>
                                <td class="center" style="vertical-align: middle;"><a href="<?php echo URLROOT;?>/profesori/delete/<?php echo $profesor->id;?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;"></i></a></td>
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
