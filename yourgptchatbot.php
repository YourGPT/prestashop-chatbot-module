<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class YourGptChatbot extends Module
{
    public function __construct()
    {
        $this->name = 'yourgptchatbot';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'YourGPT';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('YourGPT Chatbot');
        $this->description = $this->l('Integrate YourGPT AI chatbot into your store.');
        $this->ps_versions_compliancy = ['min' => '1.7.0.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayFooter') &&
            Configuration::updateValue('YGC_WIDGET_ID', '');
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            Configuration::deleteByName('YGC_WIDGET_ID');
    }

    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submit_yourgptchatbot')) {
            $widget_id = Tools::getValue('YGC_WIDGET_ID');
            if (empty($widget_id)) {
                $output .= $this->displayError($this->l('Widget ID cannot be empty.'));
            } else {
                Configuration::updateValue('YGC_WIDGET_ID', $widget_id);
                $output .= $this->displayConfirmation($this->l('Settings updated successfully.'));
            }
        }

        return $output . $this->renderForm();
    }

    protected function renderForm()
    {
        $fields_form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('YourGPT Chatbot Settings'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('Widget ID'),
                        'name' => 'YGC_WIDGET_ID',
                        'size' => 60,
                        'required' => true,
                        'desc' => $this->l('Enter your YourGPT chatbot widget ID here.'),
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right',
                ],
            ],
        ];

        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ?? 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit_yourgptchatbot';
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->fields_value['YGC_WIDGET_ID'] = Configuration::get('YGC_WIDGET_ID');

        return $helper->generateForm([$fields_form]);
    }

    public function hookDisplayFooter($params)
    {
        $widget_id = Configuration::get('YGC_WIDGET_ID');
        if (empty($widget_id)) {
            return ''; // No widget ID set, don't show script
        }

        return '<script>
            window.YGC_WIDGET_ID = "' . addslashes($widget_id) . '";
            (function(){
                var script=document.createElement("script");
                script.src="https://widget.yourgpt.ai/script.js";
                script.id="yourgpt-chatbot";
                document.body.appendChild(script);
            })();
        </script>';
    }
}
