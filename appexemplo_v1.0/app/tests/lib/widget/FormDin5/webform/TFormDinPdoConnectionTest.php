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

$path =  __DIR__.'/../../../../../';
//require_once $path.'tests/initTest.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Warning;

class TFormDinPdoConnectionTest extends TestCase
{

    private $classTest;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void {
        parent::setUp();
        $this->classTest = new TFormDinPdoConnection();
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown(): void {
        $this->classTest = null;
        parent::tearDown();
    }
    

    public function testSetType_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->classTest->setType(null);
    }
    public function testSetType_wrongType()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->classTest->setType('abc');
    }
    public function testSetType_correctType()
    {
        $this->expectNotToPerformAssertions();
        $this->classTest->setType(TFormDinPdoConnection::DBMS_SQLITE);
    }

    //---------------------------------------------
    public function testGetConfigConnect_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->classTest->getConfigConnect();
    }

    public function testGetConfigConnect_SetDatabase()
    {
        $database = 'formdin';
        $this->classTest->setDatabase($database);
        $result = $this->classTest->getConfigConnect();

        $this->assertCount(2, $result);
        $this->assertEquals($database, $result['database']);
        $this->assertEquals(null, $result['db']);
    }

    public function testGetConfigConnect_nullDatabaseSetTypeOnly()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->classTest->setType(TFormDinPdoConnection::DBMS_SQLITE);
        $result = $this->classTest->getConfigConnect();
    }

    public function testGetConfigConnect_nullDatabaseGetDb()
    {   
        $name = 'bdApoio.s3db';
        $this->classTest->setName($name);
        $this->classTest->setType(TFormDinPdoConnection::DBMS_SQLITE);
        $result = $this->classTest->getConfigConnect();

        $this->assertCount(2, $result);
        $this->assertEquals(null, $result['database']);
        $this->assertCount(6, $result['db']);
        $this->assertEquals(TFormDinPdoConnection::DBMS_SQLITE, $result['db']['type']);
        $this->assertEquals($name, $result['db']['name']);
    }

    public function testExecuteSql_sqllite()
    {   
        $path =  __DIR__.'/../../../../../';
        $name = $path.'database/bdApoio.s3db';
        $this->classTest->setName($name);
        $this->classTest->setType(TFormDinPdoConnection::DBMS_SQLITE);
        $sql = 'select * from dado_apoio order by seq_dado_apoio';
        $result = $this->classTest->executeSql($sql);

        $this->assertCount(3, $result);
        $this->assertEquals(1, $result[0]['SEQ_DADO_APOIO']);
        $this->assertEquals('Metro', $result[1]['TIP_DADO_APOIO']);
        $this->assertEquals('KM', $result[2]['SIG_DADO_APOIO']);
    }


}