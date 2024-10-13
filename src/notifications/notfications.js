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

if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker.ready.then(function(registration) {
        registration.pushManager.getSubscription().then(function(subscription) {
            if (subscription) {
                console.log('Usuário já está inscrito:', subscription);
                return;
            }

            registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array('sua-chave-publica') // Substitua pela sua chave pública VAPID
            }).then(function(newSubscription) {
                console.log('Usuário inscrito:', newSubscription);
                // Enviar a nova inscrição para o servidor para armazenar e enviar notificações
                enviarSubscriptionParaServidor(newSubscription);
            }).catch(function(error) {
                console.error('Falha na inscrição para push:', error);
            });
        });
    });
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

function enviarSubscriptionParaServidor(subscription) {
    // Enviar os dados da assinatura para o seu servidor para armazenar
    fetch('/store-subscription', {
        method: 'POST',
        body: JSON.stringify(subscription),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => console.log('Assinatura enviada para o servidor:', data))
      .catch(error => console.error('Erro ao enviar assinatura para o servidor:', error));
}
