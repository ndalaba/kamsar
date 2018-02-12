<div class="row" ng-controller="ServiceCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="#">Home</a> </li>
            <li class="current"> <a href="#" title=""></a> </li>
        </ul>
        <ul class="crumb-buttons">
            <li class="first"><a title="Nouveau service" ng-click="showList = false;"><i class="icon-plus"></i><span>Nouveau</span></a></li>
            <li><a title="Supprimer les services?" ng-click="removeService()"><i class="icon-trash"></i><span>Supprimer</span></a></li>
            <li><a title="Liste services" href="#/services" ng-click="reload()"><i class="icon-list"></i><span>Liste</span></a></li>
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
                    <h4><i class="icon-reorder"></i> Liste Services</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>                           
                                <th>Service</th>
                                <th>Montant</th>
                                <th>Note</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="service in services| orderBy: 'nom'" class="tr{{service.id}}" ngrepeatfinish="">                           
                                <td>{{service.service}}</td>
                                <td>{{service.montant}}</td>
                                <td>{{service.note}}</td>
                                <td>
                                    <a ng-click="editService(service)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Modifier le service"><i class="icon icon-pencil"></i></a> 
                                    <a ng-click="removeService(service)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Supprimer le service"><i class="icon icon-trash"></i></a> 
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
                    <h4><i class="icon-reorder"></i> Enregistrer un service</h4>
                </div>
                <div class="widget-content">
                    <form class="form-horizontal row-border" id="frmservice" ng:submit="saveService()">                 
                        <input type="text" name="id" style="display: none" ng-model="service.id" id="id"/>
                        <label class="col-md-11 alert alert-danger" id="form_error" style="margin: 10px 2px 2px 24px; display: none;"></label>                   
                        <div class="form-group">
                            <label class="col-md-4 control-label">Service <span class="required">*</span></label>
                            <div class="col-md-8"><input type="text" ng-model="service.service" id="service" name="service" class="form-control" required autocomplete="off"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Montant <span class="required">*</span></label>
                            <div class="col-md-8"><input type="number" ng-model="service.montant" id="montant" name="montant" class="form-control" required autocomplete="off"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Note</label>
                            <div class="col-md-8"><textarea ng-model="service.note" id="note" name="note" class="form-control"></textarea> </div>
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