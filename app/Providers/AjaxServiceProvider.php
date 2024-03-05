<?php

namespace App\StoreSearch\Providers;

abstract class AjaxServiceProvider
{
    public $hook;
    public $both;

    /**
     * @param $hook - Nome da Ação ajax a ser executada
     * @param $both - Por padrão as ações podem ser executadas por usuários autenticados ou não
     * Se o parâmetro $both for setado como false será executado somente por usuário autenticados
     */
    public function __construct()
    {
        if (!$this->both) {
            add_action("wp_ajax_{$this->hook}", [$this, "action"]);
            return;
        }

        add_action("wp_ajax_{$this->hook}", [$this, "action"]);
        add_action("wp_ajax_nopriv_{$this->hook}", [$this, "action"]);
    }

    /**
     * Metódo para registrar o Hook
     * @return mixed
     */
    public function register($hook, $both = true): void
    {
        $this->hook = $hook;
        $this->both = $both;
        $this->__construct();
    }

    public function verifyNonce()
    {
        $nonce = wp_verify_nonce($_REQUEST['nonce']);

        if (!$nonce) {
            wp_send_json(400);
        }
    }

    /**
     * Método que executa a chamada Ajax
     * @return mixed
     */
    abstract public function action();
}