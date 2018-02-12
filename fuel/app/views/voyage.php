<div class="row" ng-controller="VoyageCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="#">Home</a> </li>
            <li class="current"> <a href="#" title=""></a> </li>
        </ul>
        <ul class="crumb-buttons">
            <!--<li class="first"><a title="Afficher facture" ng-click="showFacture()"><i class="icon-file-text-alt"></i><span>Facture</span></a></li>
            <li><a title="Supprimer les voyages?" ng-click="removeVoyage()"><i class="icon-trash"></i><span>Supprimer</span></a></li> -->
            <li><a title="Nouveau voyage" ng-click="showList = false;"><i class="icon-plus"></i><span>Nouveau</span></a></li>                       
            <li><a title="Liste voyages" href="#/voyages" ng-click="reload()"><i class="icon-list"></i><span>Liste</span></a></li>
            <li><a title="Ajouter client" ng-click="addClient()"><i class="icon-user"></i><span>Ajouter client</span></a></li>
            <li class="range"><a href="#"> <i class="icon-calendar"></i> <span id="heure"></span></a></li>
        </ul>
    </div>
    <div id="main-content">
        <div class="page-header">
            <div class="page-title">
                <h3></h3>
            </div>
        </div>
        <div class="col-md-12" ng-show="showList">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Liste voyages</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <!--<th style="width: 30px!important;"></th>
                                <th style="width: 30px!important;"></th>
                                <th style="width: 70px!important;">Code</th>-->
                                <th>Vessel</th>
                                <th>Date</th>
                                <th>Tonnage</th>
                                <th>Charterer</th>
                                <th>Carriers</th>
                               <!-- <th>PAF By</th>
                                <th>POD</th>
                                <th>Date Facturation</th>
                                <th>N°</th>
                                <th>Montant</th>
                                <th>Date Paie</th>
                                <th>Montant</th>-->
                                <th>Facture</th>
                                <th style="width: 14%">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="voyage in voyages" class="tr{{voyage.voyage.id}}" ngrepeatfinish="">
                                <!--<td><input type="checkbox" value="{{voyage.voyage.id}}"/></td>
                                <td><a ng-click="editVoyage(voyage.voyage,voyage.carriers)"><i class="icon icon-pencil"></i></a></td>
                                <td>{{voyage.voyage.voyage}}</td>-->
                                <td>{{voyage.voyage.bateau}}</td>
                                <td class="dte_arrive">{{voyage.voyage.arrival}}</td>
                                <td>{{voyage.voyage.tonnage}}</td>
                                <td>{{voyage.chtr.nom}}</td>
                                <td>
                                    <p ng-repeat="carrier in voyage.carriers">{{carrier.nom}}</p>
                                </td>
                                <!--<td>{{}}</td>
                                <td>{{voyage.voyage.destination}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>
                                <td>{{}}</td>-->                            
                                <td style="font-weight: bold"> 
                                    <span class="label factureState">{{voyage.voyage.facture}}</span>                                                               
                                </td>
                                <td>
                                    <a href="#/facture/{{voyage.voyage.id}}" class="btn btn-sm" data-toggle="tooltip" data-original-title="Facture voyage"><i class="icon-2x icon-file-text-alt"></i></a> 
                                    <a ng-click="editVoyage(voyage.voyage, voyage.carriers)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Modifier voyage"><i class="icon icon-pencil"></i></a> 
                                    <a  ng-click="removeVoyage(voyage.voyage)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Supprimer voyage"><i class="icon icon-trash"></i></a> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12" ng-show="!showList">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Enregistrer un voyage</h4>
                </div>
                <div class="widget-content">
                    <form class="form-horizontal row-border" id="frmvoyage" ng-submit="saveVoyage()" onmouseover="initForm();">
                        <input type="text" name="id" style="display: none" ng-model="voyage.id" id="id"/>
                        <label class="col-md-11 alert alert-danger" id="form_error" style="margin: 10px 2px 2px 24px; display: none;"></label>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Code <span class="required">*</span></label>
                            <div class="col-md-8"> <input type="text" ng-model="voyage.voyage" id="voyage" name="voyage" class="form-control" required autocomplete="off" autofocus=""/></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Bateau <span class="required">*</span></label>
                            <div class="col-md-8"> <input type="text" ng-model="voyage.bateau" id="bateau" name="bateau" class="form-control" required autocomplete="off"/></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Charterers <span class="required">*</span></label>
                            <div class="col-md-8">
                                <select id="chtr_id" name="chtr_id"  required class="chosen">
                                    <option></option>
                                    <option ng-repeat="client in clients" value="{{client.id}}" >{{client.nom}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Carriers <span class="required">*</span></label>
                            <div class="col-md-8">
                                <select id="carrier_id" name="carrier_id" required class="chosen" multiple>
                                    <option></option>
                                    <option ng-repeat="client in clients" value="{{client.id}}" >{{client.nom}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Destination <span class="required">*</span></label>
                            <div class="col-md-8"><input type="text" ng-model="voyage.destination" id="destination" name="destination" class="form-control" required autocomplete="off"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Tonnage <span class="required">*</span></label>
                            <div class="col-md-8"><input type="number" ng-model="voyage.tonnage" id="tonnage" name="tonnage" class="form-control" required autocomplete="off"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">VLD </label>
                            <div class="col-md-8"><input type="date" ng-model="voyage.vld" id="vld" name="vld" class="form-control" /> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Laycan </label>
                            <div class="col-md-8"><input type="text" ng-model="voyage.laycan" id="laycan" name="laycan" class="form-control"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Arrival </label>
                            <div class="col-md-8"><input type="datetime" ng-model="voyage.arrival" id="arrival" name="arrival" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Departure </label>
                            <div class="col-md-8"><input type="datetime" ng-model="voyage.departure" id="departure" name="departure" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">NOR </label>
                            <div class="col-md-8"><input type="datetime" ng-model="voyage.nor" id="nor" name="nor" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sail time </label>
                            <div class="col-md-8"><input type="datetime" ng-model="voyage.sail_time" id="sail_time" name="sail_time" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Fixed </label>
                            <div class="col-md-8"><input type="datetime" ng-model="voyage.fixed" id="fixed" name="fixed" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Rate </label>
                            <div class="col-md-8"><input type="text" ng-model="voyage.rate" id="rate" name="rate" class="form-control"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-8"><textarea ng-model="voyage.description" id="description" name="description" class="form-control"></textarea> </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Enregistrer"  class="btn btn-primary pull-left">
                            <input type="reset" value="Annuller" class="btn btn-danger pull-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Clients</h4>
                    </div>
                    <form class="form-horizontal row-border" id="frmclient" ng:submit="saveClient()">    
                        <div class="modal-body">
                            <input type="text" name="id" style="display: none" ng-model="client.id" id="id"/>
                            <label class="col-md-11 alert alert-danger" id="form_error" style="margin: 10px 2px 2px 24px; display: none;"></label>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <select id="type" name="type" class="chosen form-control" required="">
                                        <option></option>
                                        <option ng-repeat="type in types" value="{{type.type}}" >{{type.type}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nom <span class="required">*</span></label> 
                                <div class="col-md-8"><input type="text" ng-model="client.nom" id="nom" name="nom" class="form-control" required autocomplete="off"/> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email </label>
                                <div class="col-md-8"><input type="email" ng-model="client.email" id="email" name="email" class="form-control" autocomplete="off"/> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Adresse</label> 
                                <div class="col-md-8"><textarea ng-model="client.adresse" id="adresse" name="adresse" class="form-control"></textarea> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Note</label>
                                <div class="col-md-8"><textarea ng-model="client.note" id="note" name="note" class="form-control"></textarea> </div>
                            </div>                                         
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Enregistrer"  class="btn btn-primary pull-left"> 
                            <input type="reset" value="Annuller" class="btn btn-danger pull-right" data-dismiss="modal">                     
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div> 
    </div>
</div>