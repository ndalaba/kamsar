<header class="header navbar navbar-fixed-top" role="banner">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="#" title=""><i class="icon-reorder"></i></a></li>
        </ul>
        <a class="navbar-brand" href="#/"> 
            <img width="29" src="<?php echo Uri::create('assets/img/logo-afrimarine.png') ?>" alt="logo"> <strong>AFRI</strong>MARINE </a> <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation"> <i class="icon-reorder"></i> </a> 
        <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
            <li> <a href="#/"> HOME </a> </li>           
        </ul>
        <ul class="nav navbar-nav navbar-right">   
            <li class="dropdown" ng-show="notSendFacturesLength > 0"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 20px;">
                    <i class="icon-warning-sign"></i> <span class="badge">{{notSendFacturesLength}}</span> 
                </a> 
                <ul class="dropdown-menu extended notification"> <li class="title"> <p>Vous avez {{notSendFacturesLength}} facture(s) non envoyée(s)</p> </li> 
                    <li ng-repeat="voyage in notSendFactures">
                        <a href="#/facture/{{voyage.id}}"> 
                            <span class="label label-warning"><i class="icon-warning-sign"></i></span> 
                            <span class="message">{{voyage.voyage}} - {{voyage.bateau}} du {{voyage.arrival}}.</span>
                        </a> 
                    </li>                     
                    <li class="footer"> 
                        <a href="#/voyages">Voir tous les voyages</a>
                    </li> 
                </ul> 
            </li>
             <li class="dropdown" ng-show="notPayedFactureLength > 0"> 
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 20px;">
                    <i class="icon-envelope"></i> <span class="badge">{{notPayedFactureLength}}</span> 
                </a> 
                <ul class="dropdown-menu extended notification"> <li class="title"> <p>Vous avez {{notPayedFactureLength}} facture(s) non payée(s)</p> </li> 
                    <li ng-repeat="facture in notPayedFactures">
                        <a href="#/facture/detail/{{facture.id}}"> 
                            <span class="label label-warning"><i class="icon-warning-sign"></i></span> 
                            <span class="message">{{facture.voyage}} - {{facture.bateau}}  {{facture.arrival}}.</span>
                        </a> 
                    </li>                     
                    <li class="footer"> 
                        <a href="#/factures">Voir toutes les factures</a>
                    </li> 
                </ul> 
            </li>
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-male"></i> 
                    <span class="username"><?php echo Session::get('login') ?></span> <i class="icon-caret-down small"></i> 
                </a> 
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-user"></i> Mon profil</a></li> 
                    <?php if (Session::get('droit') > 3): ?>                  
                        <li><a href="#/users"><i class="icon-list"></i> Utilisateurs</a></li>
                    <?php endif; ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo Fuel\Core\Uri::create('user/logout') ?>"><i class="icon-key"></i> Sortir</a></li>
                </ul>
            </li>
        </ul>
    </div>  
</header>