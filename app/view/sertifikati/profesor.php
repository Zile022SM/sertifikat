<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?php echo URLROOT;?>/css/front/profesor.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container portfolio">
    <div class="text-right" style="margin-bottom:-75px;">
	     <!-- Uneti ovde putanju do pocetne strane sajta -->
	     <a href="#" class="btn btn-info" role="button" style="margin-top:10px;"><?php echo ($data['jezik']=='srp')?'Pocetna strana':'Homepage';?></a>
	   </div>
    <div class="row float-left">
       
       <div class="col-md">
           <h6><b>Jezik/Language</b></h6>
           <?php if (!empty($data['profesor'])){?>
           <span style="margin-left:-40px;"><a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $data['profesor']->id;?>/<?php echo $jezik='srp';?>/"><img src="<?php echo URLROOT;?>/img/flags/serbia32.png" class="flag flag-sr slika" alt="" /></a></span>
            <span style="margin-left:5px;"><a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $data['profesor']->id;?>/<?php echo $jezik='eng';?>/"><img src="<?php echo URLROOT;?>/img/flags/uk32.png" class="flag flag-sr slika" alt="" /></a></span>
           <?php }else{?>
            <span style="margin-left:-40px;"><a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $id=0;?>/<?php echo $jezik='srp';?>/"><img src="<?php echo URLROOT;?>/img/flags/serbia32.png" class="flag flag-sr slika" alt="" /></a></span>
            <span style="margin-left:5px;"><a href="<?php echo URLROOT;?>/sertifikati/profesor/<?php echo $id=0;?>/<?php echo $jezik='eng';?>/"><img src="<?php echo URLROOT;?>/img/flags/uk32.png" class="flag flag-sr slika" alt="" /></a></span>
           <?php }?>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

	<div class="bio-info">
	<?php if (!empty($data['profesor'])){?>
		<div class="row">
			<div class="col-md-6 col-sm">
				<div class="row">
					<div class="col-md-12">
						<div class="bio-image">
							<img src="<?php echo URLROOT.'/img/profesori/'.$data['profesor']->slika;?>" alt="image" style="height:200px;width:250px;" class="img-thumbnail"/>
						</div>			
					</div>
				</div>	
			</div>
			<div class="col-md-6 col-sm">
				<div class="bio-content">
					<h1><?php echo ($data['jezik']=='srp')?$data['profesor']->titula_srp:$data['profesor']->titula_eng?><br><?php echo $data['profesor']->ime ." ". $data['profesor']->prezime;?></h1>
					<p><?php echo ($data['jezik']=='srp')?$data['profesor']->opis_srp:$data['profesor']->opis_eng?></p>
					
				</div>
			</div>
		</div>
		<?php }else{?> 
		        <div class="row">
					<div class="col-md-12 col-sm">
						<div class="bio-image">
							<img src="<?php echo URLROOT;?>/img/errors/greska.jpg" alt="image" style="height:auto;width:600px;" class="img-thumbnail"/>
						</div>			
					</div>
				</div>
		<?php }?>	
	</div>
</div>