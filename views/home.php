
<link href="assets/css/home.css"  rel="stylesheet">
<div class="container">
    <div class="row title-container mt-5">
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
    <div class="row customRow mt-3 mb-3">
        <input class="form-control col-md-4" type="text" id="searchName" placeholder="Procurar pelo nome">
        <input class="form-control col-md-4" type="text" id="searchEmail" placeholder="Procurar pelo e-mail">
        <button id="searchButton" class="btn btn-primary col-md-1">Buscar</button>
        <button id="cleanSearchButton" class="btn btn-primary col-md-1">Limpar</button>
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
                    <td><?php echo $user['status'] == 0 ? "Pendente" : "Admitido"; ?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d', $user['admission_date'])->format('d/m/Y'); ?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $user['updated'])->format('d/m/Y H:i:s'); ?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d H:i:s', $user['created'])->format('d/m/Y H:i:s'); ?></td>
                   
                    <td>
                        <a class="btn btn-success button btn-edit-user" data-toggle="modal" data-target="#customModal" data-userid="<?php echo $user['id']; ?>">
                            <span class="iconify" data-icon="mdi:pencil" data-inline="false"></span>
                        </a>
                        <a class="btn btn-danger button btn-delete-user" data-userid="<?php echo $user['id']; ?>">
                            <span class="iconify" data-icon="mdi:trash" data-inline="false"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>