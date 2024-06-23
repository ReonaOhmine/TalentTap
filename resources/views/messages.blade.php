<!DOCTYPE html>
<html>
<head>
    <title>メッセージ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">Messages</h2>
                                <p class="text-sm text-gray-600">Send and receive messages.</p>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div id="messages" class="mb-4 bg-gray-50 p-4 rounded-lg h-64 overflow-y-auto"></div>
                            <textarea id="messageInput" class="block w-full border border-gray-300 rounded-lg p-2 mb-2" placeholder="メッセージを入力..."></textarea>
                            <button onclick="sendMessage()" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">送信</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value;
            const toUserId = 1; // 例としての受信者ID

            const response = await fetch('/api/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + getAuthToken(),
                },
                body: JSON.stringify({
                    to_user_id: toUserId,
                    message: message,
                }),
            });

            const data = await response.json();
            console.log(data);

            if (response.ok) {
                addMessageToChat(data.message);
                messageInput.value = ''; // 入力フィールドをクリア
            }
        }

        async function getMessages() {
            const toUserId = 1; // 例としての受信者ID

            const response = await fetch('/api/get-messages?to_user_id=' + toUserId, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken(),
                },
            });

            const messages = await response.json();
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = '';

            messages.forEach(message => {
                addMessageToChat(message.message);
            });
        }

        function addMessageToChat(message) {
            const messagesDiv = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('mb-2', 'p-2', 'bg-white', 'rounded-lg', 'shadow-sm');
            messageElement.innerText = message;
            messagesDiv.appendChild(messageElement);
            messagesDiv.scrollTop = messagesDiv.scrollHeight; // 最新メッセージにスクロール
        }

        function getAuthToken() {
            // 認証トークンをローカルストレージなどの安全な場所から取得
            return localStorage.getItem('auth_token'); // 例: ローカルストレージから取得
        }

        // ページが読み込まれた時にメッセージを取得し、5秒ごとに新しいメッセージを取得
        document.addEventListener('DOMContentLoaded', () => {
            getMessages();
            setInterval(getMessages, 5000); // 5秒ごとにメッセージを取得
        });
    </script>
</body>
</html>
