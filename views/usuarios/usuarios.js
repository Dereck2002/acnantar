//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html
function init() {
  $("#usuarios_form").on("submit", (e) => {
    guardayeditarUsuarios(e);
  });
}

$().ready(() => {
  cargaTablaUsuarios();
});
var cargaTablaUsuarios = () => {
  var html = "";
  $.post(
    "../../controllers/usuario.controller.php?op=todos",
    (listausuarios) => {
      listausuarios = JSON.parse(listausuarios);
      $.each(listausuarios, (index, usuario) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${usuario.Nombres}</td>` +
          `<td>${usuario.Apellidos}</td>` +
          `<td>${usuario.correo}</td>` +
          `<td>${usuario.Detalle}</td>` +
          `<td>` +
          `<button title='Modificar Datos' class='btn btn-success'onclick='uno(${usuario.idUsaurio})'><i class="fa-solid fa-pen-to-square"></i></button>` +
          `<button title='Eliminar Registro' class='btn btn-danger' onclick='eliminar(${usuario.idUsaurio})'><i class="fa-solid fa-trash"></i></button>` +
          `</td>` +
          `</tr>`;
      });
      $("#TablaUsuarios").html(html);
    }
  );
};

var cargaSelectRoles = () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/roles.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.idRoles}">${rol.Detalle}</option>`;
    });
    $("#idRoles").html(html);
  });
};

var uno = (idUsaurio) => {
  $.post(
    "../../controllers/usuario.controller.php?op=uno",
    {
      idUsaurio: idUsaurio,
    },
    (res) => {
      console.log(res);
      res = JSON.parse(res);
      $("#idUsaurio").val(res.idUsaurio);
      $("#Nombres").val(res.Nombres);
      $("#Apellidos").val(res.Apellidos);
      $("#contrasenia").val(res.contrasenia);
      $("#correo").val(res.correo);
    }
  );

  document.getElementById("titulModalUsuarios").innerHTML = "Editar Usuarios";
  $("#modalUsuarios").modal("show");
};

var guardayeditarUsuarios = (e) => {
  e.preventDefault();
  var url = "";
  var form_Data = new FormData($("#usuarios_form")[0]);
  var idUsaurio = document.getElementById("idUsaurio").value;
  if (idUsaurio === undefined || idUsaurio === "") {
    url = "../../controllers/usuario.controller.php?op=insertar";
  } else {
    url = "../../controllers/usuario.controller.php?op=actualizar";
  }
  //for (var pair of form_Data.entries()) {
  // console.log(pair[0] + ", " + pair[1]);
  //}
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
        alert("Se guardo con exito");
        limpiar();
        cargaTablaUsuarios();
      } else {
        alert("Ocurrio un error al guardar. " + respuesta);
      }
    },
  });
};

var eliminar = (idUsaurio) => {
  Swal.fire({
    title: "USUARIOS",
    text: "Esta seguro que desea eliminar...???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar!!!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/Usuario.controller.php?op=eliminar",
        {
          idUsaurio: idUsaurio,
        },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Usuario", "Se eliminó con éxito", "success");
            limpiar();
            cargaTablaUsuarios();
          } else {
            Swal.fire("Usuario", "NO Se eliminó", "success");
          }
        }
      );
    }
  });
};

var limpiar = () => {
  document.getElementById("idUsaurio").value = "";
  document.getElementById("Nombres").value = "";
  $("#Apellidos").val("");
  $("#correo").val("");
  $("#contrasenia").val("");
  $("#idRoles").val("0");

  $("#modalUsuarios").modal("hide");
};
init();
