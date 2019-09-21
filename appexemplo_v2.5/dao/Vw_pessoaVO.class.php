<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5
 * 
 * System appev2 created in: 2019-09-10 09:04:47
 */
class Vw_pessoaVO
{
    private $idpessoa = null;
    private $nome = null;
    private $tipo = null;
    private $cpfcnpj = null;
    private $dat_nascimento = null;
    private $cod_municipio_nascimento = null;
    private $cnae = null;
    private $idnatureza_juridica = null;
    private $dat_inclusao = null;
    private $sit_ativo = null;
    public function __construct( $idpessoa=null, $nome=null, $tipo=null, $cpfcnpj=null, $dat_nascimento=null, $cod_municipio_nascimento=null, $cnae=null, $idnatureza_juridica=null, $dat_inclusao=null, $sit_ativo=null ) {
        $this->setIdpessoa( $idpessoa );
        $this->setNome( $nome );
        $this->setTipo( $tipo );
        $this->setCpfcnpj( $cpfcnpj );
        $this->setDat_nascimento( $dat_nascimento );
        $this->setCod_municipio_nascimento( $cod_municipio_nascimento );
        $this->setCnae( $cnae );
        $this->setIdnatureza_juridica( $idnatureza_juridica );
        $this->setDat_inclusao( $dat_inclusao );
        $this->setSit_ativo( $sit_ativo );
    }
    //--------------------------------------------------------------------------------
    public function setIdpessoa( $strNewValue = null )
    {
        $this->idpessoa = $strNewValue;
    }
    public function getIdpessoa()
    {
        return $this->idpessoa;
    }
    //--------------------------------------------------------------------------------
    public function setNome( $strNewValue = null )
    {
        $this->nome = $strNewValue;
    }
    public function getNome()
    {
        return $this->nome;
    }
    //--------------------------------------------------------------------------------
    public function setTipo( $strNewValue = null )
    {
        $this->tipo = $strNewValue;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    //--------------------------------------------------------------------------------
    public function setCpfcnpj( $strNewValue = null )
    {
        $this->cpfcnpj = preg_replace('/[^0-9]/','',$strNewValue);
    }
    public function getCpfcnpj()
    {
        return $this->cpfcnpj;
    }
    //--------------------------------------------------------------------------------
    public function setDat_nascimento( $strNewValue = null )
    {
        $this->dat_nascimento = $strNewValue;
    }
    public function getDat_nascimento()
    {
        return is_null( $this->dat_nascimento ) ? date( 'Y-m-d h:i:s' ) : $this->dat_nascimento;
    }
    //--------------------------------------------------------------------------------
    public function setCod_municipio_nascimento( $strNewValue = null )
    {
        $this->cod_municipio_nascimento = $strNewValue;
    }
    public function getCod_municipio_nascimento()
    {
        return $this->cod_municipio_nascimento;
    }
    //--------------------------------------------------------------------------------
    public function setCnae( $strNewValue = null )
    {
        $this->cnae = $strNewValue;
    }
    public function getCnae()
    {
        return $this->cnae;
    }
    //--------------------------------------------------------------------------------
    public function setIdnatureza_juridica( $strNewValue = null )
    {
        $this->idnatureza_juridica = $strNewValue;
    }
    public function getIdnatureza_juridica()
    {
        return $this->idnatureza_juridica;
    }
    //--------------------------------------------------------------------------------
    public function setDat_inclusao( $strNewValue = null )
    {
        $this->dat_inclusao = $strNewValue;
    }
    public function getDat_inclusao()
    {
        return is_null( $this->dat_inclusao ) ? date( 'Y-m-d h:i:s' ) : $this->dat_inclusao;
    }
    //--------------------------------------------------------------------------------
    public function setSit_ativo( $strNewValue = null )
    {
        $this->sit_ativo = $strNewValue;
    }
    public function getSit_ativo()
    {
        return $this->sit_ativo;
    }
    //--------------------------------------------------------------------------------
}
?>