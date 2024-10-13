function enviarNotificacao(mensagem) {
    console.log("Tentando enviar notificação:", mensagem);
    if (Notification.permission === "granted") {
        new Notification(mensagem);
        console.log("Notificação enviada:", mensagem);
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                new Notification(mensagem);
                console.log("Notificação enviada após permissão:", mensagem);
            } else {
                console.log("Permissão negada para notificações.");
            }
        });
    } else {
        console.log("Notificação não enviada. Permissão negada.");
    }
}

// Função para verificar registros pendentes
function verificarRegistrosPendentes() {
    fetch('http://localhost/gestaoDeTarefas-master/src/backend/controllers/notification.php', { method: 'GET' })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na resposta da rede');
            }
            return response.json();
        })
        .then(data => {
            console.log("Dados recebidos:", data);
            if (data.length > 0) {
                data.forEach(registro => {
                    enviarNotificacao(`Registro pendente: ${registro.titulo}`);
                });
            } else {
                console.log("Nenhum registro pendente encontrado.");
            }
        })
        .catch(error => console.error('Erro ao buscar registros:', error));
}
// Opcional: Executa a verificação imediatamente quando a página carrega
verificarRegistrosPendentes();

// Executa a verificação periodicamente a cada 1 minuto (60000 ms)
// setInterval(verificarRegistrosPendentes, 60000);

// Exemplo dentro do Service Worker
self.addEventListener('push', function(event) {
    const data = event.data.json();
    const options = {
        body: data.body,
        icon: '/path/to/icon.png',
        badge: '/path/to/badge.png',
        actions: [
            {action: 'open', title: 'Ver detalhes'}
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();

    if (event.action === 'open') {
        clients.openWindow('/tasks');  // Abre a URL associada
    }
});


