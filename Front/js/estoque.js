$(document).ready(function() {
  $('#example').DataTable({
    "fnCreatedRow": function(nRow, aData, iDataIndex) {
      $(nRow).attr('id', aData[0]);
    },
    'serverSide': 'true',
    'processing': 'true',
    'paging': 'true',
    'order': [],
    'ajax': {
      'url': '../back/buscar_dados.php',
      'type': 'post',
    },
    "aoColumnDefs": [{
        "bSortable": false,
        "aTargets": [6]
      },
    ]
  });
});

$(document).on('submit', '#updateUser', function(e) {
  e.preventDefault();

  var produto = $('#produtoField').val();
  var quantidade = $('#quantidadeField').val();
  var fornecedor = $('#fornecedorField').val();
  var nota_fiscal = $('#nota_fiscalField').val();
  var estado_uso = $('#estado_usoField').val();
  var trid = $('#trid').val();
  var id = $('#id').val();

  if (produto !== '' && quantidade !== '' && fornecedor !== '' && nota_fiscal !== '' && estado_uso !== '') {
    $.ajax({
      url: "../back/atualizar_estoque.php",
      type: "post",
      data: {
        produto: produto,
        quantidade: quantidade,
        fornecedor: fornecedor,
        nota_fiscal: nota_fiscal,
        estado_uso: estado_uso,
        id: id
      },
      success: function(data) {
        var json = JSON.parse(data);
        var status = json.status;

        if (status === 'true') {
          var table = $('#example').DataTable();
          var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Editar</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Deletar</a></td>';
          var row = table.row("[id='" + trid + "']");
          row.row("[id='" + trid + "']").data([id, produto, quantidade, fornecedor, nota_fiscal, estado_uso, button]);
          $('#exampleModal').modal('hide');
        } else {
          alert('Failed to update the data.');
        }
      },
      error: function(xhr, status, error) {
        console.error('An error occurred: ' + error);
        alert('Failed to update the data due to a server error.');
      }
    });
  } else {
    alert('Fill all the required fields.');
  }
});

$('#example').on('click', '.editbtn', function(event) {
  var table = $('#example').DataTable();
  var trid = $(this).closest('tr').attr('id');
  var id = $(this).data('id');

  $('#exampleModal').modal('show');

  $.ajax({
    url: "../back/obter_dados.php",
    type: 'post',
    data: {
      id: id
    },
    success: function(data) {
      var json = JSON.parse(data);
      $('#produtoField').val(json.produto);
      $('#quantidadeField').val(json.quantidade);
      $('#fornecedorField').val(json.fornecedor);
      $('#nota_fiscalField').val(json.nota_fiscal);
      $('#estado_usoField').val(json.estado_uso);
      $('#id').val(id);
      $('#trid').val(trid);
    },
    error: function(xhr, status, error) {
      console.error('An error occurred: ' + error);
      alert('Failed to fetch the data.');
    }
  });
});

$(document).on('click', '.deleteBtn', function(event) {
  var table = $('#example').DataTable();
  event.preventDefault();
  var id = $(this).data('id');

  if (confirm("Você quer deletar mesmo esse equipamento?")) {
    $.ajax({
      url: "../back/deletar_estoque.php",
      type: "post",
      data: {
        id: id
      },
      success: function(data) {
        var json = JSON.parse(data);
        if (json.status === 'success') {
          $("#" + id).closest('tr').remove();
        } else {
          alert('Failed to delete the data.');
        }
      },
      error: function(xhr, status, error) {
        console.error('An error occurred: ' + error);
        alert('Failed to delete the data due to a server error.');
      }
    });
  }
});
