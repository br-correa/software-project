<?php
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'lavar':
            header("Location: tela-agendar-servico.php");
            break;
        case 'passar':
            header("Location: tela-agendar-servico.php");
            break;
        case 'limpar':
            header("Location: tela-agendar-servico.php");
            break;
        default:
            // Se a ação não for reconhecida, você pode redirecionar para uma página de erro ou fazer algo diferente.
            break;
    }
}
?>
