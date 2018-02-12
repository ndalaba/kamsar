<div class="row" ng-controller="UserCtrl">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="#">Home</a> </li>
            <li class="current"> <a href="#" title=""></a> </li>
        </ul>
        <ul class="crumb-buttons">
            <li class="first"><a title="Nouvel utilisateur" ng-click="showList = false;"><i class="icon-plus"></i><span>Nouveau</span></a></li>
            <li><a title="Supprimer les utilisateurs?" ng-click="removeUser()"><i class="icon-trash"></i><span>Supprimer</span></a></li>
            <li><a title="Liste utilisateur" href="#/users" ng-click="reload()"><i class="icon-list"></i><span>Liste</span></a></li>
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
                    <h4><i class="icon-reorder"></i> Liste utilisateurs</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                </div>
                <div class="widget-content">
                    <table class="table table-striped table-bordered table-hover table-checkable datatable">
                        <thead>
                            <tr>                            
                                <th>Login</th>
                                <th>Nom et Prénom</th>                    
                                <th>Droit</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="user in users| orderBy: 'nom'" class="tr{{user.id}}">                          
                                <td>{{user.login}}</td>
                                <td>{{user.nom}}</td>                    
                                <td><span class="label label-success">{{user.droit}}</td></td>
                                <td>
                                    <a ng-click="editUser(user)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Modifier l'utilisateur"><i class="icon icon-pencil"></i></a> 
                                    <a  ng-click="removeUser(user)" class="btn btn-sm" data-toggle="tooltip" data-original-title="Supprimer l'utilisateur"><i class="icon icon-trash"></i></a> 
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
                    <h4><i class="icon-reorder"></i> Enregistrer un utilisateur</h4>
                </div>
                <div class="widget-content">
                    <form class="form-horizontal row-border" id="frmuser" ng-submit="saveUser()">
                        <input type="text" name="id" style="display: none" ng-model="user.id" id="id"/>
                        <label class="col-md-11 alert alert-danger" id="form_error" style="margin: 10px 2px 2px 24px; display: none;"></label>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Login <span class="required">*</span></label> 
                            <div class="col-md-8"> <input type="text" ng-model="user.login" id="login" name="login" class="form-control" required autocomplete="off"/></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nom et Prénom <span class="required">*</span></label> 
                            <div class="col-md-8"><input type="text" ng-model="user.nom" id="nom" name="nom" class="form-control" required autocomplete="off"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Droit <span class="required">*</span></label> 
                            <div class="col-md-8"> 
                                <select id="droit" name="droit" class="form-control" required>
                                    <option value="">- - - - -</option>
                                    <option value="1">Utilisateur</option>
                                    <option value="2">Editeur</option>
                                    <option value="3">Gestionnaire</option>
                                    <option value="4">Administrateur</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Mot de passe <span class="required">*</span></label> 
                            <div class="col-md-8">  <input type="password" id="pwd" name="pwd" value="" class="form-control" /> </div>
                            <label class="col-md-11 alert alert-info" style="margin: 10px 2px 2px 65px;">Si vous souhaitez changer le mot de passe de l'utilisateur, tapez en un nouveau. Sinon, laissez le champ vide.</label>
                        </div>                   
                        <div class="form-actions"> 
                            <input type="submit" value="Enregistrer"  class="btn btn-primary pull-left"> 
                            <input type="reset" value="Annuller" class="btn btn-danger pull-right" ng-click="showList = true">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>