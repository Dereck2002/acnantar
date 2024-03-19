//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#Recetas_form").on("submit", (e) => {
    guardayeditarRecetas(e);
  });
}
//$().ready(() => {
//  cargaTablaRoles();
//});
$().ready(() => {
  //$("#historial_det").summernote();
  //cargaTabla();
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    //"../../controllers/usuario.controller.php?op=todos",
    "../../controllers/recetas.controller.php?op=todos",
    (listarecetas) => {
      listarecetas = JSON.parse(listarecetas);
      $.each(listarecetas, (index, recetas) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${recetas.paciente_apel}</td>` +
          `<td>${recetas.receta_fec}</td>` +
          `<td>${recetas.receta_pres}</td>` +
          `<td>${recetas.receta_indi}</td>` +
          `<td>${recetas.receta_est}</td>` +
          `<td>` +
          `<button class='btn btn-small btn-success no-imprimir' onclick='uno(${recetas.receta_cod})'><i class="fa-solid fa-pen-to-square"></i></button>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
var imprimirJavascript = () => {
  var contenidoImprimir = document.getElementById("impresion").innerHTML;
  var contenidoOriginal = document.body.innerHTML;
  document.body.innerHTML = contenidoImprimir;
  window.print();
  document.body.innerHTML = contenidoOriginal;
};
var imprimirReceta = () => {
  var contenidoImprimir = document.getElementById("modalRecetas").innerHTML;
  var contenidoOriginal = document.body.innerHTML;
  document.body.innerHTML = contenidoImprimir;
  window.print();
  document.body.innerHTML = contenidoOriginal;
};
var cargaSelectPacientes1 = () => {
  var html = ' <option value="0">Seleccione un Paciente</option>';
  $.post(
    "../../controllers/pacientes.controller.php?op=todos",
    (listapacientes) => {
      listapacientes = JSON.parse(listapacientes);
      $.each(listapacientes, (index, pacientes) => {
        html += `<option value="${pacientes.paciente_ced}">${pacientes.paciente_apel}</option>`;
      });
      $("#paciente_ced1").html(html);
    }
  );
};
var cargaSelectMedicos1 = () => {
  var html = ' <option value="0">Seleccione un medico</option>';
  $.post("../../controllers/medico.controller.php?op=todos", (listamedicos) => {
    listamedicos = JSON.parse(listamedicos);
    $.each(listamedicos, (index, medicos) => {
      html += `<option value="${medicos.medico_cod}">${
        medicos.medico_ape + " " + medicos.medico_nom
      }</option>`;
    });
    $("#medico_cod1").html(html);
  });
};
var guardayeditarRecetas = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#Recetas_form")[0]);
  /*
  var receta_cod = document.getElementById("receta_cod").value;
  console.log(receta_cod);
  if (receta_cod === undefined || receta_cod === "") {
    url = "../../controllers/recetas.controller.php?op=insertar";
  } else {
    url = "../../controllers/recetas.controller.php?op=actualizar";
  }*/
  //for (var pair of form_Data.entries()) {
  // console.log(pair[0] + ", " + pair[1]);
  //}
  //var form_data = new FormData($("#usuarios_form")[0]);
  url = "../../controllers/recetas.controller.php?op=actualizar";
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    //cache: false,
    success: (respuesta) => {
      respuesta = JSON.parse(respuesta);
      //console.log(respuesta);
      if (respuesta === "ok") {
        Swal.fire("RECETAS", "fue despachado con éxito", "success");
        //limpiar();
        cargaTablaRoles();
        //cargaTablaUsuarios();
      } else {
        Swal.fire("RECETAS", "OCURRIO UN PROBLEMA AL GUARDAR", "danger");
        //alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (receta_cod) => {
  $.post(
    "../../controllers/recetas.controller.php?op=uno",
    {
      receta_cod: receta_cod,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#receta_cod").val(res.receta_cod);
      $("#paciente_apel").val(res.paciente_apel);
      $("#receta_fec").val(res.receta_fec);
      $("#receta_pres").val(res.receta_pres);
      $("#receta_indi").val(res.receta_indi);
      $("#receta_est").val("DESPACHADO");
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Despachar Recetas";
  $("#modalRecetas").modal("show");
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
        "../../controllers/historial.controller.php?op=eliminar",
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

var limpiar = () => {
  document.getElementById("receta_cod").value = "";
  document.getElementById("receta_pres").value = "";
  $("#receta_indi").val("");
  //$("#historial_trat").val("");

  $("#modalRecetas").modal("hide");
};
init();
