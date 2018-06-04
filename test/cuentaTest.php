<?php
 use PHPUnit\Framework\TestCase;
/*require(dirname(__FILE__) . '/src/Cuenta.php'); */
  require_once '/home/ana/NetBeansProjects/PhpProject1/src/Cuenta.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EjemploTDD
 *
 * @author ana
 */
class cuentaTest extends TestCase{
    
    //INGRESO
    public function testAlCrearCuentaElSaldoEsCero()
    {
        
        $c = new Cuenta();
        $this->assertSame(0,$c-> getSaldo());
        
    }
    
    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertEquals(100, $c->getSaldo());
    }
    
    public function testAlIngresar3000EnCuentaVaciaElSaldoEs3000()
    {
        
        $c = new Cuenta();
        $c->ingreso(3000);
        $this->assertEquals(3000, $c->getSaldo());
        
    }
    
    public function testAlIngresar3000EnCuentaCon100ElSaldoes3100()
    {
         $c = new Cuenta();
         $c->ingreso(100);
        $c->ingreso(3000);
        $this->assertSame(3100, $c->getSaldo());
    }
    
    public function testNoSePuedeIngresarCantidadNegativa()
    {
        $c = new Cuenta();
        $c->ingreso(-100);
        $this->assertEquals(0, $c->getSaldo());
    }
    
    public function testSiIngresoCantidadMasDe2DecimalesNoEsValido()
    {
        $c = new Cuenta();
        $c->ingreso(100.457);
        $this->assertEquals(0, $c->getSaldo());
        
    }
    
    public function testIngresoMaximoEsDe6000()
    {
        $c = new Cuenta();
        $c->ingreso(6000);
        $this->assertEquals(6000, $c->getSaldo());
        
    }
    
     public function testIngresoMasDe6000NoEsValido()
    {
        $c = new Cuenta();
        $c->ingreso(6000.01);
        $this->assertEquals(0, $c->getSaldo());
        
    }
    
    public function testAlIngresar7000EnCuentaCOn2350ElSaldoSeQuedaEn2350()
    {
        $c = new Cuenta();
        $c->ingreso(2350);
        
        $c->ingreso(7000);
        $this->assertEquals(2350, $c->getSaldo());
        
    }
    
    //RETIRADAS
    public function testSeRestaLaCantidadRetiradaAlSaldo()
    {
        $c = new Cuenta();
        $c->ingreso(3000);
        $c->retiro(100);
        $this->assertEquals(2900, $c->getSaldo());
        
    }
    
    //Robustez
    public function testAlRetirar200EnCuentaCon1200ElSaldoEs1000YAlRetirarOtros150ElSaldoEs850()
    {
        $c = new Cuenta();
        $c->ingreso(1200);
        $c->retiro(200);
        $this->assertEquals(1000, $c->getSaldo());
        $c->retiro(150);
        $this->assertEquals(850, $c->getSaldo());
              
         
    }
    
    public function testAlRetirar100EnCuentaCon500ElSaldoEs400()
    {
        $c = new Cuenta();
        $c->ingreso(500);
        $c->retiro(100);
        $this->assertEquals(400, $c->getSaldo());
    }
    
    public function testAlRetirar500EnCuentaCon200NoOcurreNada()
    {
        $c = new Cuenta();
        $c->ingreso(200);
        $c->retiro(500);
        $this->assertEquals(200, $c->getSaldo());
        
    }
    
    public function testAlRetirarMenos100EnCuentaCon500NoOcurreNada()
    {
        $c = new Cuenta();
        $c->ingreso(500);
        $c->retiro(-100);
        $this->assertEquals(500, $c->getSaldo());
        
    }
    
    public function testAlRetirarCon2Decimales()
    {
        $c = new Cuenta();
        $c->ingreso(500);
        $c->retiro(100.45);
        $this->assertEquals(399.55, $c->getSaldo());
    }
    
     public function testAlRetirarConMasDe2Decimales()
    {
        $c = new Cuenta();
        $c->ingreso(500);
        $c->retiro(100.457);
        $this->assertEquals(500, $c->getSaldo());
    }
    
    public function testAlRetirarMaximo6000EnCuentaCon7000()
    {
        $c = new Cuenta();
        $c->ingreso(3000);
        $c->ingreso(4000);
        $c->retiro(6000.00);
        $this->assertEquals(1000, $c->getSaldo());
    }
    
    public function testAlRetirarMasDe6000EnCuentaCon7000NoOcurreNada()
    {
        $c = new Cuenta();
        $c->ingreso(3000);
        $c->ingreso(4000);
        $c->retiro(6000.01);
        $this->assertEquals(7000, $c->getSaldo());
        
    }
    
    //TRANSFERENCIAS
    
    public function testTransferencia(){
        
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        $cuenta1->transferencia($cuenta2,100);
        
        $this->assertEquals(400, $cuenta1->getSaldo());
        $this->assertEquals(150, $cuenta2->getSaldo());
        
    }
    
    public function testTransferenciaNegativaNoPasaNada()
    {
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        $cuenta1->transferencia($cuenta2,-100);
        
        $this->assertEquals(500, $cuenta1->getSaldo());
        $this->assertEquals(50, $cuenta2->getSaldo());
        
    }
    
    public function testTransferirLimiteCantidad3000()
    {
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(3500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        $cuenta3 = new Cuenta();
        $cuenta3->ingreso(3500);
        
        $cuenta4 = new Cuenta();
        $cuenta4->ingreso(50);
        
        $cuenta1->transferencia($cuenta2,3000);
        //transferencia no valida
         $cuenta3->transferencia($cuenta4,3000.01);
        
        $this->assertEquals(500, $cuenta1->getSaldo());
        $this->assertEquals(3050, $cuenta2->getSaldo());
        
        $this->assertEquals(3500, $cuenta3->getSaldo());
        $this->assertEquals(50, $cuenta4->getSaldo());
        
    }
    
    public function testTransferirMasDeLoQueHayEnLaCuenta()
    {
         $cuenta1 = new Cuenta();
        $cuenta1->ingreso(3500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
         $cuenta1->transferencia($cuenta2,4000);
         
        $this->assertEquals(3500, $cuenta1->getSaldo());
        $this->assertEquals(50, $cuenta2->getSaldo());
    }
}




