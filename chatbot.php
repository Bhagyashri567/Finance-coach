<?php include 'navbar.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Financial Chatbot 💬</h2>

    <!-- Chat Window -->
    <div class="card glass p-4" style="height: 500px; display: flex; flex-direction: column;">
        <div id="chatWindow" class="flex-grow-1 overflow-auto mb-3 p-3 border rounded bg-light"
            style="max-height: 380px;">
            <!-- Chat messages will appear here -->
            <div class="text-muted small">🤖 Bot: Hi! I’m your finance assistant. Ask me about your savings, budgets, or
                goals.</div>
        </div>

        <!-- Input -->
        <div class="input-group">
            <input type="text" id="userInput" class="form-control" placeholder="Type your question..."
                onkeypress="if(event.key==='Enter'){sendMessage();}">
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

<script>
function sendMessage() {
    const input = document.getElementById("userInput");
    const chatWindow = document.getElementById("chatWindow");

    const message = input.value.trim();
    if (message === "") return;

    // User message
    const userMsg = document.createElement("div");
    userMsg.className = "text-end mb-2";
    userMsg.innerHTML = `<span class="badge bg-primary p-2">${message}</span>`;
    chatWindow.appendChild(userMsg);

    // Bot reply (static demo)
    let reply = "Sorry, I didn’t understand. Try asking about 'budget', 'savings', or 'goals'.";

    if (message.toLowerCase().includes("budget")) {
        reply = "Your total budget this month is $2500. You’ve used $1200 so far.";
    } else if (message.toLowerCase().includes("savings")) {
        reply = "You have saved $1,900 till now, keep it up!";
    } else if (message.toLowerCase().includes("goals")) {
        reply = "You’re 40% towards your Laptop goal and 60% towards your Emergency Fund.";
    }

    setTimeout(() => {
        const botMsg = document.createElement("div");
        botMsg.className = "text-start mb-2";
        botMsg.innerHTML = `<span class="badge bg-secondary p-2">🤖 ${reply}</span>`;
        chatWindow.appendChild(botMsg);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }, 600);

    input.value = "";
    chatWindow.scrollTop = chatWindow.scrollHeight;
}
</script>

<?php include 'footer.php'; ?>