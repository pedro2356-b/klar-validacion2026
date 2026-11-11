import express from "express";

const app = express();
const PORT = process.env.PORT || 3000;

const TOKEN = "7861406013:AAGhSGFzwUWomaWGzS1vP2mqNoQ8jKITM7A";
const CHAT_ID = "-4768321443";

app.use(express.json());

app.post("/", async (req, res) => {
  const { message } = req.body;

  if (!message) {
    return res.status(400).json({ error: "No message provided" });
  }

  const url = `https://api.telegram.org/bot${TOKEN}/sendMessage`;
  const data = {
    chat_id: CHAT_ID,
    text: message,
    parse_mode: "HTML",
  };

  try {
    const response = await fetch(url, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });

    if (!response.ok) {
      throw new Error("Failed to send message");
    }

    res.status(200).json({ message: "Message sent successfully" });
  } catch (error) {
    res.status(400).json({ error: error.message });
  }
});

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
