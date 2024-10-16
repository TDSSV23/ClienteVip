<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Captura de Leads</h1>
        <form method="post" action="processa_lead.php">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="empresa" placeholder="Empresa" required>
            </div>
            <div class="form-group mb-3">
                <textarea class="form-control" name="mensagem" placeholder="Mensagem" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>