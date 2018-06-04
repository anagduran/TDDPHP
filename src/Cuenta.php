<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta
 *
 * @author ana
 */
class Cuenta {
    //put your code here
    
    private $saldo;
    
    public function __construct() {
        $this-> saldo =0;
        
    }
    
    public function getSaldo()
    {
        return $this ->saldo;
    }
    
    public function ValidadCantidadIngresada($cantidad)
    {
         if(round($cantidad,2)!=$cantidad)
        {
           return false;
        } 
        
        if ($cantidad<0)
           {
            return false;
           } 
           
           if ($cantidad>6000.00) {
               return false;        
            } 
            
         return true;
        
    }
    
    public function ingreso($cantidad){
        
        $esValida = $this->ValidadCantidadIngresada($cantidad);
         
        if($esValida){
            $this->saldo +=$cantidad;
        }           
        
               
                 
    }
    
    public function validarCantidadRetiro($cantidad){
           if(round($cantidad,2)!=$cantidad){               
               return false;
           }
           
           if ($cantidad<0){
               return false;
           }
        
           if ($cantidad>$this->saldo){
               return false;
           }
        
           if ($cantidad>6000){
               return false;
           }
           return true;
        
    }
    
     public function retiro ($cantidad){
            $esValida = $this->validarCantidadRetiro($cantidad);
                    
                  if ($esValida){  
                    $this->saldo-=$cantidad;
                  } 
                  else 
                  {
                      $this->saldo;
                  }
       }
       
       public function validarCantidadParaTransferir($cantidad)
       {
          if($cantidad<0)
          {
              return false;
          }
          
          if($cantidad>3000)
          {
              return false;
          }
          
          if($cantidad>$this->saldo)
          {
              return false;
          }
          
          return true;
           
       }
    
       public function transferencia($cuentaDestino, $cantidad)
       {
           $esValida = $this->validarCantidadParaTransferir($cantidad);
          
           if ($esValida)
           {
                  $this->retiro($cantidad);
                  $cuentaDestino->ingreso($cantidad);
           }
           
       }
       
       
       
       
    
    
    
    
    
    
}
