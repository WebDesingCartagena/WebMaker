<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of functionsPhp
 *
 * @author barc
 */
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class functionsPhp {
    //put your code here
    public function __construct() {
        
    }
    public function mkjsPHP($scrp1 = ";",$jquery= ";",$scrp2 = ";")
    {
            $j="<script>";
            $j.=$scrp1;
            $j.="$(document).ready(function(){";
            $j.=$jquery;
            $j.="});";
            $j.=$scrp2;
            $j.="</script>\n";
            echo $j;
    }
    
    public function mkjqueryPHP($html,$method='empty',$jquery='',$hold="html")
    {
        if($jquery=='')
        {
            return "$('$html').$method();";
        }
        if($hold=="html"){
        return "$('$html').$method('$jquery');";}
    else {
        return "$('$html').$method($jquery);";
    }
    }
    public function mkjhtmlPHP($html, $attr= array("class"=>""),$text='', $jp="first",$etiquets=1)
    {
        
         $j=""; 
        if($jp=="final"){//javascript position
             $j.="'+'";   
        }
        if($etiquets==2){
            
            
            $j.="<$html ";
            foreach($attr as $i=>$k)
            {
              $j.=" $i='+'$k'+'";  
            }
            $j.=">$text</$html>";
           
            
            
            return $j;
        }else
        if($etiquets==1)
        {
            $j="<$html ";
            foreach($attr as $i=>$k)
            {
              $j.=" $i='+'$k'+'";  
            }
            $j.=">";
            return $j;  
        }
        
    }
    
    public function createForm($url,$html_putform="body",$html_inputs=array(["html"=>"input","type"=>"text","name"=>""]),$method='post'){
        
        $i="";
        
            foreach($html_inputs as $a) 
            {
               $html="";
               $attr=array();
               $text="";
               foreach($a as $b=>$c)
               {
                   
                     
                   if($b=="html"){
                      $html=$c;
                   }else if($b=="text")
                   {
                       $text=$c;
                   }else
                   {
                     $attr[$b]=$c;
                   }
                   
               }
               if($html=="input"||$html=="img"||$html=="link"||$html=="meta"){
                $i.=$this->mkjhtmlPHP($html, $attr);
               }else{
                $i.=$this->mkjhtmlPHP($html, $attr,$text,"frist",2);
               }
               
            }       
        $j=$this->mkjhtmlPHP("form",array("action"=>$url,"method"=>$method),$i,"frist",2);
        $k=$this->mkjqueryPHP($html_putform,"append",$j);
        $this->mkjsPHP(";", $k);
    }
    
    public function custom_form_register($url, $html_putfrom,$html_array=["html"=>"input","style"=>"display:none;"]){
        $html_inputs=[
            ["html"=>"input","type"=>"text","name"=>"nombre","placeholder"=>"Email"],
            ["html"=>"input","type"=>"text","name"=>"apellido","placeholder"=>"Apellido"],
            ["html"=>"input","type"=>"password","name"=>"pass","placeholder"=>"Contraseña"],
            ["html"=>"input","type"=>"password","name"=>"pass2","placeholder"=>"Re-Contraseña"],           
            ["html"=>"input","type"=>"email","name"=>"email","placeholder"=>"Email"],
            ["html"=>"input","type"=>"submit"], $html_array
            
        ];
        
        $this->createForm($url, $html_putfrom, $html_inputs);
    }
    
    public function custom_form_login($url, $html_putfrom,$html_array=["html"=>"input","style"=>"display:none;","value"=>""]){
        $html_inputs=[
            ["html"=>"input","type"=>"email","name"=>"email","placeholder"=>"Email"],
            ["html"=>"input","type"=>"password","name"=>"pass","placeholder"=>"Contraseña"],            
            ["html"=>"input","type"=>"submit"], $html_array            
        ];
        
        $this->createForm($url, $html_putfrom, $html_inputs);
    }
    
}