<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chatting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<div class="container-fluid py-3 bg-success text-white text-center">
  <h1>My Chatting App</h1>
  <h3>User</h3>
</div>
  

    @vite('resources/js/app.js')

    <!-- Chat Option -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {
            border-radius: 15px 15px 0px 0px;
            background-color: #ff0000;
            color: white;
            padding: 5px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 0px;
            right: 10px;
            width: 210px;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            z-index: 9;
        }

        /* Chat Widget Styles */
        .chat-widget {
            width: 350px;
            height: 500px;
            display: flex;
            flex-direction: column;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
        }

        /* Header */
        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: #ff0000;
            color: #fff;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .user-name {
            font-size: 16px;
            font-weight: bold;
            margin-left: 10px;
            flex: 1;
        }

        .message.outgoing .sender-name {
            background-color: #363a37; /* Green background */
            color: #fff; /* White text */
            padding: 1px 5px; /* Add some padding */
            border-radius: 5px; /* Rounded corners */
            font-weight: bold; /* Make the text bold */
            font-size: 14px; /* Adjust font size */
            display: inline-block; /* Ensures padding works well */
            margin-right: 5px; /* Add space between the sender and the message */
            margin-bottom: 3px;
        }

        .message.incoming .sender-name {
            background-color: #238b3d; /* Green background */
            color: #fff; /* White text */
            padding: 1px 5px; /* Add some padding */
            border-radius: 5px; /* Rounded corners */
            font-weight: bold; /* Make the text bold */
            font-size: 14px; /* Adjust font size */
            display: inline-block; /* Ensures padding works well */
            margin-right: 5px; /* Add space between the sender and the message */
            margin-bottom: 3px;
        }

        .close-btn {
            font-size: 20px;
            border: none;
            background: none;
            color: #fff;
            cursor: pointer;
        }

        /* Chat Body */
        .chat-body {
            display: flex;            
            flex-direction: column;
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .message {
            max-width: 70%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.5;
            display: inline-block;
        }

        .message.incoming {
            align-self: flex-start;
            /* Align to the left */
            background-color: #e0e0e0;
        }

        .message.outgoing {
            align-self: flex-end;
            /* Align to the right */
            background-color: #ff0000;
            color: #fff;
        }

        /* Footer */
        .chat-footer {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }

        .chat-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        .send-btn {
            margin-left: 10px;
            padding: 10px 15px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <button class="open-button" onclick="openForm()">Chat</button>

    <div class="chat-popup" id="myForm">
        <div class="chat-widget">
            <div class="chat-header">
                <img src="https://icons.iconarchive.com/icons/hopstarter/soft-scraps/256/User-Chat-icon.png"
                    alt="User Image" class="user-avatar">
                <span class="user-name">{{ $username ?? 'User Name'}}</span>
                <button class="close-btn" onclick="closeForm()">✕</button>
            </div>
            @if(!empty($username))
            <div class="chat-body" id="chat-body">
                {{-- <div class="message incoming">
                    <span>As-Salamu Alaikum, How can I help You</span>
                </div>
                <div class="message outgoing">
                    <span>I am looking for Car Battery</span>
                </div>
                <div class="message incoming">
                    <span>Thank You Sir, We have 5 types of Car Battries</span>
                    <span>What is Your Car Brand and Model</span>
                </div>
                <div class="message outgoing">
                    <span>I am looking for Toyota Prius</span>
                </div>
                <div class="message incoming">
                    <span>As-Salamu Alaikum, How can I help You</span>
                </div>
                <div class="message outgoing">
                    <span>I am looking for Car Battery</span>
                </div>
                <div class="message incoming">
                    <span>Thank You Sir, We have 5 types of Car Battries</span>
                    <span>What is Your Car Brand and Model</span>
                </div>
                <div class="message outgoing">
                    <span>I am looking for Toyota Prius</span>
                </div> --}}
            </div> 
            <div class="chat-footer">
                <input type="text" name="msg" id="msg" class="chat-input msg" placeholder="Type here and press enter...">
                <button type="button" class="send-btn" onclick="SendMsg()" >➤</button>
            </div>
            @else
            <div class="text-align-middle mx-2">
                <form id="userform" method="POST" action="{{ route('chatapp') }}" >
                    @csrf
                    <div class="text-align-middle mx-2">
                        <label for="username">Enter Your Name to Start Chat</label>
                        <input type="text" name="username" id="username" class="form-control m-80 mx-auto mt-2" placeholder="Your Name" required>
                        <button type="submit" class="btn btn-success mt-3 content-self-end">Start Chat</button>
                    </div>
                </form>
            </div>
            @endif  
        </div>
    </div>
    <script>

        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

         // Automatically open form if username exists
        @if (!empty($username))
            document.addEventListener("DOMContentLoaded", function () {
                openForm();
            });
        @endif

    </script>

    <script>

        function SendMsg(){
            let sender = {!! json_encode($username ?? '') !!}; // Escaped properly            
            let message = msg.value    
            // alert(message);
            $.ajax({
                url: "{{ route('firemsg') }}",
                method: 'POST',
                data: {
                    sender : sender,
                    msg : message,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#chat-body').append(`
                        <div class="message outgoing">
                            <span class="sender-name">${sender}</span></br><span>${response.msg}</span>
                        </div>
                    `);
                    scrollToBottom();
                    
                    $('.chat-input').val('');
                },
                error: function () {
                  
                }
            });
        }

        window.onload=()=>{
            window.Echo.channel('user-message').listen('MessageSent', function(data){
                if(data.sender!= {!! json_encode($username ?? '') !!} ){
                    $('#chat-body').append(`
                        <div class="message incoming">
                            <span class="sender-name">${data.sender}</span></br><span>${data.message}</span>
                        </div>
                    `);
                    scrollToBottom();
                }
                // console.log(data);
                // alert(data);
            })
            
        }      
       

        function scrollToBottom() {
            var chatBody = document.getElementById('chat-body');
            chatBody.scrollTop = chatBody.scrollHeight;
        }

    </script>

</body>
</html>
