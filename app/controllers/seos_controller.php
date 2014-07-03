<?php
class SeosController extends AppController {

	var $name = 'Seos';
    
    function admin_index()
    {
        if(isset($_POST["seo"]))
        {
            $seo=$_POST["seo"];
            $seo=base64_encode(serialize($seo));
            $this->Seo->query("update seos set v='$seo' where k='seo'");
        }
       
       $seo=$this->Seo->query("select v from seos where k='seo'");
       $seo= unserialize(base64_decode($seo[0]["seos"]["v"]));
       $this->set('seo',$seo);
    }
}
