var dataTablePart;

if (typeof(order) == "undefined"){
    order = [[ 0, 'asc' ]];
}

if (typeof(scrollY_val) == "undefined"){
    scrollY_val = '50vh';
}

$(document).ready( function () {
    dataTablePart = $('.table_to_paginate_part').DataTable({
        scrollY: scrollY_val,
        dom: 'liftBp',
        buttons: [
              {
                  extend: 'pdfHtml5',
                  text: 'Générer un PDF',
                  className: 'btnPDF',
                  filename: 'Liste_Comptes',
                  title: 'Liste des comptes',
                  orientation: 'landscape',
                  exportOptions:{
                      columns: [0,1,2,3,4,7,8,9]
                  },
                  customize: function ( doc ) {
                    let margin = 20;
                    let width = 735-(2*margin);
                    doc.pageSize= 'LETTER';
                    doc.defaultStyle.fontSize = 12;
                    doc.pageMargins = [margin, margin, margin, margin];
                    doc.content[1].table.widths = [
                        width*0.125, width*0.125, width*0.1, width*0.1,
                        width*0.125, width*0.175, width*0.125, width*0.125
                    ];
                }
            }
          ],
          columnDefs: [
            {
                "targets": [ 7,8,9 ],
                "visible": false,
                "searchable": false
            }],
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
    dataTablePart.order(order).draw();
} );
