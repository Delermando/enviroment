<?php
$app['card.route'] = $app->share(function() use ($app) {
    return new Cartao\services\routesController\CardRoutesController($app['request']);
});


$app->get('/', 'card.route:home');
/**
 *@SWG\Resource(basePath="http://enviroment-deler.rhcloud.com", resourcePath="home")
 *@SWG\Api(
 *  path="/", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="GET", 
 *          nickname="home",
 *      )
 *  )
 *)
 */

$app->get('/{name}','card.route:helloName');

$app->get('/v1/cards/list', 'card.route:cardList');
/**
 * @SWG\Resource(basePath="http://enviroment-deler.rhcloud.com", resourcePath="/v1/cards")
 * @SWG\Api(
 *  path="/v1/cards/list", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="GET", 
 *          nickname="listAllCards",
 *          summary = "Retorna todos os cartoes cadastrados",
 *          type = "ResponseList",
 *          @SWG\ResponseMessage(code=00, message="no error"),
 *          @SWG\ResponseMessage(code=01, message="noRegisters"),
 *      )
 *  )
 *)
 * @SWG\Model(id="ResponseList"),
 * @SWG\Property(name="response", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="data",type="array", @SWG\Items("DataList"))
 * @SWG\Model(id="DataList"),
 * @SWG\Property(name="IDScheduleSend", type="integer")
 * @SWG\Property(name="IDFromEmail", type="integer")
 * @SWG\Property(name="IDToEmail", type="integer")
 * @SWG\Property(name="IDMessage", type="integer")
 * @SWG\Property(name="emailFromEmail", type="string")
 * @SWG\Property(name="nameFromEmail", type="string")
 * @SWG\Property(name="emailToEmail", type="string")
 * @SWG\Property(name="nameToEmail", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="createDate", type="string")
 * @SWG\Property(name="dateToSend", type="string")
 */


$app->get('/v1/cards/list/{idCard}', 'card.route:getUnicCard');
/**
 * @SWG\Api(
 *  path="/v1/cards/list/{idCard}", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="GET", 
 *          nickname="searchUnicCard",
 *          summary = "Busca um cartao pelo seu ID",
 *          type = "ResponseUnicCard",
 *          @SWG\Parameter(
 *              name="idCard",
 *              description="Object com o ID do card a ser pesquisado",
 *              paramType="path",
 *              required=true,
 *              allowMultiple=false,
 *              type="integer",
 *              defaultValue=329
 *          ),
 *          @SWG\ResponseMessage(code=00, message="no error"),
 *          @SWG\ResponseMessage(code=01, message="noRegisters"),
 *      )
 *  )
 *)
 * @SWG\Model(id="ResponseUnicCard"),
 * @SWG\Property(name="response", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="data",type="array", @SWG\Items("DataUnicCard"))
 * @SWG\Model(id="DataUnicCard"),
 * @SWG\Property(name="IDScheduleSend", type="integer")
 * @SWG\Property(name="IDFromEmail", type="integer")
 * @SWG\Property(name="IDToEmail", type="integer")
 * @SWG\Property(name="IDMessage", type="integer")
 * @SWG\Property(name="emailFromEmail", type="string")
 * @SWG\Property(name="nameFromEmail", type="string")
 * @SWG\Property(name="emailToEmail", type="string")
 * @SWG\Property(name="nameToEmail", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="createDate", type="string")
 * @SWG\Property(name="dateToSend", type="string")
 */


$app->post('/v1/cards/delete', 'card.route:cardDelete');
/**
 * @SWG\Api(
 *  path="/v1/cards/delete", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="POST", 
 *          nickname="deleteCard",
 *          summary = "Deleta os cartoes por um array de IDs",
 *          type = "ResponseDelete",
 *          @SWG\Parameter(
 *              name="jsonDelete",
 *              description="Object/array com os IDs dos cartoes a serem deletados",
 *              paramType="body",
 *              required=true,
 *              allowMultiple=true,
 *              type="objectToDelete"
 *          ),
 *          @SWG\ResponseMessage(code=00, message="no error"),
 *          @SWG\ResponseMessage(code=01, message="noRegisters"),
 *      ),
 *  ),
 *)
 * @SWG\Model(id="objectToDelete",required="true")
 * @SWG\Property(name="idCard",type="array",@SWG\Items(0))
 * 
 * @SWG\Model(id="ResponseDelete"),
 * @SWG\Property(name="response", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="data",type="array", @SWG\Items("DataDelete"))
 * @SWG\Model(id="DataDelete"),
 * @SWG\Property(name="numbOfDeletedItems", type="integer")
 */

$app->post('/v1/cards/save', 'card.route:cardSave');

/**
 * @SWG\Api(
 *  path="/v1/cards/save", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="POST", 
 *          nickname="saveCard",
 *          summary = "Cadastrar cartoes",
 *          type="ResponseSave",
 *          @SWG\Parameter(
 *              name="jsonSave",
 *              description="Objeto/Array com os dados a serem gravados!",
 *              paramType="body",
 *              required=true,
 *              allowMultiple=true,
 *              type="objectToSave"
 *          ),
 *          @SWG\ResponseMessage(code=00, message="no error"),
 *          @SWG\ResponseMessage(code=01, message="wrongParamName"),
 *          @SWG\ResponseMessage(code=02, message="wrongNumbOfParams"),
 *          @SWG\ResponseMessage(code=03, message="paramNotSet"),
 *          @SWG\ResponseMessage(code=04, message="wrongEmailFormat"),
 *          @SWG\ResponseMessage(code=05, message="wrongDateFormat"),
 *      ),
 *  ),
 *)
 * @SWG\Model(id="objectToSave",required="true")
 * @SWG\Property(name="fromEmail",type="string",description="E-mail do remetente"))
 * @SWG\Property(name="toEmail",type="string",description="E-mail do destinatario")
 * @SWG\Property(name="fromName",type="string",description="Nome do remetente")
 * @SWG\Property(name="toName",type="string",description="Nome do destinatario")
 * @SWG\Property(name="message",type="string",description="Mensagem para o destinatario")
 * @SWG\Property(name="date",type="string",description="Data para o envio do cartao")
 * 
 * @SWG\Model(id="ResponseSave"),
 * @SWG\Property(name="response", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="data",type="array", @SWG\Items("DataSave"))
 * @SWG\Model(id="DataSave"),
 * @SWG\Property(name="lastIdInserted", type="integer")
 */

$app->post('/v1/cards/update', 'card.route:cardUpdate');

/**
 * @SWG\Api(
 *  path="/v1/cards/update", 
 *  @SWG\Operations(
 *      @SWG\Operation(
 *          method="POST", 
 *          nickname="updateCard",
 *          summary = "Atualizar cartoes",
 *          type="ResponseUpdate",
 *          @SWG\Parameter(
 *              name="jsonUpdate",
 *              description="Object/List com os dados as serem atualizados",
 *              paramType="body",
 *              required=true,
 *              allowMultiple=true,
 *              type="objectToUpdate"
 *          ),
 *          @SWG\ResponseMessage(code=00, message="no error"),
 *          @SWG\ResponseMessage(code=01, message="wrongParamName"),
 *          @SWG\ResponseMessage(code=02, message="wrongNumbOfParams"),
 *          @SWG\ResponseMessage(code=03, message="paramNotSet"),
 *          @SWG\ResponseMessage(code=04, message="wrongEmailFormat"),
 *          @SWG\ResponseMessage(code=05, message="wrongDateFormat"),
 *          @SWG\ResponseMessage(code=06, message="noRegisters"),
 *      ),
 *  ),
 *)
 * @SWG\Model(id="objectToUpdate",required="true")
 * @SWG\Property(name="idCard",type="integer",description="ID do card a ser atualizado"))
 * @SWG\Property(name="fromEmail",type="string",description="E-mail do remetente"))
 * @SWG\Property(name="toEmail",type="string",description="E-mail do destinatario")
 * @SWG\Property(name="fromName",type="string",description="Nome do remetente")
 * @SWG\Property(name="toName",type="string",description="Nome do destinatario")
 * @SWG\Property(name="message",type="string",description="Mensagem para o destinatario")
 * @SWG\Property(name="date",type="string",description="Data para o envio do cartao")
 * 
 * @SWG\Model(id="ResponseUpdate"),
 * @SWG\Property(name="response", type="string")
 * @SWG\Property(name="message", type="string")
 * @SWG\Property(name="data",type="array", @SWG\Items("DataUpdate"))
 * @SWG\Model(id="DataUpdate"),
 * @SWG\Property(name="tableModifiedName", type="integer")
 */
