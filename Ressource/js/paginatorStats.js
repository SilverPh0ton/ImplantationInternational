var dataTableStats;
var dataTableStats2;

if (typeof(order) == "undefined"){
    order = [[ 0, 'asc' ]];
}

if (typeof(scrollY_val) == "undefined"){
    scrollY_val = '50vh';
}

$(document).ready( function () {

    dataTableStats = $('.table_to_paginate_stats').DataTable({
        scrollY: scrollY_val,
        dom: 'liftBp',
        buttons: [
              {
                  extend: 'pdfHtml5',
                  text: 'Générer un PDF',
                  className: 'btnPDF',
                  filename: 'Statistiques',
                  title: 'Statistiques',
                  orientation: 'portrait',
                  exportOptions:{
                      columns: [0,1,2,3,4]
                  },
                  customize: function ( doc ) {
                    let margin = 20;
                    let width = 580-(2*margin);
                    doc.pageSize= 'LETTER';
                    doc.defaultStyle.fontSize = 12;
                    doc.pageMargins = [margin, margin, margin, margin];
                    doc.content[1].table.widths = [
                        width*0.2, width*0.2, width*0.2,
                        width*0.2, width*0.2
                    ];
                }
            }
          ],
        language: {
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ ",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        }
    });
    dataTableStats = $('.table_to_paginate_stats2').DataTable({
        scrollY: scrollY_val,
        dom: 'liftBp',
        buttons: [
              {
                  extend: 'pdfHtml5',
                  text: 'Générer un PDF',
                  className: 'btnPDF',
                  filename: 'Statistiques',
                  title: 'Statistiques',
                  orientation: 'portrait',
                  exportOptions:{
                      columns: [0,1,2,3]
                  },
                  customize: function ( doc ) {
                    let margin = 20;
                    let width = 585-(2*margin);
                    doc.pageSize= 'LETTER';
                    doc.defaultStyle.fontSize = 12;
                    doc.pageMargins = [margin, margin, margin, margin];
                    doc.content[1].table.widths = [
                        width*0.25, width*0.25, width*0.25,
                        width*0.25
                    ];
                }
            }
          ],
        language: {
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ ",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                "rows": {
                    "_": "%d lignes sélectionnées",
                    "0": "Aucune ligne sélectionnée",
                    "1": "1 ligne sélectionnée"
                }
            }
        }
    });
    dataTableStats.order(order).draw();
    dataTableStats2.order(order).draw();
} );
