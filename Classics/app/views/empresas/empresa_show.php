<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Classics • Dados da Empresa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php require __DIR__ . '/../partials/head.php'; ?>
</head>

<body>
<?php require __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container cl-page">

        <?php if (isset($empresa)): ?>
            <?php
            $empresaPropria = !empty($empresa_propria);
            $nomeEmpresa = (string) ($empresa['Name'] ?? $empresa['nome'] ?? '');
            $emailEmpresa = (string) ($empresa['Email'] ?? $empresa['email'] ?? '');
            $localizacaoEmpresa = (string) ($empresa['Localizacao'] ?? $empresa['localizacao'] ?? '');
            $statusCadastro = strtolower(trim((string) ($empresa['Status'] ?? '')));

            // RN02: a própria empresa vê a situação do cadastro enquanto não estiver aprovada
            $avisosStatus = [
                'pendente' => ['warning', 'bi-hourglass-split', 'Seu cadastro está em análise.', 'Assim que o administrador aprovar, você poderá cadastrar atividades e receber agendamentos.'],
                'rejeitada' => ['danger', 'bi-x-circle', 'Seu cadastro foi rejeitado.', 'Sua empresa não pode publicar atividades na plataforma.'],
                'suspensa' => ['danger', 'bi-pause-circle', 'Sua empresa está suspensa.', 'Suas atividades não aparecem no catálogo e não recebem agendamentos enquanto a suspensão durar.']
            ];
            ?>
            <a href="<?= URL_BASE ?>/" class="cl-back-link">
                <i class="bi bi-arrow-left"></i> Voltar para o início
            </a>

            <?php if ($empresaPropria && isset($avisosStatus[$statusCadastro])): ?>
                <?php $aviso = $avisosStatus[$statusCadastro]; ?>
                <div class="alert alert-<?= $aviso[0] ?> d-flex gap-3 align-items-start" role="alert">
                    <i class="bi <?= $aviso[1] ?> fs-4"></i>
                    <div>
                        <strong><?= htmlspecialchars($aviso[2], ENT_QUOTES, 'UTF-8') ?></strong>
                        <div class="small"><?= htmlspecialchars($aviso[3], ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <h1 class="h3 mb-1"><?= htmlspecialchars($nomeEmpresa, ENT_QUOTES, 'UTF-8') ?></h1>
                            <p class="text-muted small mb-0"><?= htmlspecialchars($emailEmpresa, ENT_QUOTES, 'UTF-8') ?></p>

                            <?php if ($empresaPropria): ?>
                                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                                    <a href="<?= URL_BASE ?>/empresa/editar" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Editar perfil
                                    </a>
                                    <?php if ($statusCadastro === 'aprovada'): ?>
                                        <a href="<?= URL_BASE ?>/empresa/atividades" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-grid"></i> Minhas atividades
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h2 class="h4 mb-4">Informações da empresa</h2>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="cl-info-tile">
                                        <i class="bi bi-envelope"></i>
                                        <div><small>E-mail</small><?= htmlspecialchars($emailEmpresa, ENT_QUOTES, 'UTF-8') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cl-info-tile">
                                        <i class="bi bi-building"></i>
                                        <div><small>CNPJ</small><?= htmlspecialchars(\app\helpers\Formatador::cnpj($empresa['CNPJ'] ?? $empresa['cnpj'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cl-info-tile">
                                        <i class="bi bi-telephone"></i>
                                        <div><small>Telefone</small><?= htmlspecialchars(\app\helpers\Formatador::telefone($empresa['Telefone'] ?? $empresa['telefone'] ?? ''), ENT_QUOTES, 'UTF-8') ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="cl-info-tile">
                                        <i class="bi bi-geo-alt"></i>
                                        <div><small>Localização</small><?= htmlspecialchars($localizacaoEmpresa !== '' ? $localizacaoEmpresa : '-', ENT_QUOTES, 'UTF-8') ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> Empresa não encontrada.
                <div class="mt-3">
                    <a href="<?= URL_BASE ?>/" class="btn btn-warning">Voltar para o início</a>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>