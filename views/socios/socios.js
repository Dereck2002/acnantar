//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarSocios(e);
  });
}

$().ready(() => {
  cargaTablaUsuarios();
});
var cargaTablaUsuarios = () => {
  var html = "";
  $.post("../../controllers/socios.controller.php?op=todos", (listamedico) => {
    listapaciente = JSON.parse(listamedico);
    $.each(listapaciente, (index, pacientes) => {
      html +=
        `<tr>` +
        `<td>${index + 1}</td>` +
        `<td>${pacientes.Cedula_socio}</td>` +
        `<td>${pacientes.Nombres_socio}</td>` +
        `<td>${pacientes.Fecha_nacimiento_socio}</td>` +
        `<td>${pacientes.Telefono_socio}</td>` +
        `<td>${pacientes.Direccion_socio}</td>` +
        `<td>${pacientes.Ocupacion_socio}</td>` +
        `<td>${pacientes.Fecha_ingreso_socio}</td>` +
        `<td>` +
        `<button title='Modificar Datos de Paciente' class='btn btn-success' onclick='uno(${pacientes.Cedula_socio})'><i class="fa-solid fa-pen-to-square"></i></button>` +
        `<button title='Eliminar Registro' class='btn btn-danger' onclick='eliminar(${pacientes.Cedula_socio})'><i class="fa-solid fa-trash"></i></button>` +
        `</td>` +
        `</tr>`;
    });
    $("#TablaUsuarios").html(html);
  });
};

var repetido = () => {
  var paciente_ced = document.getElementById("paciente_ced").value;
  $.post(
    "../../controllers/pacientes.controller.php?op=repetido",
    { paciente_ced: paciente_ced },
    (datos) => {
      datos = JSON.parse(datos);

      if (parseInt(datos.codigopac) > 0) {
        $("#mensaje").removeClass("d-none");
        $("#mensaje").html("El Paciente ya existe");
        $("button[type='submit']").prop("disabled", true);

        document.getElementById("paciente_ced").value = "";
        document.getElementById("paciente_ced").focus();
      } else {
        $("#mensaje").addClass("d-none");
        $("button[type='submit']").prop("disabled", false);
      }
    }
  );
};

var guardayeditarSocios = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  //var input = document.getElementById("paciente_ced");
  //input.removeAttribute("disabled");
  var Cedula_socio = document.getElementById("bandera").value;

  if (Cedula_socio === undefined || Cedula_socio === "") {
    url = "../../controllers/socios.controller.php?op=actualizar";
  } else {
    url = "../../controllers/socios.controller.php?op=insertar";
    //
  }

  /*for (var pair of form_Data.entries()) {
      console.log(pair[0] + ", " + pair[1]);*/

  //var form_data = new FormData($("#usuarios_form")[0]);
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      //console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        Swal.fire("EL SOCIO", "Se guardo con éxito", "success");
        //alert("Se guardo con exito");
        limpiar();
        cargaTablaUsuarios();
      } else {
        alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (Cedula_socio) => {
  $.post(
    "../../controllers/socios.controller.php?op=uno",
    {
      Cedula_socio: Cedula_socio,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);

      $("#Id_socio").val(res.Id_socio);
      $("#Cedula_socio").val(res.Cedula_socio);
      $("#Nombres_socio").val(res.Nombres_socio);
      $("#Fecha_nacimiento_socio").val(res.Fecha_nacimiento_socio);
      $("#Telefono_socio").val(res.Telefono_socio);
      $("#Direccion_socio").val(res.Direccion_socio);
      $("#Email_socio").val(res.Email_socio);
      $("#Ocupacion_socio").val(res.Ocupacion_socio);
      $("#Fecha_ingreso_socio").val(res.Fecha_ingreso_socio);
    }
  );
  document.getElementById("titulModalUsuarios").innerHTML = "Editar Socios";
  $("#Cedula_socio").addClass("d-none");

  $("#modalUsuarios").modal("show");
};

var eliminar = (Cedula_socio) => {
  Swal.fire({
    title: "SOCIOS",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/socios.controller.php?op=eliminar",
        {
          Cedula_socio: Cedula_socio,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            cargaTablaUsuarios();
            Swal.fire("Socios", "Se eliminó con éxito", "success");
            limpiar();
            cargaTablaUsuarios();
          } else {
            Swal.fire("Socios", "NO Se eliminó", "success");
          }
        }
      );
    }
  });
};

var limpiar = () => {
  document.getElementById("paciente_ced").value = "";
  document.getElementById("paciente_apel").value = "";
  $("#paciente_fnac").val("");
  $("#paciente_gen").val("");
  $("#paciente_tel").val("");
  $("#paciente_cor").val("");
  $("#paciente_dom").val("");

  $("#paciente_ced").removeClass("d-none");

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
    //console.log("La cédula no es válida");
    //alert("La cédula ingresada no es válida");
    document.getElementById("mensaje").innerHTML =
      "Error: Digite cedula correcta";
    document.getElementById("paciente_ced").value = "";
    document.getElementById("paciente_ced").focus();
  } else {
    document.getElementById("mensaje").innerHTML = "";
  }
}
