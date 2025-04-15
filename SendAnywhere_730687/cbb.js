function sendMessage() {
  var userInput = document.getElementById("user-input").value;
  if (userInput.trim() === "") return;

  displayMessage(userInput, "user");

  var botResponse = getBotResponse(userInput);

  setTimeout(function () {
    displayMessage(botResponse, "bot");
  }, 500);

  document.getElementById("user-input").value = "";
}

function displayMessage(message, sender) {
  var chatBox = document.getElementById("chat-box");
  if (!chatBox) {

    chatBox = document.createElement("div");
    chatBox.id = "chat-box";
    document.getElementById("chat-container").appendChild(chatBox);
  }
  var messageDiv = document.createElement("div");
  messageDiv.classList.add(sender);
  messageDiv.textContent = message;
  chatBox.appendChild(messageDiv);

  chatBox.scrollTop = chatBox.scrollHeight;
}

function getBotResponse(userInput) {
  userInput = userInput.toLowerCase();

  if (userInput.includes("hello") || userInput.includes("hi")) {
    return "Hello! How can I help you today?";
  } else if (userInput.includes("how are you")) {
    return "I'm just a bot, but I'm doing well. How about you?";
  } else if (userInput.includes("your name")) {
    return "I am a Emili created to help you!";
  } else if (userInput.includes("bye")) {
    return "Goodbye! Have a great day!";
  } else {
    return "Sorry, I didn't understand that.";
  }
}

function toggleChat() {
  var chatContainer = document.getElementById("chat-container");
  var chatIcon = document.getElementById("chat-icon");

  if (
    chatContainer.style.display === "none" ||
    chatContainer.style.display === ""
  ) {
    chatContainer.style.display = "flex";
    chatIcon.style.display = "none";
    // Send the initial greeting message
    displayMessage("Hello Iam Emili..!!!", "bot");
  } else {
    chatContainer.style.display = "none";
    chatIcon.style.display = "flex";
  }
}

document.addEventListener("click", function (event) {
  var chatContainer = document.getElementById("chat-container");
  var chatIcon = document.getElementById("chat-icon");

  if (!chatContainer.contains(event.target) && !chatIcon.contains(event.target))
  {
    chatContainer.style.display = "none";
    chatIcon.style.display = "flex";
  }
});
