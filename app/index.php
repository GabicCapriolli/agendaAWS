<?php
require_once "conexao.php";
$modoEdicao = false;
$contato = [
    'id' => '',
    'nome' => '',
    'telefone' => '',
    'email' => ''
];

if (isset($_GET['editar'])) {

    $id = (int) $_GET['editar'];

    $stmt = $conn->prepare("
        SELECT *
        FROM contatos
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultadoEdicao = $stmt->get_result();

    if ($resultadoEdicao->num_rows > 0) {

        $contato = $resultadoEdicao->fetch_assoc();

        $modoEdicao = true;

    }

    $stmt->close();

}

$sql = "SELECT * FROM contatos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agenda de Contatos</title>

    </div>

</div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container py-5">

    <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">

        <div>
            <strong><i class="bi bi-hdd-network"></i> Servidor:</strong>
            <?= gethostname(); ?>
        </div>

        <div>
            <strong><i class="bi bi-server"></i> IP Privado:</strong>
            <?= $_SERVER['SERVER_ADDR']; ?>
    </div>

</div>

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

                    <form action="<?= $modoEdicao ? 'atualizar.php' : 'salvar.php'; ?>" method="POST">
                        <?php if($modoEdicao): ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $contato['id']; ?>">

                        <?php endif; ?>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-person-fill"></i> Nome
                                </label>

                                <input
                                    type="text"
                                    name="nome"
                                    class="form-control"
                                    required
                                    value="<?= htmlspecialchars($contato['nome']); ?>">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-telephone-fill"></i> Telefone
                                </label>

                                <input
                                    type="text"
                                    name="telefone"
                                    class="form-control"
                                    value="<?= htmlspecialchars($contato['telefone']); ?>">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    <i class="bi bi-envelope-fill"></i> E-mail
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($contato['email']); ?>">

                            </div>

                        </div>

                        <button
                        class="btn <?= $modoEdicao ? 'btn-warning' : 'btn-success'; ?>"
                        type="submit">

                        <i class="bi <?= $modoEdicao ? 'bi-pencil-square' : 'bi-plus-circle'; ?>"></i>

                        <?= $modoEdicao ? 'Salvar Alterações' : 'Adicionar Contato'; ?>

                        </button>

                        <?php if($modoEdicao): ?>

                        <a
                        href="index.php"
                        class="btn btn-secondary">

                        Cancelar

                        </a>

                        <?php endif; ?>

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

                                <?php while ($linha = $resultado->fetch_assoc()): ?>

                                    <tr>

                                        <td><?= htmlspecialchars($linha['nome']); ?></td>

                                        <td><?= htmlspecialchars($linha['telefone']); ?></td>

                                        <td><?= htmlspecialchars($linha['email']); ?></td>

                                        <td>

                                            <div class="d-flex gap-2">

                                            <a
                                            href="index.php?editar=<?= $linha['id']; ?>"
                                            class="btn btn-warning btn-sm"
                                            title="Editar">

                                            <i class="bi bi-pencil-fill"></i>

                                            </a>

                                            <a
                                            href="excluir.php?id=<?= $linha['id']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Deseja excluir este contato?');"
                                            title="Excluir">

                                            <i class="bi bi-trash3-fill"></i>

                                            </a>

                                            </div>

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
