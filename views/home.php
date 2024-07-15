
<link href="assets/css/home.css"  rel="stylesheet">
<div class="container">
    <div class="row title-container">
        <div class="col-md-10">
            <h1><?php echo $title ?></h1>
        </div>
        <div class="col-md-2">
            <a id="btnAddUser" class="btn btn-success add-button" type="button" data-toggle="modal" data-target="#customModal">
                <span class="iconify" data-icon="mdi:plus" data-inline="false" data-width=20></span>
                Adicionar
            </a>
        </div>
    </div>
    
    <table class="table table-striped" id="usersTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Status</th>
                <th scope="col">Data de Admissão</th>
                <th scope="col">Última Modificação</th>
                <th scope="col">Data de Criação</th>
                <th scope="col" class="actions-collumn">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user){ ?>
                <tr>
                    <td scope="row"><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td><?php echo $user['admission_date']; ?></td>
                    <td><?php echo $user['updated']; ?></td>
                    <td><?php echo $user['created']; ?></td>
                    <td>
                        <a class="btn btn-primary button btn-edit-user" data-toggle="modal" data-target="#customModal" data-userid="<?php echo $user['id']; ?>">
                            <span class="iconify" data-icon="mdi:pencil" data-inline="false"></span>
                        </a>
                        <a class="btn btn-danger button btn-delete-user" data-userid="<?php echo $user['id']; ?>">
                            <span class="iconify" data-icon="mdi:trash" data-inline="false"></span>
                        </a>
                        <a class="btn btn-warning button">
                            <span class="iconify" data-icon="mdi:eye" data-inline="false"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>