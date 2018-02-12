Util = {
    alert: function(msg) {
        $.msg({
            bgPath: 'assets/img/',
            content: '<p style="font-size:20px">' + msg + '</p>',
            autoUnblock: true
        });
    },
    confirm: function(msg, fn) {
        $.msg({
            bgPath: 'assets/img/',
            autoUnblock: false,
            clickUnblock: false,
            content: '<p style="font-size:20px">' + msg + '</p>' +
                    '<p style="text-align: center;margin: 0;">' +
                    '<button class="btn btn-info btn-small" id="yes" style="margin-right:50px">Oui</button>' +
                    '<span class="btn btn-danger btn-small" id="no">Non</button>' +
                    '</p>',
            afterBlock: function() {
                var self = this;
                $('#yes').bind('click', function() {
                    self.unblock(50);
                });
                $('#yes').bind('click', fn);
                $('#no').bind('click', function() {
                    self.unblock();
                });
            }
        });
    },
    resetForm: function(ele) {
        $(ele).find(':input').each(function() {
            switch (this.type) {
                case 'password':
                case 'select-multiple':
                case 'select-one':
                case 'text':
                case 'textarea':
                case 'email':
                case "hidden":
                case "date":
                case "number":
                    $(this).val('');
                    break;
                case 'checkbox':
                case 'radio':
                    this.checked = false;
            }
        });
    },
    setSelectValue: function(selectId, val) {
        var elmt = document.getElementById(selectId);
        for (var i = 0; i < elmt.options.length; i++) {
            if (elmt.options[i].value === val)
                elmt.options[i].selected = true;
        }
    },
    dataTable: function(id) {
        $(id).dataTable({
            "sPaginationType": "full_numbers"
                    //"bRetrieve":true,
                    //"bDestroy":true
        });
        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_length select').addClass('form-control');
    },
    chosen: function() {
        $('.chosen').chosen();
    },
    removechosen: function() {
        $("select").removeClass("chzn-done").css('display', 'inline').data('chosen', null);
        $(".chosen-container").remove();
    },
    showTime: function(id) {
        var date = new Date();
        var texte = '';
        if (date.getMinutes() < 10) {
            addZero = "0";
        } else {
            addZero = "";
        }
        texte += '' + date.getHours() + ' : ' + addZero + date.getMinutes();
        document.getElementById(id).innerHTML = texte;
    },
    formatDate: function($date) {
        var $f = $date.split("-");
        $f.reverse();
        $format = $f.join('/', $f);
        return $format;
    },
    print: function(titre, objet) {
        var zone = $('#' + objet).html();
        var fen = window.open("", "", "toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=10, top=10");

        // style du popup
        fen.document.body.style.color = '#000000';
        fen.document.body.style.backgroundColor = '#FFFFFF';
        fen.document.body.style.padding = "20px";

        fen.document.title = titre;
        fen.document.body.innerHTML += " " + zone;
        //facture += fen.document.body.innerHTML;
        // Impression du popup
        fen.window.print();

        //Fermeture du popup
        fen.window.close();
        return true;
    }

};