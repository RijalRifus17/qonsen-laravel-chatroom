<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>
                    Chatroom
                </h5>
            </div>
            <div class="card-body" id="chatContent" style="height:400px;overflow-y:auto;">

                <div class="card mb-2" v-for="(message, index) in messages" :key="index">
                    <div class="card-body">
                        <b>{{ message.name }}</b><br>
                        {{ message.message }}
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <input @keyup.enter="storeMessage()" v-model="message" type="text" class="form-control" placeholder="Pesan anda">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            message: null,
            name: null,
        }
    },
    mounted() {
        this.name = "Rijal Solahudin"
        this.getName()
        this.getMessages()
        this.checkChannel()
    },
    methods:  {
        getMessages() {
            axios.get('/api/message')
                .then(res => {
                    this.messages = res.data
                })
        },
        storeMessage() {
            axios.post("/api/message", {
                'name' : this.name,
                'message' : this.message
            })
                .then(res => {
                    this.message = null
                    this.scrollToBottom()
                })
        },
        checkChannel() {
            window.Echo.channel('chat-room').listen('ChatRoomEvent', (e) => {
                const pushMessages = this.messages.push(e)
                if(pushMessages) {
                    this.scrollToBottom(100)
                }
            })
        },
        getName() {
            const url   = new URL(window.location.href)
            const name  = url.searchParams.get("name")

            this.name  = name;
        },
        scrollToBottom(tambahan = null) {
            let chatContent = document.getElementById('chatContent')
            let height = chatContent.scrollHeight;

            if(tambahan) {
                height = height + tambahan
            }

            chatContent.scrollTop = height;
        }
    }
}
</script>
