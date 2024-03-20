//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarSignos(e);
  });
}
$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    "../../controllers/aportaciones.controller.php?op=todos",
    (listasignos) => {
      listasignos = JSON.parse(listasignos);
      $.each(listasignos, (index, signos) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${signos.nombres}</td>` +
          `<td>${signos.fecha}</td>` +
          `<td>${signos.aporte}</td>` +
          `<td>${signos.descripcion}</td>` +
  
 
          `<td>` +
          `<button title='Modificar Datos' class='btn btn-success no-imprimir' onclick='uno(${signos.id_aportes})'><i class="fa-solid fa-pen-to-square"></i></button>` +
          `<button title='Eliminar Registro' class='btn btn-danger no-imprimir' onclick='eliminar(${signos.id_aportes})'><i class="fa-solid fa-trash"></i></button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
var cargaSelectSocios = () => {
  var html = ' <option value="0">Seleccione un Socio </option>';
  $.post("../../controllers/socios.controller.php?op=todos", (listasocios) => {
    listasocios = JSON.parse(listasocios);
    $.each(listasocios, (index, socios) => {
      html += `<option value="${socios.Cedula_socio}">${socios.Nombres_socio}</option>`;
    });
    $("#paciente_ced").html(html);
  });
};

document.addEventListener("DOMContentLoaded", cargaSelectSocios);
var guardayeditarSignos = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var signos_cod = document.getElementById("signos_cod").value;
  console.log(signos_cod);
  if (signos_cod === undefined || signos_cod === "") {
    url = "../../controllers/aportaciones.controller.php?op=insertar";
  } else {
    url = "../../controllers/aportaciones.controller.php?op=actualizar";
  }

  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      respuesta = JSON.parse(respuesta);
      console.log(respuesta);
      if (respuesta == "ok") {
        Swal.fire("Signos Vitales", "Se guardo con éxito", "success");
        limpiar();
        cargaTablaRoles();
      } else {
        //alert("Ocurrio un error al guardar. " + respuesta);
        limpiar();
        cargaTablaRoles();
      }
    },
  });
};

var uno = (id_aportes) => {
  $.post(
    "../../controllers/aportaciones.controller.php?op=uno",
    {
      id_aportes: id_aportes,
    },
    (res) => {
      //console.log(res);
      res = JSON.parse(res);
      $("#id_aportes").val(res.nombes);
      $("#id_socio").val(res.fecha);
      $("#fecha_aportes").val(res.aportes);
      $("#Valor_aportes").val(res.descripcion);

    }
  );

  document.getElementById("titulModalUsuarios").innerHTML =
    "Editar Signos Vitales";
  $("#modalUsuarios").modal("show");
};

var eliminar = (signos_cod) => {
  Swal.fire({
    title: "SIGNOS VITALES",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/aportaciones.controller.php?op=eliminar",
        {
          signos_cod: signos_cod,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Signos Vitales", "Se eliminó con éxito", "success");
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
  document.getElementById("signos_cod").value = "";

  $("#signos_tem").val("");
  $("#signos_pre").val("");
  $("#signos_pes").val("");
  $("#signos_talla").val("");
  cargaTablaRoles();
  $("#modalUsuarios").modal("hide");
};
init();
