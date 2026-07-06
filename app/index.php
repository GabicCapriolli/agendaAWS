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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h2 class="mb-0">Agenda de Contatos</h2>

                </div>

                <div class="card-body">

                    <form action="salvar.php" method="POST">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">Nome</label>

                                <input
                                    type="text"
                                    name="nome"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">Telefone</label>

                                <input
                                    type="text"
                                    name="telefone"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label">E-mail</label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control">

                            </div>

                        </div>

                        <button
                            class="btn btn-success"
                            type="submit">

                            Salvar Contato

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

                        <table class="table table-hover align-middle">

                            <thead class="table-primary">

                            <tr>

                                <th>ID</th>

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

                                        <td><?= $contato['id']; ?></td>

                                        <td><?= htmlspecialchars($contato['nome']); ?></td>

                                        <td><?= htmlspecialchars($contato['telefone']); ?></td>

                                        <td><?= htmlspecialchars($contato['email']); ?></td>

                                        <td>

                                            <a
                                                href="excluir.php?id=<?= $contato['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Deseja excluir este contato?');">

                                                Excluir

                                            </a>

                                        </td>

                                    </tr>

                                <?php endwhile; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="5" class="text-center">

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

</body>

</html>