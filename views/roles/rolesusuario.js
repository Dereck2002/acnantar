//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarUsuarios(e);
  });
}
$().ready(() => {
  cargaTablaRoles();
});
var cargaTablaRoles = () => {
  var html = "";
  $.post(
    //"../../controllers/usuario.controller.php?op=todos",
    "../../controllers/roles.controller.php?op=todos",
    (listaroles) => {
      listaroles = JSON.parse(listaroles);
      $.each(listaroles, (index, roles) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${roles.Detalle}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${roles.idRoles})'><i class="fa-solid fa-pen-to-square"></i></button>` +
          `<button class='btn btn-danger' onclick='eliminar(${roles.idRoles})'><i class="fa-solid fa-trash"></i></button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};
var cargaSelectRoles = () => {
  var html = ' <option value="0">Seleccione un tipo de usuario</option>';
  $.post("../../controllers/roles.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.idRoles}">${rol.Detalle}</option>`;
    });
    $("#idRoles").html(html);
  });
};
var guardayeditarUsuarios = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idRoles = document.getElementById("idRoles").value;
  if (idRoles === undefined || idRoles === "") {
    url = "../../controllers/roles.controller.php?op=insertar";
  } else {
    url = "../../controllers/roles.controller.php?op=actualizar";
  }
  //for (var pair of form_Data.entries()) {
  // console.log(pair[0] + ", " + pair[1]);
  //}
  //var form_data = new FormData($("#usuarios_form")[0]);
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
        Swal.fire("Tipos de Usuarios", "Se guardo con éxito", "success");
        limpiar();
        cargaTablaRoles();
        //cargaTablaUsuarios();
      } else {
        alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var uno = (idRoles) => {
  $.post(
    "../../controllers/Roles.controller.php?op=uno",
    {
      idRoles: idRoles,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idRoles").val(res.idRoles);
      $("#Detalle").val(res.Detalle);
    }
  );

  document.getElementById("titulModalUsuarios").innerHTML = "Editar Alumno";
  $("#modalUsuarios").modal("show");
};

var eliminar = (idRoles) => {
  Swal.fire({
    title: "TIPOS DE USUARIOS",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/roles.controller.php?op=eliminar",
        {
          idRoles: idRoles,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Roles", "Se eliminó con éxito", "success");
            limpiar();
            llenarTabla();
          }
        }
      );
    }
  });
};

var limpiar = () => {
  document.getElementById("idRoles").value = "";
  document.getElementById("Detalle").value = "";
  //$('#Apellidos').val('');
  //$('#coreo').val('');
  //$('#contrasenia').val('');
  //$('#idRoles').val('0');

  $("#modalUsuarios").modal("hide");
};
init();
