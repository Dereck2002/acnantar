//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarMedico(e);
  });
}

$().ready(() => {
  cargaTablaUsuarios();
});
var cargaTablaUsuarios = () => {
  var html = "";
  $.post("../../controllers/medico.controller.php?op=todos", (listamedico) => {
    listamedico = JSON.parse(listamedico);
    $.each(listamedico, (index, medico) => {
      html +=
        `<tr>` +
        `<td>${index + 1}</td>` +
        `<td>${medico.medico_cod}</td>` +
        `<td>${medico.medico_ape}</td>` +
        `<td>${medico.medico_esp}</td>` +
        `<td>${medico.medico_tel}</td>` +
        `<td>${medico.medico_cor}</td>` +
        `<td>` +
        `<button class='btn btn-success no-imprimir' onclick='uno(${medico.medico_cod})'><i class="fa-solid fa-pen-to-square"></i></button>` +
        `<button class='btn btn-danger no-imprimir' onclick='eliminar(${medico.medico_cod})'><i class="fa-solid fa-trash"></i></button>` +
        `</td>` +
        `</tr>`;
    });
    $("#TablaUsuarios").html(html);
  });
};

var guardayeditarMedico = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var medico_cod = document.getElementById("bandera").value;
  if (medico_cod === undefined || medico_cod === "") {
    url = "../../controllers/medico.controller.php?op=actualizar";
  } else {
    url = "../../controllers/medico.controller.php?op=insertar";
  }

  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        alert("Se guardo con exito");
        limpiar();
        cargaTablaUsuarios();
      } else {
        alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (medico_cod) => {
  $.post(
    "../../controllers/medico.controller.php?op=uno",
    {
      medico_cod: medico_cod,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#medico_cod").val(res.medico_cod);
      $("#medico_ape").val(res.medico_ape);

      $("#medico_esp").val(res.medico_esp);
      $("#medico_tel").val(res.medico_tel);
      $("#medico_cor").val(res.medico_cor);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Editar Medicos";
  $("#modalUsuarios").modal("show");
};
var eliminar = (medico_cod) => {
  Swal.fire({
    title: "MEDICOS",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/medico.controller.php?op=eliminar",
        {
          medico_cod: medico_cod,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Medico", "Se eliminó con éxito", "success");
            limpiar();
            cargaTablaUsuarios();
          } else {
            Swal.fire("Medico", "NO Se eliminó", "success");
          }
        }
      );
    }
  });
};

var limpiar = () => {
  document.getElementById("medico_cod").value = "";

  $("#medico_ape").val("");
  $("#medico_esp").val("");
  $("#medico_tel").val("");
  $("#medico_cor").val("");
  $("#modalUsuarios").modal("hide");
};

init();
function verificarCedulaEcuador(cedula) {
  if (
    typeof cedula == "string" &&
    cedula.length == 10 &&
    /^\d+$/.test(cedula)
  ) {
    var digitos = cedula.split("").map(Number);
    var codigo_provincia = digitos[0] * 10 + digitos[1];

    //if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30) && digitos[2] < 6) {

    if (
      codigo_provincia >= 1 &&
      (codigo_provincia <= 24 || codigo_provincia == 30)
    ) {
      var digito_verificador = digitos.pop();

      var digito_calculado =
        digitos.reduce(function (valorPrevio, valorActual, indice) {
          return (
            valorPrevio -
            ((valorActual * (2 - (indice % 2))) % 9) -
            (valorActual == 9) * 9
          );
        }, 1000) % 10;
      return digito_calculado === digito_verificador;
    }
  }
  return false;
}

var repetido = () => {
  var medico_cod = document.getElementById("medico_cod").value;
  $.post(
    "../../controllers/medico.controller.php?op=repetido",
    { medico_cod: medico_cod },
    (datos) => {
      datos = JSON.parse(datos);

      if (parseInt(datos.codigomed) > 0) {
        $("#mensaje").removeClass("d-none");
        $("#mensaje").html("Medico ya existe");
        $("button[type='submit']").prop("disabled", true);
        //console.log("La cédula no es válida");
        //document.getElementById("mensaje").innerHTML =
        //("Atención: Medico ya existe");
        document.getElementById("medico_cod").value = "";
        document.getElementById("medico_cod").focus();
      } else {
        $("#mensaje").addClass("d-none");
        $("button[type='submit']").prop("disabled", false);
      }
    }
  );
};
var imprimirJavascript = () => {
  var contenidoImprimir = document.getElementById("Impresion").innerHTML;
  var contenidoOriginal = document.body.innerHTML;
  document.body.innerHTML = contenidoImprimir;
  window.print();
  document.body.innerHTML = contenidoOriginal;
};
function validarCedula(cedula) {
  var esValida = verificarCedulaEcuador(cedula);
  console.log(esValida);
  if (!esValida) {
    console.log("La cédula no es válida");
    document.getElementById("mensaje").innerHTML =
      "Error: Digite cedula correcta";
    document.getElementById("medico_cod").value = "";
    document.getElementById("medico_cod").focus();
  } else {
    document.getElementById("mensaje").innerHTML = "";
  }
}
