<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

<div style=" margin: auto;  margin: auto;    padding-left: 10px;    width: 960px;" class="container">
<div class="container">
<div class="span-24" id="contactform" style="padding: 20px;">
<h2><?___("Tus Datos")?></h2>
<?php echo $this->Form->create('Usuario',array("id"=>"contactform"));?>
	<?php
		
        echo $this->Form->input('company',array('class'=>'validate[required]]','size'=>'50','label'=>___(utf8_encode('Nombre de la Compañia*'),1),'div'=>array('class'=>'contact marright')));
        echo $this->Form->input('name',array('class'=>'validate[required]','size'=>'50','label'=>___('Nombre*',1),'div'=>array('class'=>'contact marright smalls')));
        echo $this->Form->input('surname',array('class'=>'validate[required]','size'=>'50','label'=>___('Apellido*',1),'div'=>array('class'=>'contact smalls')));
        echo $this->Form->input('email',array('style'=>'background-color: #F6F6F4;', 'class'=>'validate[required,custom[email]]','disabled'=>'true','size'=>'50','label'=>'Email*','div'=>array('class'=>'contact')));
        //echo $this->Form->input('direccion',array('class'=>'validate[required]','size'=>'50','label'=>___("Direcci&oacute;n 1*",true),'div'=>array('class'=>'contact')));
        //echo $this->Form->input('direccion2',array('size'=>'50','label'=>___("Direcci&oacute;n 2",true),'div'=>array('class'=>'contact')));
        
        echo $this->Form->input('country',array('class'=>'validate[required]','size'=>'50','label'=>___("Pais*",true),'div'=>array('class'=>'contact')));
        echo $this->Form->input('city',array('class'=>'validate[required]','size'=>'50','label'=>___("Ciudad*",true),'div'=>array('class'=>'contact')));
        //echo $this->Form->input('countyprovince',array('size'=>'50','label'=>___("Condado/Provincia",true),'div'=>array('class'=>'contact')));
        echo $this->Form->input('codigo_postal',array('class'=>'validate[required]','size'=>'50','label'=>___("C&oacute;digo Postal*",true),'div'=>array('class'=>'contact')));
        
        echo $this->Form->input('telefonos',array('class'=>'validate[required]','size'=>'50','label'=>___("Tel&eacute;fono*",true),'div'=>array('class'=>'contact')));
        echo $this->Form->input('fax',array('size'=>'50','label'=>___("Fax",true),'div'=>array('class'=>'contact')));
        echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>___('Impuestos*',1), 'id' =>'impuestos' ,'options'=>array(''=>___('Seleccione',1),1=>___('IVA Registrado',1),0=>___('IVA No Registrado',1) )));
    ?>
        <div class="nit" style="display: none;">
        <?php echo $this->Form->input('nit',array('label'=>false,'div'=>array('class'=>'contact mids'),'class' => 'validate[required]','disabled'=>'disabled','size'=>'50'));?>
        <label style="clear: both;"  ><?php ___("*If you are VAT registered you must provide us with a valid VAT Number otherwise the respective VAT amount will be charged to the total invoice") ?></label>
        </div>
     <?php    
        //echo $this->Form->input('cif',array('label'=>___("Cif",1)));
        echo $this->Form->input('denv',array('size'=>'50','label'=>___(utf8_encode("Direcci&oacute;n de entrega"),1),'div'=>array('class'=>'contact')));
        echo $this->Form->input('dfac',array('size'=>'50','label'=>___(utf8_encode("Dirección de Facturación"),1),'div'=>array('class'=>'contact') ));
	?>
    <a onclick="$(this).parent('form').submit();" title="comprar" class="button"><?php ___("Cambiar mis datos")?></a>
    <div style="display: none;">    
        <div id="fancy">
        <h3>Privacy</h3>
        <p style="width: 600px;">        
        Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per. Ius id vidit volumus mandamus, vide veritus democritum te nec, ei eos debet libris consulatu. No mei ferri graeco dicunt, ad cum veri accommodare. Sed at malis omnesque delicata, usu et iusto zzril meliore. Dicunt maiorum eloquentiam cum cu, sit summo dolor essent te. Ne quodsi nusquam legendos has, ea dicit voluptua eloquentiam pro, ad sit quas qualisque. Eos vocibus deserunt quaestio ei. Blandit incorrupte quaerendum in quo, nibh impedit id vis, vel no nullam semper audiam. Ei populo graeci consulatu mei, has ea stet modus phaedrum. Inani oblique ne has, duo et veritus detraxit. Tota ludus oratio ea mel, offendit persequeris ei vim. Eos dicat oratio partem ut, id cum ignota senserit intellegat. Sit inani ubique graecis ad, quando graecis liberavisse et cum, dicit option eruditi at duo. Homero salutatus suscipiantur eum id, tamquam voluptaria expetendis ad sed, nobis feugiat similique usu ex. Eum hinc argumentum te, no sit percipit adversarium, ne qui feugiat persecuti. Odio omnes scripserit ad est, ut vidit lorem maiestatis his, putent mandamus gloriatur ne pro. Oratio iriure rationibus ne his, ad est corrumpit splendide. Ad duo appareat moderatius, ei falli tollit denique eos. Dicant evertitur mei in, ne his deserunt perpetua sententiae, ea sea omnes similique vituperatoribus. Ex mel errem intellegebat comprehensam, vel ad tantas antiopam delicatissimi, tota ferri affert eu nec. Legere expetenda pertinacia ne pro, et pro impetus persius assueverit. Ea mei nullam facete, omnis oratio offendit ius cu. Doming takimata repudiandae usu an, mei dicant takimata id, pri eleifend inimicus euripidis at. His vero singulis ea, quem euripidis abhorreant mei ut, et populo iriure vix. Usu ludus affert voluptaria ei, vix ea error definitiones, movet fastidii signiferumque in qui. Vis prodesset adolescens adipiscing te, usu mazim perfecto recteque at, assum putant erroribus mea in. Vel facete imperdiet id, cum an libris luptatum perfecto, vel fabellas inciderint ut. Veri facete debitis ea vis, ut eos oratio erroribus. Sint facete perfecto no vel, vim id omnium insolens. Vel dolores perfecto pertinacia ut, te mel meis ullum dicam, eos assum facilis corpora in. Mea te unum viderer dolores, nostrum detracto nec in, vis no partem definiebas constituam. Dicant utinam philosophia has cu, hendrerit prodesset at nam, eos an bonorum dissentiet. Has ad placerat intellegam consectetuer, no adipisci mandamus senserit pro, torquatos similique percipitur est ex. Pro ex putant deleniti repudiare, vel an aperiam sensibus suavitate. Ad vel epicurei convenire, ea soluta aliquid deserunt ius, pri in errem putant feugiat. Sed iusto nihil populo an, ex pro novum homero cotidieque. Te utamur civibus eleifend qui, nam ei brute doming concludaturque, modo aliquam facilisi nec no. Vidisse maiestatis constituam eu his, esse pertinacia intellegam ius cu. Eos ei odio veniam, eu sumo altera adipisci eam, mea audiam prodesset persequeris ea. Ad vitae dictas vituperata sed, eum posse labore postulant id. Te eligendi principes dignissim sit, te vel dicant officiis repudiandae. Id vel sensibus honestatis omittantur, vel cu nobis commune patrioque. In accusata definiebas qui, id tale malorum dolorem sed, solum clita phaedrum ne his. Eos mutat ullum forensibus ex, wisi perfecto urbanitas cu eam, no vis dicunt impetus. Assum novum in pri, vix an suavitate moderatius, id has reformidans referrentur. Elit inciderint omittantur duo ut, dicit democritum signiferumque eu est, ad suscipit delectus mandamus duo. An harum equidem maiestatis nec. At has veri feugait placerat, in semper offendit praesent his. Omnium impetus facilis sed at, ex viris tincidunt ius. Unum eirmod dignissim id quo. Sit te atomorum quaerendum neglegentur, his primis tamqua
        </p>
        </div>    
    </div>

</form>
</div>
</div>
</div>
<script>
    var impuesto = jQuery("#impuestos").find("option:selected").val();
    if(impuesto == 1){
        $(".nit").fadeIn("slow");
        $(".nit").find("input").removeAttr("disabled");        
    }
    
    jQuery("#impuestos").change(function(){
        if($(this).val() == 1){
            $(".nit").fadeIn("slow");
            $(".nit").find("input").removeAttr("disabled");
        }else{
            $(".nit").fadeOut("slow");
            $(".nit").find("input").atrr("disabled","disabled");
        }
    });
 jQuery("form#contactform").validationEngine();
</script>