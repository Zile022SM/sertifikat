<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?php echo URLROOT;?>/css/front/sertifikat.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container emp-profile col-md-9">
                <div class="text-center">
                   <img src="http://www.procoding.rs/wp-content/uploads/2018/03/Logo.png" alt="" style="width:200px;height:80px;" class="img" />
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-8 offset-1">
                    <?php //echo $data['test'];?>
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active  id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <h6><b>Jezik/Language</b></h6>
                                        <div class="row">
                                        <div class="col-md-6">
                                          <span style="margin-left:5px;"><a href="<?php echo URLROOT;?>/sertifikati/srpski/<?php echo $data['data']->broj_sertifikata;?>"><img src="<?php echo URLROOT;?>/img/flags/serbia32.png" class="flag flag-sr slika" alt="" /></a></span>
                                          <span style="margin-left:5px;"><a href="<?php echo URLROOT;?>/sertifikati/engleski/<?php echo $data['data']->broj_sertifikata;?>"><img src="<?php echo URLROOT;?>/img/flags/uk32.png" class="flag flag-sr slika" alt="" /></a></span>
                                         </div>
                                         <div class="col-md-6">
                                           <a href="#" class="btn btn-info" role="button" style="margin-top:10px;"><?php echo ($data['status']=='srpski')?'Pocetna strana':'Homepage';?></a>
                                         </div> 
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Broj sertifikata :':'Number of certificate :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data['data']->broj_sertifikata; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Ime :':'Name :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data['data']->ime; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Prezime :':'Last Name :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data['data']->prezime; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Kurs :':'Course :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ($data['status']=='srpski')?$data['data']->naziv_srp:$data['data']->naziv_eng; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Opis :':'Description :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo ($data['status']=='srpski')?$data['data']->opis_srp:$data['data']->opis_eng; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Datum zavrsetka :':'Date of completion :';?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data['data']->datum_dobijanja; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><?php echo ($data['status']=='srpski')?'Profesori :':'Instructors :';?></label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                                <?php foreach ($data['profesori'] as $profesor): ?>
                                                <div class="col-lg-6 col-md-6 col-sm">
                                                <a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $profesor->id_predavaca; ?>/<?php echo $jezik='srp';?>/"><img src="<?php echo URLROOT.'/img/profesori/'.$profesor->slika; ?>" alt="" style="width:200px;height:200px;" class="img-thumbnail"/></a>
                                                <a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $profesor->id_predavaca; ?>/<?php echo $jezik='srp';?>/"><p style="margin-top:10px;" class="profa"><?php echo ($data['status']=='srpski')?$profesor->titula_srp:$profesor->titula_eng;?> <br><?php echo $profesor->ime." ".$profesor->prezime; ?></p></a>
                                                <a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $profesor->id_predavaca; ?>/<?php echo $jezik='srp';?>/" class="btn btn-info" role="button" style="margin-bottom:25px;"><?php echo ($data['status']=='srpski')?'Detaljnije':'More';?>...</a>
                                                </div>
                                                <?php endforeach;?>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
