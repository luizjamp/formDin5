<?php
/*
 * ----------------------------------------------------------------------------
 * Formdin 5 Framework
 * SourceCode https://github.com/bjverde/formDin5
 * @author Reinaldo A. Barrêto Junior
 * 
 * É uma reconstrução do FormDin 4 Sobre o Adianti 7.X
 * ----------------------------------------------------------------------------
 * This file is part of Formdin Framework.
 *
 * Formdin Framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License version 3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License version 3
 * along with this program; if not,  see <http://www.gnu.org/licenses/>
 * or write to the Free Software Foundation, Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA  02110-1301, USA.
 * ----------------------------------------------------------------------------
 * Este arquivo é parte do Framework Formdin.
 *
 * O Framework Formdin é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da GNU LGPL versão 3 como publicada pela Fundação
 * do Software Livre (FSF).
 *
 * Este programa é distribuí1do na esperança que possa ser útil, mas SEM NENHUMA
 * GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a Licen?a Pública Geral GNU/LGPL em portugu?s
 * para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da GNU LGPL versão 3, sob o título
 * "LICENCA.txt", junto com esse programa. Se não, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Fundação do Software Livre (FSF) Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02111-1301, USA.
 */

$path =  __DIR__.'/../../../../../../';
//require_once $path.'init.php';
//require_once $path.'tests/initTest.php';

require_once  __DIR__.'/../../mockMunicipioVO.class.php';

use PHPUnit\Framework\TestCase;

class FormDinHelperTest extends TestCase
{
    
    public function testVersion() {
        $expected = '5.0.0-alpha4';
        $result =  FormDinHelper::version();
        $this->assertEquals( $expected , $result);
    }
    public function testVersionMinimum_false() {
        $expected = false;
        $result = FormDinHelper::versionMinimum('99.99.99');
        $this->assertEquals( $expected , $result);
    }
    public function testVersionMinimum_true() {
        $expected = true;
        $result = FormDinHelper::versionMinimum('1.0.0');
        $this->assertEquals( $expected , $result);
    }
    public function testVersionMinimum_equal() {
        $expected = true;
        $result = FormDinHelper::versionMinimum('5.0.0');
        $this->assertEquals( $expected , $result);
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public function testSetPropertyVo_noSet(){
        $bodyRequest = array();
        $bodyRequest['IDPESSOA'] = 10;
        $bodyRequest['NMPESSOA'] = 'Paulo Deleo';
        
        $vo = new mockMunicipioVO();
        
        $vo =  FormDinHelper::setPropertyVo($bodyRequest,$vo);
        $expected = null;
        $this->assertEquals( $expected , $vo->getCod_municipio());
        $this->assertEquals( $expected , $vo->getCod_uf());
        $this->assertEquals( $expected , $vo->getNom_municipio());
        $this->assertEquals( $expected , $vo->getSit_ativo());
    }
    
    public function testSetPropertyVo_setOnlyCodMunicipio_lowerCase(){
        $bodyRequest = array();
        $bodyRequest['cod_municipio'] = 10;
        $bodyRequest['NMPESSOA'] = 'Paulo Deleo';
        
        $vo = new mockMunicipioVO();
        
        $vo =  FormDinHelper::setPropertyVo($bodyRequest,$vo);
        $expected = 10;
        $this->assertEquals( $expected , $vo->getCod_municipio());
        $expected = null;
        $this->assertEquals( $expected , $vo->getCod_uf());
        $this->assertEquals( $expected , $vo->getNom_municipio());
        $this->assertEquals( $expected , $vo->getSit_ativo());
    }
    
    /*
     public function testSetPropertyVo_setOnlyCodMunicipio_UpperCase(){
     $bodyRequest = array();
     $bodyRequest['COD_MUNICIPIO'] = 10;
     $bodyRequest['NMPESSOA'] = 'Paulo Deleo';
     
     $vo = new mockMunicipioVO();
     
     $vo =  FormDinHelper::setPropertyVo($bodyRequest,$vo);
     $expected = 10;
     $this->assertEquals( $expected , $vo->getCod_municipio());
     $expected = null;
     $this->assertEquals( $expected , $vo->getCod_uf());
     $this->assertEquals( $expected , $vo->getNom_municipio());
     $this->assertEquals( $expected , $vo->getSit_ativo());
     }
     */
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    /**
     * @expectedException InvalidArgumentException
     */
    public function testConvertVo2ArrayFormDin_failNull(){
        FormDinHelper::convertVo2ArrayFormDin(null);
        //$this->expectException(InvalidArgumentException::class);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testConvertVo2ArrayFormDin_failString(){
        FormDinHelper::convertVo2ArrayFormDin('xx');
        //$this->expectException(InvalidArgumentException::class);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testConvertVo2ArrayFormDin_failInt(){
        FormDinHelper::convertVo2ArrayFormDin(120);
    }
    
    public function testConvertVo2ArrayFormDin_OK(){
        $vo = new mockMunicipioVO();
        $vo->setCod_municipio(1);
        $vo->setCod_uf(2);
        $vo->setNom_municipio('Brasília');
        $vo->setSit_ativo('S');
        
        $arrayFormDin =  FormDinHelper::convertVo2ArrayFormDin($vo);
        $this->assertEquals( 1 , $arrayFormDin['COD_MUNICIPIO'][0]);
        $this->assertEquals( 'Brasília' , $arrayFormDin['NOM_MUNICIPIO'][0]);
        $this->assertEquals( 2 , $arrayFormDin['COD_UF'][0]);
        $this->assertEquals( 'S' , $arrayFormDin['SIT_ATIVO'][0]);
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    /**
     * @expectedException InvalidArgumentException
     */
    public function testValidateIdIsNumeric_FailNull(){
        FormDinHelper::validateIdIsNumeric(null,__METHOD__,__LINE__);
    }
    public function testValidateIdIsNumeric_OkInteger(){
        $this->assertNull( FormDinHelper::validateIdIsNumeric(10,__METHOD__,__LINE__) );
    }
    public function testValidateIdIsNumeric_OkString(){
        $this->assertNull( FormDinHelper::validateIdIsNumeric('10',__METHOD__,__LINE__) );
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public function testIssetOrNotZero_arrayNull() {
        $expected = false;
        $variable = array();
        $result = FormDinHelper::issetOrNotZero($variable);
        $this->assertEquals( $expected , $result);
    }
    
    public function testIssetOrNotZero_arrayNotNull() {
        $expected = true;
        $variable = array(0,1);
        $result = FormDinHelper::issetOrNotZero($variable);
        $this->assertEquals( $expected , $result);
    }
    
    public function testIssetOrNotZero_stringBlank() {
        $expected = false;
        $variable = '';
        $result = FormDinHelper::issetOrNotZero($variable);
        $this->assertEquals( $expected , $result);
    }
    
    public function testIssetOrNotZero_stringNull() {
        $expected = false;
        $variable = null;
        $result = FormDinHelper::issetOrNotZero($variable);
        $this->assertEquals( $expected , $result);
    }
    
    public function testIssetOrNotZero_stringZero() {
        $expected = false;
        $variable = '0';
        $result = FormDinHelper::issetOrNotZero($variable);
        $this->assertEquals( $expected , $result);
    }
    
    public function testIssetOrNotZero_stringZeroNoTest() {
        $expected = true;
        $variable = '0';
        $result = FormDinHelper::issetOrNotZero($variable,false);
        $this->assertEquals( $expected , $result);
    }
    
}