<?php
require APPROOT . '/view/admin/include/head.php';
require APPROOT . '/view/admin/include/navigation.php';
require APPROOT . '/view/admin/include/sidebar.php';
?> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lista kurseva</h1><?php //echo rand ( 100000000 , 999999999 );?>
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
                                <th style="width:80px;">Fond casova srpski</th>
                                <th style="width:80px;">Fond casova engleski</th>
                                <th style="width:80px;">Naziv srpski</th>
                                <th style="width:80px;">Naziv engleski</th>
                                <th style="width:80px;">Opis srpski</th>
                                <th style="width:80px;">Opis engleski</th>
                                <th style="width:80px;">Izmeni</th>
                                <th style="width:80px;">Obrisi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        <?php foreach ($data['kursevi'] as $kurs):?>
                            <tr class="odd gradeX">
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $kurs->duzina_trajanja_srp;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $kurs->duzina_trajanja_eng;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $kurs->naziv_srp;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo $kurs->naziv_eng;?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo substr($kurs->opis_srp,0,5)."...";?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><?php echo substr($kurs->opis_eng,0,5)."...";?></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><a href="<?php echo URLROOT;?>/kursevi/showEdit/<?php echo $kurs->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;"></i></a></td>
                                <td class="center" style="vertical-align: middle;width:80px;"><a href="<?php echo URLROOT;?>/kursevi/delete/<?php echo $kurs->id;?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;"></i></a></td>
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
