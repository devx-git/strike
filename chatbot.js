const chatbotIcon = document.getElementById("chatbot-icon");
const chatbotBox = document.getElementById("chatbot-box");
const closeChat = document.getElementById("close-chat");
const sendChat = document.getElementById("send-chat");
const chatInput = document.getElementById("chat-input");
const chatLog = document.getElementById("chat-log");

let userName = "Usuario";

// Mostrar chat
chatbotIcon.onclick = () => {
    chatbotBox.style.display = "block";
    chatbotIcon.style.display = "none";
    addMessage("bot", "¡Hola! ¿En qué puedo ayudarte hoy?");
};

// Cerrar chat
closeChat.onclick = () => {
    chatbotBox.style.display = "none";
    chatbotIcon.style.display = "block";
};

// Enviar mensaje
sendChat.onclick = () => {
    const userMessage = chatInput.value.trim();
    if (!userMessage) return;
    addMessage("user", userMessage);
    saveMessageToDB(userName, userMessage);
    respondToUser(userMessage);
    chatInput.value = "";
};

// Añadir mensaje
function addMessage(sender, message) {
    const msg = document.createElement("div");
    msg.innerHTML = `<strong>${sender === "bot" ? "Bot" : userName}:</strong> ${message}`;
    chatLog.appendChild(msg);
    chatLog.scrollTop = chatLog.scrollHeight;
}

// Lógica de respuesta
function respondToUser(msg) {
    let response = "";
    msg = msg.toLowerCase();

    if (msg.includes("hola") || msg.includes("buenas")) {
        response = "¡Hola! ¿Cómo puedo ayudarte con tus inversiones?";
    } else if (msg.includes("precio") || msg.includes("plan")) {
        response = "Tenemos planes adaptados a tus necesidades. ¿Quieres que un asesor te contacte?";
    } else if (msg.includes("gracias") || msg.includes("ok")) {
        response = "De nada 😊. ¿Hay algo más en lo que pueda ayudarte?";
    } else if (msg.includes("asesor") || msg.includes("contacto") || msg.includes("ayuda")){
        response = "Entiendo, ¿puedes darme más detalles?";
    } else {
        botMessage = "Ya has interactuado bastante conmigo 🤖. Ahora te paso con un asesor.<br><a href='https://wa.me/99440708446' target='_blank'>Contactar por WhatsApp</a>";
            }

    setTimeout(() => {
        addMessage("bot", response);
    }, 800);
}

// Guardar en la base de datos
function saveMessageToDB(userName, userMessage) {
    fetch("save_message.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ user_name: userName, message: userMessage })
    })
    .then(res => res.text())
    .then(data => console.log(data))
    .catch(err => console.error("Error:", err));
}
