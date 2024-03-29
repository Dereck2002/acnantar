//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarHistorial(e);
  });
  $("#Recetas_form").on("submit", (e) => {
    guardayeditarReceta(e);
  });
}

$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    "../../controllers/creditos.controller.php?op=todos",
    (listahistorial) => {
      listahistorial = JSON.parse(listahistorial);
      $.each(listahistorial, (index, historial) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${historial.socio}</td>` +
          `<td>${historial.garante}</td>` +
          `<td>${historial.fecha_credito}</td>` +
          `<td>${historial.valor_credito}</td>` +
          `<td>${historial.destino}</td>` +
          `<td>${historial.plazo}</td>` +
          `<td>${historial.valor_aprobado}</td>` +
          `<td>${historial.plazo_aprobado}</td>` +
          `<td>${historial.fecha_aprobacion}</td>` +
          `<td>${historial.cuota}</td>` +
          
          `<td>` +
          `<button title='Modificar creditos' class='btn btn-small btn-success no-imprimir' onclick='uno(${historial.id_credito})'><i class="fa-solid fa-pen-to-square"></i></button>` +
          `<button title='Eliminar credito' class='btn btn-small btn-danger no-imprimir'  onclick='eliminar(${historial.id_credito})'><i class="fa-solid fa-trash"></i></button>` +
          `<button title='Emitir credito' class='btn btn-small btn-primary no-imprimir'  onclick='recetamedica(${historial.id_credito}, "${historial.paciente_ced}", "${historial.medico_cod}")'><i class="fa-solid fa-notes-medical"></i></button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};

var recetamedica = (historial_cod, paciente_ced, medico_cod) => {
  document.getElementById("paciente_ced1").value = paciente_ced;
  document.getElementById("medico_cod1").value = medico_cod;
  document.getElementById("historial_cod").value = historial_cod;

  $("#modalRecetas").modal("show");
};

var cargaSelectPacientes = () => {
  var html = ' <option value="0">Seleccione un Paciente</option>';
  $.post(
    "../../controllers/creditos.controller.php?op=todos",
    (listapacientes) => {
      listapacientes = JSON.parse(listapacientes);
      $.each(listapacientes, (index, socios) => {
        html += `<option value="${socios.id_socio}">${socios.id_socio}</option>`;
      });
      $("#paciente_ced").html(html);
    }
  );
};
var cargaSelectMedicos = () => {
  var html = ' <option value="0">Seleccione un medico</option>';
  $.post("../../controllers/medico.controller.php?op=todos", (listamedicos) => {
    listamedicos = JSON.parse(listamedicos);
    $.each(listamedicos, (index, medicos) => {
      html += `<option value="${medicos.medico_cod}">${medicos.medico_ape}</option>`;
    });
    $("#medico_cod").html(html);
  });
};
var guardayeditarHistorial = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var historial_cod = document.getElementById("historial_cod").value;
  if (historial_cod === undefined || historial_cod === "") {
    url = "../../controllers/creditos.controller.php?op=insertar";
  } else {
    url = "../../controllers/creditos.controller.php?op=actualizar";
  }

  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,

    success: (respuesta) => {
      respuesta = JSON.parse(respuesta);
      if (respuesta === "ok") {
        Swal.fire("HISTORIAL", "Se guardo con éxito", "success");
        limpiar();
        cargaTablaRoles();
      } else {
        Swal.fire("HISTORIAL", "OCURRIO UN PROBLEMA AL GUARDAR", "danger");
      }
    },
  });
};

var guardayeditarReceta = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#Recetas_form")[0]);

  url = "../../controllers/creditos.controller.php?op=insertar";
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,

    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta === "ok") {
        Swal.fire("RECETAS", "Se guardo con éxito", "success");
        limpiar();
        cargaTablaRoles();
      } else {
        Swal.fire("RECEGAS", "OCURRIO UN PROBLEMA AL GUARDAR", "danger");
      }
    },
  });
};

var uno = (historial_cod) => {
  $.post(
    "../../controllers/creditos.controller.php?op=uno",
    {
      historial_cod: historial_cod,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#historial_cod").val(res.historial_cod);
      $("#historial_det").val(res.historial_det);
      $("#historial_diag").val(res.historial_diag);
      $("#historial_trat").val(res.historial_trat);
    }
  );

  document.getElementById("titulModalUsuarios").innerHTML = "Editar HISTORIAL";
  $("#modalUsuarios").modal("show");
};

var eliminar = (historial_cod) => {
  Swal.fire({
    title: "HISTORIAL DE PACIENTES",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/creditos.controller.php?op=eliminar",
        {
          historial_cod: historial_cod,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Historial", "Se eliminó con éxito", "success");
            limpiar();
            cargaTablaRoles();
          }
        }
      );
    }
  });
};

var imprimirJavascript = () => {
  var contenidoImprimir = document.getElementById("Impresion").innerHTML;
  var contenidoOriginal = document.body.innerHTML;
  document.body.innerHTML = contenidoImprimir;
  window.print();
  document.body.innerHTML = contenidoOriginal;
};

var limpiar = () => {
  document.getElementById("historial_cod").value = "";
  document.getElementById("historial_det").value = "";
  $("#historial_diag").val("");
  $("#historial_trat").val("");
  document.getElementById("paciente_ced1").value = "";
  document.getElementById("medico_cod1").value = "";
  document.getElementById("historial_cod").value = "";

  $("#modalRecetas").modal("hide");
  $("#modalUsuarios").modal("hide");
};
init();
