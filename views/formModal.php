
<div class="modal fade" id="customModal" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
    <input type="hidden" id="userId" name="userId"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customModalLabel"><?php echo $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="customForm">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Situação</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="0">Pendente</option>
                            <option value="1">Admitido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="admission_date">Data de Admissão</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
