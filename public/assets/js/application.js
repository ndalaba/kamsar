afApp.controller('FactureCtrl', function($scope, clientService, $routeParams, voyageService, Service, factureService, $route) {
    $scope.showList = true;
    var voyageId = $routeParams.voyageId;
    var factureId = $routeParams.factureId;
    $scope.total = 0;
    $scope.discount = 0;
    $scope.services = [];
    $scope.factures = [];
    $scope.previousFacture;
    $scope.client;
    $scope.currentFacture;
    $scope.factureComplete = false;

    $scope.getOne = function() {
        factureService.getOne(factureId, function(data) {
            $scope.currentFacture = data;
        });
    };

    $scope.loadFactures = function() {
        factureService.get(function(factures) {
            $scope.factures = factures;
        });
    };
    $scope.getPreviousFacture = function() {
        factureService.getLast(function(facture) {
            $scope.previousFacture = facture;
            $scope.numeroFacture = parseInt(facture.id) + 1;
        });
    };
    $scope.getVoyage = function() {
        voyageService.getVoyage(voyageId, function($voyage) {
            voyage = $scope.voyage = $voyage;
        });
    };
    $scope.loadClients = function() {
        clientService.get(function(clients) {
            $scope.clients = clients;
        });
    };
    $scope.loadServices = function() {
        Service.get(function(services) {
            $scope.frmservices = services;
        });
    };
    $scope.saveFacture = function() {
        if (angular.isUndefined($scope.client) || $scope.services.length === 0)
            return Util.alert("Facture incomplete");

        var facture = {
            numero: $('#numeroFacture').text(),
            client_id: $scope.client.id,
            voyage_id: voyageId,
            remise: $scope.discount,
            montant: $('#grandTotal').text(),
            services: $scope.services
        };
        factureService.save(facture, function() {
            Util.alert("Facture enregistrée ");
        });
    };
    $scope.removeFacture = function(facture) {
        Util.confirm("Supprimer la facture?", function() {
            factureService.remove(facture.id, facture.voyage_id);
        });

    };
    $scope.updateEtatFacture = function() {
        var voyage = {
            id: $('#voyageid').val(),
            facture: $('#facture').val(),
            recu: $('#recu').val(),
            reception: $('#reception').val()
        };
        factureService.updateState(voyage, function() {
            $('#modalfacture').modal('hide');
            document.getElementById('refresh').click();
        });
    };
    $scope.updateState = function(facture) {
        $('#voyageid').val(facture.voyage.id);
        Util.setSelectValue('facture', facture.voyage.facture);
        $('#recu').val(facture.facture.recu);
        $('#reception').val(facture.facture.reception);
        $('#modalfacture').modal();
    };
    $scope.getPaf = function() {
        var id = $('#paf_id').val();
        clientService.getClient(id, function(client) {
            $scope.client = client;
            $('#modalpaf').modal('hide');
            if ($scope.services.length > 0)// Si au moins un service a été ajouté à la facture
                $scope.factureComplete = true;
        });
    };
    $scope.addPaf = function() {
        $('#modalpaf').modal();
    };
    $scope.getService = function() {
        var id = $('#service_id').val();
        Service.getService(id, function(service) {
            $scope.services.push(service);
            $('#modalservice').modal('hide');
            if ($scope.client)//Si un paf a été ajouté à la facture
                $scope.factureComplete = true;
        });

    };
    $scope.addService = function() {
        $('#modalservice').modal();
    };
    $scope.removeService = function(service) {
        $scope.services.splice($scope.services.indexOf(service), 1);
    };

    $scope.$watch('services', function() {
        var somme = 0;
        angular.forEach($scope.services, function(service) {
            var montant = parseInt(service.montant);
            somme = somme + montant;
        });
        $scope.total = somme;
    }, true);

    $scope.printFacture = function() {
        var titre = $("#breadcrumbs .current a").text() + "_" + $('#numeroFacture').text();
        $('#printZone input[type=button]').hide();
        Util.print(titre, 'printZone');
        $('#printZone input[type=button]').show();
        $('#modalMessage').modal();
    };

    $scope.printAndSave = function() {
        if (!$scope.factureComplete)
            return Util.alert("Facture incomplete");
        var facture = {
            numero: $('#numeroFacture').text(),
            client_id: $scope.client.id,
            voyage_id: voyageId,
            remise: $scope.discount,
            montant: $('#grandTotal').text(),
            services: $scope.services
        };
        factureService.save(facture, function(facture) {
            $scope.currentFacture = JSON.parse(facture);
            $('#facture_id').val($scope.currentFacture.facture.id);
            $scope.printFacture();
        });
    };

    $scope.sendFacture = function() {
        var title = $('#fichier').val();
        if (title.length === 0)
            Util.alert("Selectionner une facture!");
        else
            Util.confirm("Envoye la facture <strong>" + title + "</strong>?", function() {
                $("#frmMsg").submit();
            });
    };

    $scope.reload = function() {
        $route.reload();
    };

    var init = function() {
        if ($routeParams.voyageId) {
            $scope.getVoyage();
            $scope.loadClients();
            $scope.loadServices();
            $scope.getPreviousFacture();
        }
        else if ($routeParams.factureId) {
            $scope.getOne();
            $scope.factureComplete = true;
        }
        else {
            $('.crumbs li.current a').html("Factures");
            $('.page-title h3').html("Les dernières factures");
            $scope.loadFactures();
        }
    };
    init();
    setInterval('Util.showTime("heure")', 1000);
});

afApp.controller('ClientCtrl', function($scope, clientService, $route) {
    var clients = $scope.clients = [];
    $scope.showList = true;
    $scope.resetClient = function() {
        $scope.id = "";
        Util.resetForm('#frmclient');
        $('.chosen').val('').trigger('chosen:updated');// reset les selects chosen
    };
    $scope.loadClients = function() {
        clientService.get(function(clients) {
            $scope.clients = clients;
        });
    };
    $scope.loadTypeClients = function() {
        clientService.getType(function(types) {
            $scope.types = types;
        });
    };
    $scope.removeClient = function(client) {
        /* var client = new Array();
         $("input:checked").each(function() {
         client.push($(this).val());
         });*/
        Util.confirm("Supprimer le client " + client.nom + "?", function() {
            clientService.remove(client.id);
        });
        return false;
    };
    $scope.saveClient = function() {
        var client = $('#frmclient').serialize();
        clientService.save(client);
        $scope.resetClient();
    };
    $scope.editClient = function(e) {
        $scope.client = e;
        Util.setSelectValue('type', e.type);
        $scope.showList = false;
    };
    $scope.reload = function() {
        $route.reload();
    };
    var init = function() {
        $('.crumbs li.current a').html("Clients");
        $('.page-title h3').html("Liste des clients");
        $scope.loadClients();
        $scope.loadTypeClients();
    };
    init();
    setInterval('Util.showTime("heure")', 1000);
});

afApp.controller('ServiceCtrl', function($scope, Service, $route) {
    var services = $scope.services = [];
    $scope.showList = true;
    $scope.resetService = function() {
        $scope.id = "";
        Util.resetForm('#frmservice');
    };
    $scope.loadServices = function() {
        Service.get(function(services) {
            $scope.services = services;
        });
    };
    $scope.removeService = function(service) {
        /*var service = new Array();
         $("input:checked").each(function() {
         service.push($(this).val());
         });*/
        Util.confirm("Supprimer le service " + service.service + "?", function() {
            Service.remove(service);
        });
        return false;
    };
    $scope.saveService = function() {
        var service = $('#frmservice').serialize();
        Service.save(service);
        $scope.resetService();
    };
    $scope.editService = function(e) {
        $scope.service = e;
        $('#montant').val(e.montant);
        $scope.showList = false;
    };
    $scope.reload = function() {
        $route.reload();
    };
    var init = function() {
        $('.crumbs li.current a').html("services");
        $('.page-title h3').html("Liste des services");
        $scope.loadServices();
    };
    init();
    setInterval('Util.showTime("heure")', 1000);
});

afApp.controller('VoyageCtrl', function($scope, voyageService, clientService, $route, $location) {
    $scope.voyages = [];
    $scope.showList = true;
    $scope.clients = [];
    $scope.resetVoyage = function() {
        $scope.id = "";
        Util.resetForm('#frmvoyage');
        $('.chosen').val('').trigger('chosen:updated');// reset les selects chosen
    };
    $scope.loadClients = function() {
        $scope.clients = [];
        clientService.get(function(clients) {
            $scope.clients = clients;
        });
    };

    $scope.loadVoyages = function() {
        voyageService.get(function(voyages) {
            $scope.voyages = voyages;
        });
    };
    $scope.removeVoyage = function(voyage) {
        /*var voyage = new Array();
         $("input:checked").each(function() {
         voyage.push($(this).val());
         });*/
        Util.confirm("Supprimer le voyage ?", function() {
            voyageService.remove(voyage.id);
        });
        return false;
    };
    $scope.saveVoyage = function() {
        var voyage = {
            id: $('#id').val(),
            voyage: $('#voyage').val(),
            bateau: $('#bateau').val(),
            chtr_id: $('#chtr_id').val(),
            carrier_id: $('#carrier_id').val(),
            destination: $('#destination').val(),
            tonnage: $('#tonnage').val(),
            arrival: $('#arrival').val(),
            departure: $('#departure').val(),
            vld: $('#vld').val(),
            laycan: $('#laycan').val(),
            nor: $('#nor').val(),
            sail_time: $('#sail_time').val(),
            fixed: $('#fixed').val(),
            rate: $('#rate').val(),
            description: $('#description').val()
        };
        voyageService.save(voyage);
        $scope.resetVoyage();
    };
    $scope.editVoyage = function(e, c) {
        $('.chosen').val('').trigger('chosen:updated');//reset de tous les selects
        $scope.voyage = e;
        $('#tonnage').val(e.tonnage);
        Util.setSelectValue('chtr_id', e.chtr_id);
        for (var key in c) {
            Util.setSelectValue('carrier_id', c[key].id);
        }
        $('.chosen').trigger('chosen:updated');
        $scope.showList = false;
    };
    $scope.reload = function() {
        $route.reload();
    };
    $scope.showFacture = function() {
        var voyageId = $("input:checked:first").val();
        $location.path('/facture/' + voyageId);
    };
    $scope.loadTypeClients = function() {
        clientService.getType(function(types) {
            $scope.types = types;
        });
    };
    $scope.addClient = function() {
        $('#modalClient').modal();
    };
    $scope.saveClient = function() {
        Util.removechosen();
        var client = $('#frmclient').serialize();
        clientService.save(client, function(client) {
            // $scope.clients.push(client);
            $scope.loadClients();
        });
        Util.resetForm('#frmclient');
        $('#modalClient').modal('hide');
    };
    var init = function() {
        $('.crumbs li.current a').html("Voyages");
        $('.page-title h3').html("Les derniers voyages");
        $scope.loadClients();
        $scope.loadTypeClients();
        $scope.loadVoyages();
    };
    init();
    setInterval('Util.showTime("heure")', 1000);
});

afApp.controller('UserCtrl', function($scope, userService, $route) {
    var users = $scope.users = [];
    $scope.showList = true;
    $scope.resetUser = function() {
        $scope.id = "";
        Util.resetForm('#frmuser');
    };
    $scope.loadUsers = function() {
        userService.get(function(users) {
            $scope.users = users;
        });
    };
    $scope.removeUser = function() {
        var user = new Array();
        $("input:checked").each(function() {
            user.push($(this).val());
        });
        Util.confirm("Supprimer les utilisateurs selectionnés ?", function() {
            userService.remove(user);
        });
        return false;
    };
    $scope.saveUser = function() {
        var user = $('#frmuser').serialize();
        userService.save(user);
        $scope.resetUser();
    };
    $scope.editUser = function(e) {
        $scope.user = e;
        Util.setSelectValue('droit', e.droit);
        $scope.showList = false;
    };
    $scope.reload = function() {
        $route.reload();
    };
    var init = function() {
        $('.crumbs li.current a').html("Utilisateurs");
        $('.page-title h3').html("Liste des utilisateurs");
        $scope.loadUsers();
    };

    init();
    setInterval('Util.showTime("heure")', 1000);
});