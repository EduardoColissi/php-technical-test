$(document).ready(function () {
  function loadUsers() {
    $.ajax({
      url: "load",
      method: "GET",
      success: function (response) {
        $("#usersTable tbody").empty();
        response.forEach(function (user) {
          $("#usersTable tbody").append(`
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.status}</td>
            <td>${user.admission_date}</td>
            <td>${user.updated}</td>
            <td>${user.created}</td>
            <td>
              <a class="btn btn-primary button btn-edit-user" data-toggle="modal" data-target="#customModal" data-userid="${user.id}">
                <span class="iconify" data-icon="mdi:pencil" data-inline="false"></span>
              </a>
              <a class="btn btn-danger button btn-delete-user" data-userid="${user.id}">
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
        console.log(xhr.responseText);
      },
    });
  }

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
    $.ajax({
      url: "delete/" + userId,
      method: "DELETE",
      success: function (response) {
        loadUsers();
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
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
                loadUsers();
              },
              error: function (xhr, status, error) {
                console.log(xhr.responseText);
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
                loadUsers();
              },
              error: function (xhr, status, error) {
                console.log(xhr.responseText);
              },
            });
          });
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
    });
  }
});