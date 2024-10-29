# Uptime Checker Service

## Description

The Uptime Checker Service is a simple PHP script designed to monitor the uptime of specified websites. It checks the availability of each URL and sends notifications if a website is down or encounters an error. Notifications can be sent via Telegram, allowing for immediate alerts on the status of monitored websites.

## Features

- Checks multiple URLs for uptime.
- Sends notifications to a specified Telegram chat when a website is down or encounters an error.
- Configurable timeout settings for cURL requests.
- Follows HTTP redirects and handles various response codes.

## Requirements

- PHP 7.0 or higher
- cURL extension enabled in PHP
- A Telegram bot for sending notifications
- Google Apps Script for proxying Telegram messages (optional)

## Installation

1. **Clone the repository** to your local machine:
   ```bash
   git clone https://github.com/kianbabai/Easy-PHP-Uptime.git
   ```

2. **Navigate to the project directory**:
   ```bash
   cd Easy-PHP-Uptime
   ```

3. **Configure your settings**:
   - Open the `cron.php` file.
   - Replace the placeholders for `TG_CHATID`, `TG_BOT_TOKEN`, and `GOOGLE_PROXY` with your actual Telegram bot token, chat ID, and Google Apps Script URL.

   ```php
   define('TG_CHATID', 'YOUR_TELEGRAM_CHAT_ID');
   define('TG_BOT_TOKEN', 'YOUR_TELEGRAM_BOT_TOKEN');
   define('GOOGLE_PROXY', 'YOUR_GOOGLE_SCRIPT_URL');
   ```

4. **Add the URLs** you want to monitor in the `$urls` array:
   ```php
   $urls = [
       'https://www.example1.com',
       'https://www.example2.com',//Navigate to the project directory:


       // Add more URLs as needed
   ];
   ```

5. **Run the script**:
   - You can run the script via the command line:
   ```bash
   php cron.php
   ```

## Usage

- The service will check the uptime of the specified URLs and display messages in the console indicating whether each website is up or down.
- If a website is down or an error occurs, a notification will be sent to the specified Telegram chat.

## Notification System

Notifications are sent via Telegram using a bot that you need to create. Here's how to set up your Telegram bot:

1. **Create a new bot**:
   - Open Telegram and search for the BotFather.
   - Use the command `/newbot` and follow the prompts to create your bot.
   - Save the provided bot token for use in your script.

2. **Get your chat ID**:
   - Start a chat with your bot (send any message to it).
   - Use the following URL in your browser to get your chat ID:
     ```
     https://api.telegram.org/bot<YOUR_BOT_TOKEN>/getUpdates
     ```
   - Look for the `chat` object in the JSON response to find your chat ID.

3. **Set up Google Apps Script** (optional):
   - If you want to send messages via a proxy, create a Google Apps Script that accepts parameters and sends messages to Telegram. Use the provided URL in the `GOOGLE_PROXY` constant.

## Contributing

Contributions are welcome! If you have suggestions for improvements or new features, please feel free to open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Thanks to the developers of PHP and cURL for making this service possible.
- Special thanks to Telegram for providing a robust messaging platform.


### Notes:
- You can save this content directly as `README.md` in your project repository. 

Let me know if you need any further modifications!
