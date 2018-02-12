<div class="row" ng-controller="FactureCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="#">Home</a> </li>
            <li class="current"> <a href="#" title=""></a> </li>
        </ul>
        <ul class="crumb-buttons">
            <li><a title="Nouveau facture"href="#/voyages"><i class="icon-plus"></i><span>Nouvelle facture</span></a></li>                       
            <li><a title="Liste factures" href="#/factures" id="refresh" ng-click="reload()"><i class="icon-refresh"></i><e>Refresh</e></a></li>           
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
                <h4><i class="icon-reorder"></i> Liste factures</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <tr>                            
                            <th>Numero</th>
                            <th>Date</th>
                            <th>Validité</th>
                            <th>Vessel</th>
                            <th>Client</th>
                            <th>Etat</th>                          
                            <th>Montant</th>
                            <th>Montant Recu</th>
                            <th>Date</th>
                            <th style="width: 14%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="facture in factures" class="tr{{facture.facture.id}}" ngrepeatfinish="">                            
                            <td>{{facture.facture.numero}}</td>
                            <td class="dte_arrive">{{facture.facture.ajout}}</td>
                            <td>{{facture.facture.validite}}</td>
                            <td>{{facture.voyage.bateau}}</td>
                            <td>{{facture.client.nom}}</td>
                            <td style="font-weight: bold"> 
                                <span class="label factureState" id="facture{{facture.voyage.id}}">{{facture.voyage.facture}}</span>                                                               
                            </td>
                            <td>{{facture.facture.montant}}</td>
                            <td id="recu{{facture.voyage.id}}">{{facture.facture.recu}}</td>
                            <td id="reception{{facture.voyage.id}}">{{facture.facture.reception}}</td>                                                                                                        
                            <td>
                                <a href="#/facture/detail/{{facture.facture.id}}" class="btn btn-sm" data-toggle="tooltip" data-original-title="details facture"><i class="icon-2x icon-file-text-alt"></i></a> 
                                <a ng-click="updateState(facture)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Modifier l'état de la facture"><i class="icon icon-pencil"></i></a>                                 
                                <a  ng-click="removeFacture(facture.facture)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Supprimer facture"><i class="icon icon-trash"></i></a> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalfacture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Etat facture</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" onmouseover="initForm()">
                        <input type="hidden" id="voyageid"/>
                        <div class="form-group"> 
                            <label class="col-md-4 control-label">Etat de la facture</label>
                            <div class="col-md-8">
                                <select id="facture" name="facture" required class="form-control">
                                    <option></option>
                                    <option value="NON ENVOYEE">NON ENVOYEE</option>
                                    <option value="ENVOYEE NON PAYEE">ENVOYEE NON PAYEE</option>
                                    <option value="ENVOYEE PAYEE">ENVOYEE PAYEE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Montant Payé</label>
                            <div class="col-md-8">
                                <input type="number" id="recu" class="form-control"/>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-4 control-label">Date</label>
                            <div class="col-md-8">
                                <input type="datetime" id="reception" class="form-control" placeholder="2014-01-25 12:05" data-inputmask="'mask': '9999-99-99 99:99'"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateEtatFacture()">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuller</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
     </div>
</div>