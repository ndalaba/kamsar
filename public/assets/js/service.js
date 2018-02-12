/**
 * Created by N'Dalaba on 15/01/14.
 */

// FACTURE
afApp.factory('factureService', function($http) {

    return {
        get: function(fn) {
            $http.get('facture/loadFacture').success(function(data) {
                fn(data);
            });
        },
        getLast: function(fn) {
            $http.get('facture/getLast').success(function(data) {
                fn(data);
            });
        },
        save: function(facture, fn) {
            $.post('facture/save', facture, function(data) {
                if (fn)
                    fn(data);
            });
        },
        remove: function(id,voyage_id) {
            $.post('facture/deletefacture/' + id+"/"+voyage_id, function() {
                $('.tr' + id).fadeOut();
            });
        },
        updateState: function(dt, fn) {
            $.post('facture/updateState', dt, function(data) {
                if (fn)
                    fn(data);
            });
        },
        getOne: function(id, fn) {
            $http.get("facture/getOne/" + id).success(function(data) {
                if (fn)
                    fn(data);
            });
        },
        getNotSend: function(fn) {
            $http.get("facture/getNotSend/").success(function(data) {
                if (fn)
                    fn(data);
            });
        },
        getSendNotPayed: function(fn) {
            $http.get("facture/getSendNotPayed/").success(function(data) {
                if (fn)
                    fn(data);
            });
        }

    };
});

// SERVICE
afApp.factory('Service', function($http) {
    return {
        get: function(fn) {
            $http.get('config/loadservices').success(function(data) {
                fn(data);
            });
        },
        getService: function(id, fn) {
            $http.get('config/getService/' + id).success(function(data) {
                fn(data);
            });
        },
        save: function(s, fn) {
            $.post('config/saveservice', s, function(data) {
                fn(data);
            });
        },
        remove: function(id) {
            $.post('config/deleteservice/' + id, function() {
                $('.tr' + id).fadeOut();
            });
        }

    };
});

//CLIENT SERVICE
afApp.factory('clientService', function($http) {

    return {
        get: function(fn) {
            $http.get('config/loadClient').success(function(data) {
                fn(data);
            });
        },
        getClient: function(id, fn) {
            $http.get('config/getClient/' + id).success(function(data) {
                fn(data);
            });
        },
        save: function(c, fn) {
            $.post('config/saveclient', c, function(data) {
                if (fn)
                    fn(data);
            });
        },
        remove: function(id) {
            $.get('config/deleteclient/' + id, function() {
                $('.tr' + id).fadeOut();
            });
        },
        getType: function(fn) {
            $http.get('config/loadClientType').success(function(data) {
                fn(data);
            });
        }

    };
});

//VOYAGE SERVICE
afApp.factory('voyageService', function($http) {

    return {
        get: function(fn) {
            $http.get('config/loadVoyage').success(function(data) {
                fn(data);
            });
        },
        save: function(v, fn) {
            $.post('config/savevoyage', v, function(data) {
                if (fn)
                    fn(data);
            });
        },
        remove: function(id) {
            $.get('config/deletevoyage/' + id, function() {
                $('.tr' + id).fadeOut();
            });
        },
        getVoyage: function(id, fn) {
            $http.get('config/getVoyage/' + id).success(function(data) {
                fn(data);
            });
        }

    };
});

//USER  SERVICE
afApp.factory('userService', function($http) {
    return {
        get: function(fn) {
            $http.get('user/loadUser').success(function(data) {
                fn(data);
            });
        },
        save: function(u, fn) {
            $.post('user/saveUser', u, function(data) {
                fn(data);
            });
        },
        remove: function(id) {
            $.post('user/deleteuser/' + id, function() {
                $('.tr' + id).fadeOut();
            });
        }

    };
});