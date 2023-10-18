
document.addEventListener("DOMContentLoaded", function () {
    const chatMessages = document.getElementById("chat-messages");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");

    sendButton.addEventListener("click", () => {
        const userMessage = userInput.value;
        displayUserMessage(userMessage);
        userInput.value = ""; // Clear the input field

        sendMessageToGPT(userMessage)
            .then((response) => {
                const aiMessage = response.data.choices[0].text;
                displayAIMessage(aiMessage);
            })
            .catch((error) => {
                console.error("Erro ao enviar mensagem para o GPT-3.5 Turbo:", error);
            });
    });

    function displayUserMessage(message) {
        const li = document.createElement("li");
        li.className = "user-message";
        li.textContent = message;
        chatMessages.appendChild(li);
    }

    function displayAIMessage(message) {
        const li = document.createElement("li");
        li.className = "ai-message";
        li.textContent = message;
        chatMessages.appendChild(li);
    }

    function sendMessageToGPT(message) {
        const apiKey = "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"; // Substitua pelo seu próprio API Key
        const apiUrl = "https://api.openai.com/v1/engines/gpt-3.5-turbo/completions";
        const headers = {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${apiKey}`,
        };
        const data = {
            prompt: message,
            max_tokens: 50,
        };

        return axios.post(apiUrl, data, { headers: headers });
    }
});
