<?php

use Adianti\Registry\TSession;

class exe_TButton extends TPage
{
    protected $form; // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    // trait com onReload, onSearch, onDelete...
    use Adianti\Base\AdiantiStandardListTrait;

    public function __construct()
    {
        parent::__construct();

        $frm = new TFormDin($this,'Exemplo Mensagem apenas PHP');
        //$frm->setAction('Nome Botão','onSave',$this);
        $frm->setAction(_t('Save'), 'onSave', false,'far:check-circle green');
        $frm->setAction(_t('Clear'), 'clear', false,'fa:eraser red');
        $frm->setAction('YYYY','onSave',true,null,'green');
        
        
        $frm->addTextField('entry2','TEntry', 10);
        $frm->addButton('Success1',null,'onSave3',null,null,false,false);

        $frm->addTextField('txt','Text1', 10);
        $frm->addButton('Nova linha',null,'onSave1',null,null,true,false,'far:check-circle green');
        $frm->addButton('mesma linha',null,'onSave2',null,null,false,false);


        //$frm->addButton($this,'Limpar', null, 'Limpar', null, null, false, false);
        //$frm->addButton($this,'Exemplo 09 - img', null, 'act09', null, null, true, false,'joia.gif');
        //$frm->addButton($this,'Exemplo 09 - img desabilitado', null, 'act09d', null, null, true, false,'joia.gif','joia_desabilitado.gif');
        //$frm->addButton($this,'Exemplo 10 - img', null, 'act10', null, null, true, false,'favicon-32x32.png');
        //$frm->addButton($this,'Exemplo 11 - hint', null, 'act11', null, null, true, false,null,null,'text hint');
        //$frm->addButton($this,'Exemplo 12', null, 'act12', null, null, true, false,null,null,null,null,true,'xxx','center');
        //$frm->addButton($this,'Exemplo 13', null, 'act13', null, null, true, false,null,null,null,null,true,'xxx','left');
        //$frm->addButton($this,'Exemplo 14', null, 'act14', null, null, true, false,null,null,null,null,null,null,'left');
        $frm->addTextField('xxx','xxx',30);
        $this->form = $frm->show();


        $label = new TLabel('Text Exemplo');
        $entry = new TEntry('entry');
        $action = new TAction(array($this, 'onSave'));
        $bt3c = new TButton('bt3c');
        $bt3c->setAction($action,'Btn Exemplo');
        $this->form->addFields( [$label], [$entry], [$bt3c]);
       

        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        // creates the page structure using a table
        $formDinBreadCrumb = new TFormDinBreadCrumb(__CLASS__);
        $vbox = $formDinBreadCrumb->getAdiantiObj();
        $vbox->add($this->form);
        
        // add the table inside the page
        parent::add($vbox);
    }

    /**
     * Clear filters
     */
    public function clear()
    {
        $this->clearFilters();
        $this->onReload();
    }

    public function onSave($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);

        //Função do FormDin para Debug
        FormDinHelper::d($param,'$param');
        FormDinHelper::debug($data,'$data');
        FormDinHelper::debug($_REQUEST,'$_REQUEST');
    }

    public function onSave1($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);

        //Função do FormDin para Debug
        FormDinHelper::d($param,'$param');
        FormDinHelper::debug($data,'$data');
        FormDinHelper::debug($_REQUEST,'$_REQUEST');
    }

    public function onSave2($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);

        //Função do FormDin para Debug
        FormDinHelper::d($param,'$param');
        FormDinHelper::debug($data,'$data');
        FormDinHelper::debug($_REQUEST,'$_REQUEST');
    }

    public function onSave3($param)
    {
        $data = $this->form->getData();
        $this->form->setData($data);

        //Função do FormDin para Debug
        FormDinHelper::d($param,'$param');
        FormDinHelper::debug($data,'$data');
        FormDinHelper::debug($_REQUEST,'$_REQUEST');
    }    

}