var afApp = angular.module("afApp", []);
afApp.config(function($routeProvider) {
    $routeProvider.
            when('/users', {templateUrl: baseUrl + 'page/route/users', controller: 'UserCtrl'}).
            when('/clients', {templateUrl: baseUrl + 'page/route/client', controller: 'ClientCtrl'}).
            when('/services', {templateUrl: baseUrl + 'page/route/service', controller: 'ServiceCtrl'}).
            when('/voyages', {templateUrl: baseUrl + 'page/route/voyage', controller: 'VoyageCtrl'}).
            when('/factures', {templateUrl: baseUrl + 'page/route/factures', controller: 'FactureCtrl'}).
            when('/facture/:voyageId', {templateUrl: baseUrl + 'page/route/facture', controller: 'FactureCtrl'}).
            when('/facture/detail/:factureId', {templateUrl: baseUrl + 'page/route/detailfacture', controller: 'FactureCtrl'}).
            otherwise({redirectTo: '/voyages'});
});

afApp.run(function($rootScope, factureService) {    
    $rootScope.notSendFactures = [];
    $rootScope.notPayedFactures = [];
    factureService.getNotSend(function(data) {
        $rootScope.notSendFactures = data;
        $rootScope.notSendFacturesLength = $rootScope.notSendFactures.length;
    });
    factureService.getSendNotPayed(function(data) {
        $rootScope.notPayedFactures = data;
        $rootScope.notPayedFactureLength = $rootScope.notPayedFactures.length;
    });
   
});

afApp.directive('ngrepeatfinish', function() {
    return function(scope, element, attrs) {
        scope.$watch('$last', function(v) {
            if (v) {
                Util.dataTable('.datatable');
                /*$(".dte_arrive").each(function (index) {
                 var formatdate=Util.formatDate($(this).text());
                 $(this).text(formatdate);
                 });*/
                refreshFactureState();
                $('a').tooltip();
            }

        });

    };
});
