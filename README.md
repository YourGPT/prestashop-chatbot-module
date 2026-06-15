# YourGPT Chatbot for PrestaShop

Integrate the [YourGPT](https://yourgpt.ai) AI chatbot into your PrestaShop store. Once installed and configured with your widget UID, the chatbot loads automatically on every page of your store.

## Features

- One-field setup — just paste your YourGPT widget UID.
- Loads the chatbot script on every store page via the `displayFooter` hook.
- No script is injected until a widget UID is configured.
- Clean install/uninstall (configuration is removed on uninstall).

## Requirements

- PrestaShop **1.7.0.0** or later (compatible up to **8.0.0**).
- A [YourGPT](https://yourgpt.ai) account with a chatbot widget UID.

## Installation

### Upload the zip (easiest)

1. Compress the module folder into a `yourgptchatbot.zip` archive (the zip must contain a `yourgptchatbot/` directory with `yourgptchatbot.php` and `config.xml` inside).
2. Log in to your PrestaShop admin panel and open the **Modules** page.
3. Click **Upload a module** and select the zip file.

### Copy the files manually

1. Copy the `yourgptchatbot` folder into your PrestaShop `modules/` directory.
2. Open the **Modules** page, find **YourGPT Chatbot**, and click **Install**.

## Configuration

1. Open the **Modules** page, find **YourGPT Chatbot**, and click **Configure**.
2. Enter your **Widget UID** in the field provided.
3. Click **Save**.

The chatbot will now appear on your storefront. To find your widget UID, log in to your YourGPT dashboard.

## How It Works

On every store page, the module adds a small script at the bottom that loads the YourGPT chatbot using your widget UID. If no UID is set, nothing is added.

## Uninstall

Uninstalling the module from the Module Manager removes the registered hook and deletes the stored widget UID (`YGC_WIDGET_ID`) from your configuration.

## License

See the module author ([YourGPT](https://yourgpt.ai)) for licensing details.
