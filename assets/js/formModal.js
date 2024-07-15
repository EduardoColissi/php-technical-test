$(document).ready(function () {
  function formatDateTime(dateTime, format = "datetime") {
    if (dateTime.length === 10) {
      dateTime += "T00:00:00";
    }

    const dateTimeObj = new Date(dateTime);
    let formatedDate = "";

    formatedDate += String(dateTimeObj.getDate()).padStart(2, "0") + "/";
    formatedDate += String(dateTimeObj.getMonth() + 1).padStart(2, "0") + "/";
    formatedDate += dateTimeObj.getFullYear();

    if (format === "datetime") {
      formatedDate += " ";
      formatedDate += String(dateTimeObj.getHours()).padStart(2, "0") + ":";
      formatedDate += String(dateTimeObj.getMinutes()).padStart(2, "0") + ":";
      formatedDate += String(dateTimeObj.getSeconds()).padStart(2, "0");
    }

    return formatedDate;
  }

  function loadUsers(name = "", email = "") {
    $.ajax({
      url: "load",
      data: { name: name, email: email },
      method: "GET",
      success: function (response) {
        $("#usersTable tbody").empty();
        response.forEach(function (user) {
          $("#usersTable tbody").append(`
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.status == 0 ? "Pendente" : "Admitido"}</td>
            <td>${formatDateTime(user.admission_date, "date")}</td>
            <td>${formatDateTime(user.updated)}</td>
            <td>${formatDateTime(user.created)}</td>
            <td>
              <a class="btn btn-success button btn-edit-user" data-toggle="modal" data-target="#customModal" data-userid="${
                user.id
              }">
                <span class="iconify" data-icon="mdi:pencil" data-inline="false"></span>
              </a>
              <a class="btn btn-danger button btn-delete-user" data-userid="${
                user.id
              }">
                <span class="iconify" data-icon="mdi:trash" data-inline="false"></span>
              </a>
              <a class="btn btn-warning button">
                <span class="iconify" data-icon="mdi:eye" data-inline="false"></span>
              </a>
            </td>
          </tr>
        `);
        });
      },
      error: function (xhr, status, error) {
        Swal.fire("Erro na requisição!", error, "error");
      },
    });
  }

  $("#searchButton").on("click", function () {
    var name = $("#searchName").val();
    var email = $("#searchEmail").val();
    loadUsers(name, email);
  });

  $("#cleanSearchButton").on("click", function () {
    $("#searchName").val("");
    $("#searchEmail").val("");
    loadUsers();
  });

  $(document).on("click", "#btnAddUser", function () {
    loadUser();
  });

  $(document).on("click", ".btn-edit-user", function () {
    var userId = $(this).data("userid");
    loadUser(userId);
  });

  $(document).on("click", ".btn-delete-user", function () {
    var userId = $(this).data("userid");
    deleteUser(userId);
  });

  function deleteUser(userId) {
    Swal.fire({
      title: "Tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Deletar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "delete/" + userId,
          method: "DELETE",
          success: function (response) {
            Swal.fire("Deletado!", "O usuário foi deletado.", "success");
            loadUsers();
          },
          error: function (xhr, status, error) {
            Swal.fire("Erro na requisição!", error, "error");
          },
        });
      }
    });
  }

  function loadUser(userId = null) {
    $("#customForm").off("submit");

    $.ajax({
      url: "loadById/" + userId,
      method: "GET",
      success: function (response) {
        console.log("user", response);

        if (response == null) {
          $("#customModalLabel").text("Adicionando novo usuário");

          $("#customForm").on("submit", function (event) {
            event.preventDefault();
            $.ajax({
              url: "create",
              method: "POST",
              data: $(this).serialize(),
              success: function (response) {
                $("#customModal").modal("hide");
                $("#customForm")[0].reset();
                Swal.fire(
                  "Cadastrado!",
                  "O usuário foi cadastrado.",
                  "success"
                );
                loadUsers();
              },
              error: function (xhr, status, error) {
                Swal.fire("Erro na requisição!", error, "error");
              },
            });
          });
        } else {
          $("#customModalLabel").text("Editando usuário " + response.id);
          $("#name").val(response.name);
          $("#email").val(response.email);
          $("#status").val(response.status);
          $("#admission_date").val(response.admission_date);
          $("#customForm").on("submit", function (event) {
            event.preventDefault();
            $.ajax({
              url: "update/" + userId,
              method: "PUT",
              data: $(this).serialize(),
              success: function (response) {
                $("#customModal").modal("hide");
                $("#customForm")[0].reset();
                Swal.fire("Editado!", "O usuário foi editado.", "success");
                loadUsers();
              },
              error: function (xhr, status, error) {
                Swal.fire("Erro na requisição!", error, "error");
              },
            });
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire("Erro na requisição!", error, "error");
      },
    });
  }
});
