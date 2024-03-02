<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Dados da conta
|--------------------------------------------------------------------------
|
| Configurações que identificam sua loja junto ao pagseguro e e-mails para envio de log
| 
|
*/

$config['email']     =   'feliper.nogueira@yahoo.com.br';
$config['token']     =   'B085FDBEAA9C40DFBFFE08F3AFB9558C';
$config['suporte']   =   'suporte@b10web.com.br';
$config['currency']  =   'BRL';

/*
|--------------------------------------------------------------------------
| URLs do Pagseguro
|--------------------------------------------------------------------------
|
| Aqui serão configuradas as URLs do Pagseguro:
| 
|
*/

$config['pagseguro_pagamento'] =   'https://ws.pagseguro.uol.com.br/v2/checkout';
$config['pagseguro_notificacao'] =   'https://ws.pagseguro.uol.com.br/v2/transactions/notifications';


/*
|--------------------------------------------------------------------------
| Redirecionamentos no site
|--------------------------------------------------------------------------
|
| Paginas para onde o cliente deve ser redirecionado em caso de algum problema
| 
|
*/

$config['payment']     =   'http://b10web.com.br/umadpg/'; //Retorna após efetuar o pagamento
$config['payment_messange'] =   'Sua compra foi registrada com sucesso! Você será notificado quando houver a confirmação do pagamento.'; //Mensagem que ficará registrada em flashdata('mensagem')

$config['unauthorized']          =   'http://b10web.com.br/umadpg/'; //Caso não seja possível logar a loja na API do pagseguro (e-mail/senha incorretos)
$config['unauthorized_messange'] =   'Não foi possível finalizar sua inscrição. Motivo: Falha na comunicação com o PagSeguro'; //Mensagem que ficará registrada em flashdata('mensagem')

$config['error']          =   'http://b10web.com.br/umadpg/'; //Caso ocorre algum erro no item a ser comprado
$config['error_messange'] =   'Não foi possível finalizar sua inscrição. Motivo: Erro de configuração do produto'; //Mensagem que ficará registrada em flashdata('mensagem')

