$(document).ready(function() {
    $('#example').DataTable({
      "fnCreatedRow": function(nRow, aData, iDataIndex) {
        $(nRow).attr('id', aData[0]);
      },
      'serverSide': true,
      'processing': true,
      'paging': true,
      'order': [],
      'ajax': {
        'url': '../back/buscar_dados_comp.php',
        'type': 'post',
      },
      "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [7]
        },
      ]
    });
});

$(document).on('submit', '#updateUser', function(e) {
    e.preventDefault();

    var modelo = $('#modeloField').val();
    var fabricante = $('#fabricanteField').val();
    var categoria = $('#categoriaField').val();
    var situacao = $('#situacaoField').val();
    var matricula = $('#matriculaField').val();
    var numero_serie = $('#numero_serieField').val();
    var trid = $('#trid').val();
    var id = $('#id').val();

    if (modelo !== '' && fabricante !== '' && categoria !== '' && situacao !== '' && matricula !== '' && numero_serie !== '') {
        $.ajax({
            url: "../back/atualizar_comp.php",
            type: "post",
            data: {
                modelo: modelo,
                fabricante: fabricante,
                categoria: categoria,
                situacao: situacao,
                matricula: matricula,
                numero_serie: numero_serie,
                id: id
            },
            success: function(data) {
                var json = JSON.parse(data);
                var status = json.status;

                if (status === 'true') {
                    var table = $('#example').DataTable();
                    var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Editar</a> <a href="#!" data-id="' + id + '" class="btn btn-danger btn-sm deleteBtn">Deletar</a></td>';
                    var row = table.row("[id='" + trid + "']");
                    row.data([id, modelo, fabricante, categoria, situacao, matricula, numero_serie, button]).draw();
                    $('#exampleModal').modal('hide');
                } else {
                    alert('Falha ao atualizar os dados.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ocorreu um erro: ' + error);
                alert('Falha ao atualizar os dados devido a um erro no servidor.');
            }
        });
    } else {
        alert('Preencha todos os campos obrigatórios.');
    }
});

$('#example').on('click', '.editbtn', function(event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    var id = $(this).data('id');

    $('#exampleModal').modal('show');

    $.ajax({
        url: "../back/obter_dados_comp.php",
        type: 'post',
        data: { id: id },
        success: function(data) {
            var json = JSON.parse(data);
            $('#modeloField').val(json.modelo);
            $('#fabricanteField').val(json.fabricante);
            $('#categoriaField').val(json.categoria);
            $('#situacaoField').val(json.situacao);
            $('#matriculaField').val(json.matricula);
            $('#numero_serieField').val(json.numero_serie);
            $('#id').val(id);
            $('#trid').val(trid);
        },
        error: function(xhr, status, error) {
            console.error('Ocorreu um erro: ' + error);
            alert('Falha ao buscar os dados.');
        }
    });
});

$(document).on('click', '.deleteBtn', function(event) {
    var table = $('#example').DataTable();
    event.preventDefault();
    var id = $(this).data('id');

    if (confirm("Você tem certeza que deseja excluir este equipamento?")) {
        $.ajax({
            url: "../back/deletar_comp.php",
            type: "post",
            data: { id: id },
            success: function(data) {
                var json = JSON.parse(data);
                if (json.status === 'success') {
                    var row = table.row("#" + id);
                    row.remove().draw();
                } else {
                    alert('Falha ao deletar os dados.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ocorreu um erro: ' + error);
                alert('Falha ao deletar os dados devido a um erro no servidor.');
            }
        });
    }
});
