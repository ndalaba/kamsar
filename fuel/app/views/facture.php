<div class="row" ng-controller="FactureCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li><i class="icon-home"></i> <a href="#">Home</a></li>
            <li class="current"><a href="#" title="Facture">Facture {{voyage.bateau}}</a></li>
        </ul>
        <ul class="crumb-buttons">
            <li class="first"><a title="Ajouter client" ng-click="addPaf();"><i class="icon-user"></i><span>Ajouter PAF</span></a>
            <li><a title="Ajouter service" ng-click="addService();"><i class="icon-windows"></i><span>Ajouter Service</span></a>
            <li><a title="Imprimer" ng-click="printAndSave();"><i class="icon-print"></i><span>Print et Envoyer</span></a></li>
            <li><a title="Enregistrer la facture?" ng-click="saveFacture()"><i class="icon-pencil"></i><span>Enregistrer</span></a></li>
            <li><a title="Liste voyages" href="#/voyages"><i class="icon-list"></i><span>Voyages</span></a></li>
            <li class="range"><a href="#"> <i class="icon-calendar"></i> <span id="heure"></span></a></li>
        </ul>
    </div>
    <div id="main-content">
        <div class="page-header">
            <div class="page-title">
                <!-- <h3>Facture {{voyage.bateau}}</h3>-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="printZone" style="padding-left: 50px">
                <div style="  margin-bottom: 20px; width: 850px;   float: left;font-size: 20px;">
                    <div style="width: 50%;float: left;margin-right: 10px;">
                        <img src="<?php echo Uri::create('assets/img/logo-afrimarine.png') ?>">
                    </div>

                    <div style="width: 45%;float: left;padding: 10px;" >
                        <div style="width: 80%;/* border: 1px solid; */margin: auto;padding: 6px;margin-bottom: 34px;">
                            <p style="text-align: center"> <span style="font-weight: bold;">DATE : </span><?php echo date('d-M-Y') ?></p>
                        </div>
                        <div style="width: 80%;/* border: 1px solid; */margin: auto;padding: 6px; margin-top: 10px;">
                            <p style="text-align: center"> <span style="font-weight: bold;">TO:</span> <input type="button" value="PAF BY" class="btn btn-primary btn-sm" ng-click="addPaf();"/> </p>
                            <p style="text-align: center"> 
                                {{client.nom}} <br/>
                                {{client.adresse}}<br/>                           
                            </p>
                        </div>
                    </div>
                    <div style="float: left; width: 850px;">
                        <p>Dear Sir,</p>
                        <p>Herewith, our invoice in connection with the call of you goog vessel M/V {{voyage.bateau}} with ETA Kamsar</p>
                    </div>
                </div>

                <table style="font-size: 20px;width: 50%;float: left;margin-right: 20px; font-weight: bold" border="1" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="width: 30%">Invoice #</td>
                            <td style="text-align: center;" id="numeroFacture">{{numeroFacture}}/<?php echo date('y'); ?></td>
                        </tr>
                        <tr>
                            <td>Vessel </td>
                            <td style="text-align: center;">{{voyage.bateau}}</td>
                        </tr>
                        <tr>
                            <td>Validity </td>
                            <td style="text-align: center;"><?php echo date('d-M-y', time() + 864000) ?></td>
                        </tr>
                    </tbody>
                </table>

                <table style="font-size: 20px;width: 45%;float: left; font-size: 20px;font-weight: bold;" border="1" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="width: 30%">ETA</td>
                            <td style="text-align: center;"><?php echo date('d-M-Y') ?></td>
                        </tr>
                        <tr>                     
                        <tr>
                            <td>File # </td>
                            <td style="text-align: center;">{{numeroFacture}}/<?php echo date('y'); ?></td>
                        </tr>                  
                    </tbody>
                </table>            
                <table style="font-size: 20px;width: 98%;float: left; margin-top: 50px;" border="1" cellspacing="0">
                    <tbody>
                        <tr>
                            <th style="width: 20%">#</th>
                            <th style="text-align: center" >Description</th>
                            <th style="text-align: center;width: 20%;">Amount (USD)</th>
                        </tr>
                        <tr>                     
                        <tr>
                            <td style="height: 60px">{{numeroFacture}}/<?php echo date('y'); ?> <input type="button" value="add Service" class="btn btn-primary btn-sm" ng-click="addService();"/></td>
                            <td style="text-align: center">
                                <p ng-repeat="service in services" class="p{{service.id}}" onmouseover="$('.a{{service.id}}').show();" onmouseout="$('.a{{service.id}}').hide();"> 
                                    {{service.service}} 
                                    <a ng-click="removeService(service)" style="display: none" class="a{{service.id}}"><i class="icon-remove"></i></a>
                                </p>
                            </td>
                            <td style="text-align: center;">
                                <p ng-repeat="service in services" class="tr{{service.id}} servicemontant">{{service.montant}}</p>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="2">Total</td>
                            <td style="text-align: center;">{{total}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Discount</td>
                            <td style="text-align: center;"><input type="text" ng-model="discount" style="border: none;text-align: center;font-size: 16px!important;" onchange="$(this).attr('value', $(this).val());" value="0"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">GRAND TOTAL</td>
                            <td style="text-align: center;" id="grandTotal">{{total - discount}}</td>
                        </tr>
                    </tbody>
                </table>    
                <div style="width: 71%; float: left;margin-top: 15px;font-size: 20px;font-weight: bold;text-align: right;">
                    Please wire - remit to:
                </div>

                <div style="text-align: center;float: left;padding-right: 160px; margin-top: 50px;font-size: 20px;"> 
                    <p style="font-weight: bold;text-decoration: underline">Crédit Suisse</p>
                    1-3 Passage de la Monaie<br/>
                    CH-1211 Genève 70<br/><br/>
                    Swift: CRESCHZZ12A<br/>
                    <p style="text-decoration: underline">IBAN: CH226 0483 5020 7825 7200 0</p>
                </div>
                <div style="text-align: center;float: right;padding-right: 60px; margin-top: 50px;font-size: 20px"> 
                    <p style="font-weight: bold; text-decoration: underline">Afrimarine s.a</p>
                    ADR Building - 13th Floor <br/>
                    Samuel Lewis Avenue, Obarrio
                    <p style="font-weight: bold; text-decoration: underline">Panama City, Rep of Panama</p>
                    Tel: + 1 718 233 1113 Kamsar <br/>
                    billing@afrimarine.com
                </div>    
            </div>        
        </div>

        <div class="modal fade" id="modalpaf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">PAF</h4>
                    </div>
                    <div class="modal-body">
                        <form onmouseover="initForm();">
                            <div class="form-group">                           
                                <select id="paf_id" name="paf_id" required class="chosen form-control">
                                    <option></option>
                                    <option ng-repeat="client in clients" value="{{client.id}}" >{{client.nom}}</option>
                                </select>
                            </div>                        
                        </form>
                    </div>
                    <div class="modal-footer">                    
                        <button type="submit" class="btn btn-primary" ng-click="getPaf()">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modalservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Services</h4>
                    </div>
                    <div class="modal-body">
                        <form onmouseover="initForm();">
                            <div class="form-group">                           
                                <select id="service_id" name="service_id" required class="chosen form-control">
                                    <option></option>
                                    <option ng-repeat="service in frmservices" value="{{service.id}}" >{{service.service}}</option>
                                </select>
                            </div>                        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" ng-click="getService()">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>                    
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Envoyer facture</h4>
                        <iframe style="display: none;" id="iframe" name="iframe"></iframe>
                        <p class="alert alert-success" style="display: none">
                            Message envoyé avec succès
                        </p>
                        <p class="alert alert-danger" style="display: none">
                            Erreur envoi message
                        </p>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="frmMsg" target="iframe" method="post" enctype="multipart/form-data" action="<?php echo Uri::create('facture/send') ?>">
                            <input type="text" id="facture_id" name="facture_id" ng-model="currentFacture.facture.id" style="display: none"/>
                            <input type="text" id="voyage_id" name="voyage_id" ng-model="voyage.id" style="display: none"/>
                            <input type="text" id="client" name="client" ng-model="client.nom" style="display: none"/>
                            <input type="text" id="numero" name="numero" ng-model="currentFacture.facture.numero" style="display: none"/>
                            <input type="text" id="destination" name="destination" ng-model="client.email" style="display: none"/>
                            <div class="form-group"> 
                                <label class="col-md-4 control-label">Expéditeur:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" required="" value="Afrimarine SA" id="exp" name="exp"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Pour:</label>
                                <div class="col-md-8">
                                    <input type="text" name="pour" class="form-control" required="" ng-model="client.nom"/>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">Sujet:</label>
                                <div class="col-md-8">
                                    <input type="text" name="sujet" class="form-control" required="" id="sujet"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Facture:</label>
                                <div class="col-md-8">
                                    <input type="file" id="fichier" class="form-control" required="" name="fichier"/>
                                </div>
                            </div>
                            <div class="form-group">                           
                                <div class="col-md-12">
                                    <textarea class="form-control" style="height: 200px;" id="message" name="message">
                                Dear Sir,
                                Herewith, our invoice in connection with the call of you goog vessel M/V{{currentFacture.voyage.bateau}} with ETA Kamsar
                                    </textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" ng-click="sendFacture();">Envoyer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>                    
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>