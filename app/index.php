<?php
require_once "conexao.php";

$sql = "SELECT * FROM contatos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agenda de Contatos</title>

    <div class="alert alert-info d-flex justify-content-between align-items-center">

    <div>
        <strong><i class="bi bi-hdd-network"></i> Servidor:</strong>
        <?= gethostname(); ?>
    </div>

    <div>
        <strong><i class="bi bi-server"></i> IP Privado:</strong>
        <?= $_SERVER['SERVER_ADDR']; ?>
    </div>

</div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h2 class="mb-0">
                                <i class="bi bi-person-lines-fill"></i>
                                Agenda de Contatos
                            </h2>

                            <small class="text-white">
                                Cadastro de clientes
                            </small>

                        </div>

                        <span class="badge bg-light text-primary fs-6">

                            <?= $resultado->num_rows ?>

                            contato(s)

                        </span>

                    </div>

                </div>

                <div class="card-body">

                    <form action="salvar.php" method="POST">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-person-fill"></i> Nome
                                </label>

                                <input
                                    type="text"
                                    name="nome"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-telephone-fill"></i> Telefone
                                </label>

                                <input
                                    type="text"
                                    name="telefone"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-envelope-fill"></i> E-mail
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control">

                            </div>

                        </div>

                        <button
                            class="btn btn-success"
                            type="submit">

                            <i class="bi bi-plus-circle"></i> Adicionar Contato

                        </button>

                    </form>

                </div>

            </div>

            <div class="card mt-4 shadow">

                <div class="card-header bg-dark text-white">

                    <h4 class="mb-0">Contatos Cadastrados</h4>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                    <div class="mb-3">
                        <input
                            id="pesquisa"
                            class="form-control"
                            placeholder="🔍 Pesquisar contato...">
                    </div>

                        <table class="table table-hover align-middle">

                            <thead class="table-primary">

                            <tr>

                                <th>Nome</th>

                                <th>Telefone</th>

                                <th>E-mail</th>

                                <th width="120">Ações</th>

                            </tr>

                            </thead>

                            <tbody>

                            <?php if ($resultado->num_rows > 0): ?>

                                <?php while ($contato = $resultado->fetch_assoc()): ?>

                                    <tr>

                                        <td><?= htmlspecialchars($contato['nome']); ?></td>

                                        <td><?= htmlspecialchars($contato['telefone']); ?></td>

                                        <td><?= htmlspecialchars($contato['email']); ?></td>

                                        <td>

                                            <a
                                                href="excluir.php?id=<?= $contato['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Deseja excluir este contato?');">

                                                <i class="bi bi-trash3-fill"></i>

                                            </a>

                                        </td>

                                    </tr>

                                <?php endwhile; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="4" class="text-center">

                                        Nenhum contato cadastrado.

                                    </td>

                                </tr>

                            <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
const telefone = document.querySelector('input[name="telefone"]');

telefone.addEventListener('input', function () {

    let valor = this.value.replace(/\D/g, '');

    if (valor.length > 11)
        valor = valor.substring(0,11);

    valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
    valor = valor.replace(/(\d{5})(\d)/, '$1-$2');

    this.value = valor;
});

const pesquisa = document.getElementById('pesquisa');

pesquisa.addEventListener('keyup', function () {

    const valor = this.value.toLowerCase();

    document.querySelectorAll('tbody tr').forEach(function(linha){

        linha.style.display =
            linha.innerText.toLowerCase().includes(valor)
            ? ''
            : 'none';

    });

});
</script>

</body>

</html>