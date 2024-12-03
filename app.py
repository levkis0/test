from flask import Flask, request, jsonify
import telebot

API_TOKEN '7892443614:AAHkVSkHpJJtbioXlawxhPKu_6pLAw4j5mI'
CHAT_ID = '7892443614'
bot = telebot.TeleBot(API_TOKEN)

app = Flask(__name__)

@bot.message_handler(commands=['start'])
def send_welcome(message):
    bot.reply_to(message, "Welcome! Your orders will be sent here.")

@app.route('/order', methods=['POST'])
def receive_order():
    order_details = request.json
    send_order_to_telegram(order_details)
    return jsonify({"status": "success"}), 200

def send_order_to_telegram(order_details):
    order_message = f"New Order: \n{order_details}"
    bot.send_message(CHAT_ID, order_message)

if __name__ == '__main__':
    bot.polling(none_stop=True)
    app.run(host='0.0.0.0', port=5000)
