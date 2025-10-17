<?php include 'navbar.php'; ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Your Financial Coach</h2>
        <p class="text-muted">Agentic AI that adapts to your spending and income.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4" style="backdrop-filter: blur(10px); background: rgba(255,255,255,.6);">
                <div class="card-body p-0 d-flex flex-column" style="height: 560px;">
                    <div id="chatWindow" class="flex-grow-1 overflow-auto p-4" style="background: radial-gradient(1200px 600px at 0% 0%, rgba(30,58,138,.08), transparent), radial-gradient(800px 400px at 100% 100%, rgba(136,196,23,.08), transparent);">
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-2 rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:#1e1b4b;color:white;">🤖</div>
                            <div class="p-3 rounded-3" style="background:#f3f4f6; max-width: 80%;">
                                Hi! I’m your finance coach. Ask me about budgets, savings, or goals.
                            </div>
                        </div>
                    </div>
                    <div id="typing" class="px-4 py-2 text-muted small" style="display:none;">Coach is typing…</div>
                    <div class="p-3 border-top">
                        <div class="input-group input-group-lg">
                            <input type="text" id="userInput" class="form-control" placeholder="Type your question...">
                            <button id="sendBtn" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    const input = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');
    const chatWindow = document.getElementById('chatWindow');
    const typing = document.getElementById('typing');

    function appendUser(msg){
        const wrap = document.createElement('div');
        wrap.className = 'd-flex align-items-start justify-content-end mb-3';
        wrap.innerHTML = `<div class="p-3 rounded-3 text-white" style="background:var(--brand-primary); max-width:80%;">${msg}</div>`;
        chatWindow.appendChild(wrap);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    function appendBot(msg){
        const wrap = document.createElement('div');
        wrap.className = 'd-flex align-items-start mb-3';
        wrap.innerHTML = `
            <div class="me-2 rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:#1e3a8a;color:white;">🤖</div>
            <div class="p-3 rounded-3" style="background:#eef2f6; max-width:80%; white-space:pre-wrap;">${msg}</div>
        `;
        chatWindow.appendChild(wrap);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    async function send(){
        const msg = (input.value || '').trim();
        if (!msg) return;
        appendUser(msg);
        input.value = '';
        typing.style.display = 'block';
        try{
            console.log('Sending message:', msg);
            console.log('FinAI object:', window.FinAI);
            const res = await window.FinAI.sendToAgent(msg);
            console.log('Response:', res);
            const text = res.reply || res.error || 'Sorry, something went wrong.';
            appendBot(text);
        }catch(e){
            console.error('Error:', e);
            appendBot('Network error: ' + e.message);
        }finally{
            typing.style.display = 'none';
        }
    }

    sendBtn.addEventListener('click', send);
    input.addEventListener('keypress', function(e){ if(e.key==='Enter') send(); });
})();
</script>

<?php include 'footer.php'; ?>