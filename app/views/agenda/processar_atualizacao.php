<?php

use App\Models\AgendaModel;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupere os dados do formulário
    $id_agendamento = $_POST['id_agendamento'];
    $data_agend = $_POST['data_agend'];
    $horario = $_POST['horario'];
    $usuario_id = $_POST['usuario_id'];
    $pet_id = $_POST['pet_id'];
    $servicos = $_POST['servicos'];

    // Crie uma instância da classe AgendaModel
    $agenda = new AgendaModel($db);
    $agenda->__set("id_agendamento", $id_agendamento);
    $agenda->__set("data_agend", $data_agend);
    $agenda->__set("horario", $horario);
    $agenda->__set("usuario_id", $usuario_id);
    $agenda->__set("pet_id", $pet_id);
    $agenda->__set("servicos", $servicos);

    // Tente atualizar o agendamento
    if ($agenda->atualizar_agenda()) {
        echo "Agendamento atualizado com sucesso!";
    } else {
        echo "Falha na atualização do agendamento.";
    }
} else {
    echo "Acesso inválido.";
}
?>
