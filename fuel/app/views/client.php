<div class="row" ng-controller="ClientCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="#">Home</a> </li>
            <li class="current"> <a href="#" title=""></a> </li>
        </ul>
        <ul class="crumb-buttons">
            <li class="first"><a title="Nouveau client" ng-click="showList = false;"><i class="icon-plus"></i><span>Nouveau</span></a></li>
            <li><a title="Supprimer les clients?" ng-click="removeClient()"><i class="icon-trash"></i><span>Supprimer</span></a></li>
            <li><a title="Liste Clients" href="#/clients" ng-click="reload()"><i class="icon-list"></i><span>Liste</span></a></li>
            <li><a href="#"> <i class="icon-calendar"></i> <span id="heure"></span></a></li>
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
                    <h4><i class="icon-reorder"></i> Liste Clients</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>                           
                                <th>Type</th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="client in clients| orderBy: 'nom'" class="tr{{client.id}}" ngrepeatfinish="">                            
                                <td>{{client.type}}</td>
                                <td>{{client.nom}}</td>
                                <td>{{client.email}}</td>
                                <td>{{client.adresse}}</td>
                                <td>
                                    <a ng-click="editClient(client)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Modifier Client"><i class="icon icon-pencil"></i></a> 
                                    <a  ng-click="removeClient(client)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Supprimer client"><i class="icon icon-trash"></i></a> 
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
                    <h4><i class="icon-reorder"></i> Enregistrer un client</h4>
                </div>
                <div class="widget-content">
                    <form class="form-horizontal row-border" id="frmclient" ng:submit="saveClient()">                 
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
                        <div class="form-actions"> 
                            <input type="submit" value="Enregistrer"  class="btn btn-primary pull-left"> 
                            <input type="reset" value="Annuller" class="btn btn-danger pull-right"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>